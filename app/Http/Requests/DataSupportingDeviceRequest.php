<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DataSupportingDeviceRequest extends FormRequest
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
           'name'                       => ['required'],
           'merk'                       => ['required'],
           'model_or_type'              => ['required'],
           'description'                => ['required'],
           'amount'                     => ['required'],
           'condition'                  => ['required'],
           'date'                       => ['required'],
           'description'                => ['required'],
        ];
    }
}
