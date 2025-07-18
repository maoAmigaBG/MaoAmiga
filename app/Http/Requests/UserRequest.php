<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Arr;

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
        $isUpdate = $this->input('is_update') ?? false;

        $passwordRules = [];

        if ($isUpdate) {
            $passwordRules = ['required', 'string'];
        } else {
            $passwordRules = ['required', 'min:4', 'confirmed'];
        }

        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('users')->ignore($this->id),
            ],
            'data_nasc' => ['nullable', 'date'],
            'descricao' => ['nullable', 'string'],
            'anonimo' => ['nullable', 'boolean'],
            'foto' => [
                'nullable',
                'sometimes',
                'file',
                'image',
                'mimes:jpeg,png,jpg,gif,svg',
                'max:2048',
            ],
            'password' => $passwordRules,
        ];
    }
}