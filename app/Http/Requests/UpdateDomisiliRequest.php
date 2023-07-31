<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateDomisiliRequest extends FormRequest
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
            'alamat_pd' => 'required',
            'jarak' => 'numeric|required',
            'waktu' => 'required',
            'provinsi_pd' => 'required',
            'kota_pd' => 'required',
            'kec_pd' => 'required',
            'desa_pd' => 'required',
        ];
    }
}
