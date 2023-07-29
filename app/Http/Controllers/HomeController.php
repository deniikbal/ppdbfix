<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function getschoolas()
    {
//        $json = Storage::disk('local')->put('/schools/guru.json','content');
//        //dd($json);
//        $teachers = json_decode($json, true);
//        dd($teachers['rows']);
        $json = Http::get('https://api-sekolah-indonesia.vercel.app/sekolah');
        $teachers = json_decode($json, true);
        dd($teachers['dataSekolah']);

        https://api-sekolah-indonesia.vercel.app/sekolah/smp?provinsi=020000&page=1&perPage=4922
    }
}
