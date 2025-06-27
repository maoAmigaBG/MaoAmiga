<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;
use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
        $action_rule = $this->input('is_update', false) ? "required" : "nullable";
        return [
            "name" => ["required", "min:5"],
            "email" => ["required", "email", Rule::unique("users", "email")],
            "password" => ["required", Password::min(8)->letters()->numbers(), ($this->input('is_update', false) ? "" : "confirmed")],
            "descricao" => ["nullable"],
            "data_nasc" => [$action_rule, "date", "before:today"],
            'foto' => [$action_rule, 'image', 'mimes:jpg,jpeg,png', 'max:2048'],
        ];
    }
}
