<?php

namespace App\Jobs;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class RegisterNewUser implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $user;
    public $tries = 3;
    public $timeout = 120;
    /**
     * Create a new job instance.
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $user = $this->user;
        $wa = $user->notif_wa + 1;
        $data = [
            'api_key' => 'huytkk8FrEfFJNyJ0r3HmU0DKzVE9tPQ',
            'sender' => '085722676819',
            'number' => $user->no_handphone,
            'message' => "*Acount User Berhasil Dibuat* \n\nNama User : $user->name \nEmail : $user->email \nPassword : $user->password_plain
            \n *PANITIA PPDB 2023*",
            // 'footer' => '*PPDB SMA TELKOM BANDUNG*',
            // 'template1' => 'url|Login|http://ppdb.smatelkombandung.sch.id/login', //REQUIRED ( template minimal 1 )
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

        $user->update([
            'notif_wa' => $wa,
        ]);
    }
}
