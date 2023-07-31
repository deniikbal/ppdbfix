<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateOrtuRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'no_kk' => 'required|size:16|unique:students,no_kk',
            'nama_ayah' => 'required',
            'nik_ayah' => 'required|size:16|unique:students,nik_ayah',
            'tahun_ayah' => 'required|size:4',
            'pendidikan_ayah' => 'required',
            'pekerjaan_ayah' => 'required',
            'penghasilan_ayah' => 'required',
            'nama_ibu' => 'required',
            'nik_ibu' => 'required|size:16|unique:students,nik_ibu',
            'tahun_ibu' => 'required|size:4',
            'pendidikan_ibu' => 'required',
            'pekerjaan_ibu' => 'required',
            'penghasilan_ibu' => 'required',
        ];
    }
}
