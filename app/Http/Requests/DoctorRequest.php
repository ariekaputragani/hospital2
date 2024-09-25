<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DoctorRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'poli' => 'required',
            'name' => 'required|min:3',
            'birthdate' => 'required',
            'phone' => 'required|min:6|max:20',
            'email' => 'required|email|unique:users',
            'address' => 'required',
        ];
    }
}
