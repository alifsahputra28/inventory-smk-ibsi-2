<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DataComputersRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'merk'             => ['required'],
            'model'            => ['required'],
            'processor'        => ['required'],
            'vga'              => ['required'],
            'ram'              => ['required'],
            'disk_size'        => ['required'],
        ];
    }
}
