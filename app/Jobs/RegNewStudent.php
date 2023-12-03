<?php

namespace App\Jobs;

use App\Models\Student;
use App\Models\User;
use App\Models\WhatsApp;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class RegNewStudent implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;


    protected $student;
    public $tries = 3;
    public $timeout = 120;

    /**
     * Create a new job instance.
     */
    public function __construct(Student $student)
    {
        $this->student = $student;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {

        $setting = WhatsApp::findorfail(1);
        $student = $this->student;
        $user = User::where('id', $student->user_id)->first();
        $wa = $student->notif_wa + 1;
        $data = [
            'api_key' => $setting->api_key,
            'sender' => $setting->sender,
            'number' => $user->no_handphone,
            'message' => "*Pendaftaran Calon Siswa Berhasil* \n\n*Nama Lengkap* : $student->name \n*No Daftar* : $student->nodaftar \n*Jenis Kelamin* : $student->jenis_kelamin \n*Kecamatan Domisili* : $student->kec_pd \n*Asal Sekolah* : $student->asal_sekolah \n*No HP* : $student->nohp_siswa",
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

        $student->update([
            'notif_wa' => $wa,
        ]);
    }
}
