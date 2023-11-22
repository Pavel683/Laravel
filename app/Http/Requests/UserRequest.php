<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
            'fist_name' => 'required|min:2|max:100|different:second_name',
            'second_name' => 'required|min:2|max:100|different:fist_name',
        ];
    }

    public function messages()
    {
        return [
//            'fist_name.required' => 'Обязательно для заполнения',
//            'fist_name.min' => 'Не менее :min символов',
//            'second_name.required' => 'Обязательно для заполнения',
//            'second_name.min' => 'Не менее :min символов',
//            'fist_name.different' => 'Поля должны отличаться',

        'required' => ':attribute Обязательно для заполнения',
        'min' => ':attribute Не менее :min символов',
        'different' => ':attribute Поля должны отличаться',

        ];
    }

}
