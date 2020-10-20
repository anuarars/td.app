<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PageRequest extends FormRequest
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
            'name' => 'required',
            'body' => 'required|min:5',
            'position' => 'required|integer',
        ];
    }

    public function messages()
{
    return [
        'name.required' => 'Название должно быть заполнено',
        'body.required' => 'Контент страницы не должен быть пустым',
        'body.min' => 'Не менее 5 символов должно быть на странице',
        'position.required' => 'Укажите позицию страницы'
    ];
}


}
