<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
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
            'name'          =>  'required|min:5|max:50',
            'category_id'   =>  'required',
            'review_end'    =>  'required|date',
            'order_discuss' =>  'required|date|after:review_end',
        ];
    }

    public function messages()
    {
        return [
            'name.min' => 'Имя должно быть не менее 5 символов',
            'name.max' => 'Имя должно быть не более 50 символов',
            'category_id.required' => 'Категория не выбрана',
            'review_end.required' => 'Дата принятия заявок не указано',
            'order_discuss.required' => 'Дата обсуждения в чате не указано'
        ];

    }
}
