<?php

namespace App\Http\Controllers;

use App\DataTables\SchoolsDataTable;
use App\Models\District;
use App\Models\Province;
use App\Models\Regency;
use App\Models\School;
use App\Http\Requests\StoreSchoolsRequest;
use App\Http\Requests\UpdateSchoolsRequest;
use App\Models\Student;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;
use Ramsey\Uuid\Uuid;

class SchoolController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(SchoolsDataTable $dataTable)
    {
        $schools = School::all();
        return $dataTable->render('admin.school.index', compact('schools'));
    }

    public function import()
    {
        $json = Http::get('https://api-sekolah-indonesia.vercel.app/sekolah/smp?provinsi=020000&page=1&perPage=4922');
        $schools = json_decode($json, true);
        //dd($teachers['dataSekolah']);
        foreach ($schools['dataSekolah'] as $item) {
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

    public function tambahsekolah(Request $request)
    {

        $valid = Validator::make($request->all(), [
            'sekolah' => 'required|unique:schools',
            'npsn' => 'required|size:8',
            'bentuk' => 'required',
            'status' => 'required',
            'provinces_id' => 'required',
            'regencies_id' => 'required',
            'districts_id' => 'required',
        ]);
        if ($valid->fails()) {
            return response()->json(['errors' => $valid->errors()->all()]);
        } else {
            $provinsi = Province::find($request->provinces_id);
            $kota = Regency::find($request->regencies_id);
            $kec = District::find($request->districts_id);

            School::firstOrCreate([
                'sekolah' => $request->sekolah,
                'bentuk' => $request->bentuk,
                'npsn' => $request->npsn,
                'status' => $request->status,
                'propinsi' => $provinsi->name,
                'kabupaten_kota' => $kota->name,
                'kecamatan' => $kec->name,
            ]);
            return response()->json(['success' => 'Data is successfully added']);
        }
    }

    public function schooldelet($id)
    {
        $school = School::find($id);
        $school->delete();
        return redirect()->back()->with('success', 'Berhasil Dihapus');

    }

    public function schooledit($id)
    {
        $school = School::find($id);
        return view('admin.school.schooledit', compact('school'));

    }

    public function schoolupdate(UpdateSchoolsRequest $request, $id)
    {
        $provinsi = Province::find($request->provinces_id);
        $kota = Regency::find($request->regencies_id);
        $kec = District::find($request->districts_id);
        $school = School::find($id);
        $school->update([
            'sekolah' => $request->sekolah,
            'bentuk' => $request->bentuk,
            'npsn' => $request->npsn,
            'status' => $request->status,
            'propinsi' => $provinsi->name,
            'kabupaten_kota' => $kota->name,
            'kecamatan' => $kec->name,
        ]);
        return redirect()->route('schools.index')->with('success', 'Berhasil Di Update');

    }
}
