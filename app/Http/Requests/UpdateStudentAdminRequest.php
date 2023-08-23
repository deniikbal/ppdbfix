<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateStudentAdminRequest extends FormRequest
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
            'name' => 'required',
            'nodaftar' => 'required',
            'jenis_kelamin' => 'required',
            'tanggal_lahir' => 'required',
            'tempat_lahir' => 'required',
            'nik' => 'required',
            'agama' => 'required',
            'nohp_siswa' => 'required',
            'anak_ke' => 'required',
            'jumlah_saudara' => 'required',
            'tinggi_badan' => 'required',
            'berat_badan' => 'required',
            'hoby' => 'required',
            'cita' => 'required',
        ];
    }
}
