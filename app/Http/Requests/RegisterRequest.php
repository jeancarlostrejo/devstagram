<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            "name" => 'required|min:2|max:50',
            'username' => 'required|min:3|max:20|unique:users',
            'email' => 'required|email|max:60|unique:users',
            'password' => 'required|min:5|max:16|confirmed'
        ];
    }

    public function prepareForValidation()
    {
        $this->merge([
            'username' => \Illuminate\Support\Str::slug($this->username)
        ]);
    }
}
