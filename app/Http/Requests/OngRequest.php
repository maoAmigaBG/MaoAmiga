<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OngRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            "nome" => ["required"],
            "subtitulo" => ["nullable","max:20"],
            "descricao" => ["nullable","max:5000"],
            "cep" => ["required"],
            "endereco" => ["required"],
            "banner" => ["nullble", 'image', 'mimes:jpg,jpeg,png', 'max:2048'],
            "foto" => ["nullble", 'image', 'mimes:jpg,jpeg,png', 'max:2048'],
            "ong_type_id" => ["required"],
            "ong_new_type" => ["required"],
        ];
    }
}
