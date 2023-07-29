<?php

namespace Database\Seeders;

use App\Models\School;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class SchoolsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $json = Http::get('https://api-sekolah-indonesia.vercel.app/sekolah/smp?provinsi=020000&page=1&perPage=4922');
        $schools = json_decode($json, true);
        //dd($teachers['dataSekolah']);
        foreach($schools['dataSekolah'] as $item) {
            School::query()->firstOrCreate([
                'propinsi' => $item['propinsi'],
                'kabupaten_kota' => $item['kabupaten_kota'],
                'kecamatan' => $item['kecamatan'],
                'npsn' => $item['npsn'],
                'sekolah' => $item['sekolah'],
                'status' => $item['status'],
                'bentuk' => $item['bentuk'],
            ]);
        }
    }
}
