<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserProfileRequest extends FormRequest
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
            'username' => ['required', 'min:3', 'max:20', 'unique:users,username,' . auth()->user()->id, 'not_in:twitter,edit-profile'],
            'image' => 'sometimes|image|mimes:png,jpg,jpeg,gif'
        ];
    }

    public function prepareForValidation()
    {
        $this->merge([
            'username' => \Illuminate\Support\Str::slug($this->username)
        ]);
    }
}
