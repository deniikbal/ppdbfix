<?php

namespace App\Jobs;

use App\Models\Payment;
use App\Models\payment_xendit;
use App\Models\Student;
use App\Models\User;
use App\Models\WhatsApp;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Auth;

class NotifPayment implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $payment;
    public $tries = 3;
    public $timeout = 120;

    /**
     * Create a new job instance.
     */
    public function __construct(Payment $payment)
    {
        $this->payment = $payment;
    }


    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $setting = WhatsApp::findorfail(1);
        $payment = $this->payment;
        $wa = $payment->notifikasi + 1;
        $student = Student::find($payment->student_id);
        $user = User::where('id', $student->user_id)->first();
        $data = [
            'api_key' => $setting->api_key,
            'sender' => $setting->sender,
            'number' => $user->no_handphone,
            'media_type' => 'image',
            'caption' => "*Pembayaran Administrasi*
            \n*Nama*: $student->name\n*No Daftar*: $student->nodaftar\n*Nominal* : Rp. $payment->nominal\n*Id Bayar* : $payment->id_bayar\n*Jenis Pembayaran* : $payment->jenis_pembayaran \n*Bayar* : $payment->jenis_bayar",
            'url' => "https://ppdb.smatelkombandung.sch.id/storage/" . $payment->bukti_bayar,
        ];
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data));
        curl_setopt($curl, CURLOPT_URL, 'https://pedia.ypt.or.id/send-media');
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($curl, CURLOPT_ENCODING, '');
        curl_setopt($curl, CURLOPT_MAXREDIRS, 10);
        $result = curl_exec($curl);
        curl_close($curl);
        echo "<pre>";
        print_r($result);

        $payment->update([
            'notifikasi' => $wa,
        ]);
    }
}
