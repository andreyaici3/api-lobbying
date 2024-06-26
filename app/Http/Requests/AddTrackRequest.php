<?php

namespace App\Http\Requests;

use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class AddTrackRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            "nama" => ["required"],
            "nopol" => ["required"],
            "nosurat" => ["required"]
        ];
    }

    public function messages():array
    {
        return [
            "nama.required" => "Nama Tidak Boleh Kosong",
            "nopol.required" => "Nomor Polisi Tidak Boleh Kosong",
            "nosurat.required" => "Nomor Surat Tidak Boleh Kosong",
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'success'   => false,
            'message'   => 'Validation errors',
            'data'      => $validator->errors()
        ]));
    }
}
