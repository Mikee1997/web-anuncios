<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RequestAd extends FormRequest
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
        // Define las reglas de validación para los campos del formulario
        return [
            'title' => 'required',
            'short_description' => 'required',
            'long_description' => 'required',
            'phone' => 'required',
            'email' => 'required',
            'pickpoint' => 'required',
        ];
    }
}
