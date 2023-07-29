<?php

namespace App\Http\Controllers;

use App\DataTables\SchoolsDataTable;
use App\Models\School;
use App\Http\Requests\StoreSchoolsRequest;
use App\Http\Requests\UpdateSchoolsRequest;
use Illuminate\Support\Facades\Http;

class SchoolsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(SchoolsDataTable $dataTable)
    {
        return $dataTable->render('admin.school.index');
    }
    public function import()
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

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSchoolsRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(School $schools)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(School $schools)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSchoolsRequest $request, School $schools)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(School $schools)
    {
        //
    }
}
