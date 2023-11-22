<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PlaceRequest extends FormRequest
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
            'name_place' => 'required|alpha',
            'type_id' => 'required|alpha_num:ascii',
            'user_created_id' => 'required|alpha_num:ascii',
        ];
    }

    public function messages()
    {
//        dd(22);
        return [

            'name_place.required' => 'Название обязательно для заполнения',
            'name_place.alpha' => 'Название должно содержать только буквы',
//            'type_id.required' => 'Тип обязателен для заполнения',
            'type_id.alpha_num' => 'Тип обязателен для заполнения',
            'user_created_id.alpha_num' => 'Кто создал обязателен для заполнения',

        ];
    }
}
