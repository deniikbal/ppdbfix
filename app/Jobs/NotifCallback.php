<?php

namespace App\Jobs;

use App\Models\payment_xendit;
use App\Models\WhatsApp;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class NotifCallback implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $payment;
    protected $getInvoice;
    public $tries = 3;
    public $timeout = 120;

    /**
     * Create a new job instance.
     */
    public function __construct(payment_xendit $payment, $getInvoice)
    {
        $this->payment = $payment;
        $this->getInvoice = $getInvoice;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $setting = WhatsApp::findorfail(1);
        $payment = $this->payment;
        //$wa = $student->notif_wa + 1;
        $expired = Carbon::parse($payment->expiry_date);
        $getInvoice = $this->getInvoice;
        $payment_channel = $getInvoice['payment_channel'];
        $payment_method = $getInvoice['payment_method'];
        $payment_destination = $getInvoice['payment_destination'];
        $data = [
            'api_key' => $setting->api_key,
            'sender' => $setting->sender,
            'number' => $payment->no_handphone,
            'message' => "Terimakasih Sudah Melakukan Titipan Pembayaran \n \nInvoice : *$payment->external_id* \nStatus Pembayaran : *$payment->status* \nPayment Channel : *$payment_channel* \nPayment Method : *$payment_method* \nNomor Bayar : *$payment_destination* \n\nSemoga Sehat Selalu \n\n*TIM PPDB SMA TELKOM 2023*",
        ];
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data));
        curl_setopt($curl, CURLOPT_URL, 'https://pedia.ypt.or.id/send-message');
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($curl, CURLOPT_ENCODING, '');
        curl_setopt($curl, CURLOPT_MAXREDIRS, 10);
        $result = curl_exec($curl);
        curl_close($curl);
        echo "<pre>";
        print_r($result);
    }
}
