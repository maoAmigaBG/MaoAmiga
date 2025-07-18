<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CampaignRequest extends FormRequest
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
            'nome' => ["required"],
            'tipo' => ["required"],
            'descricao' => ["required"],
            'materiais' => ["nullable"],
            'meta' => ["nullable"],
            'foto' => ["nullable", 'image', 'mimes:jpg,jpeg,png', 'max:2048'],
            'ong_id' => ["required"],
        ];
    }
}
