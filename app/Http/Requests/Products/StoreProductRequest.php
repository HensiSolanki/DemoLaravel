<?php

namespace App\Http\Requests\Products;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
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
        $rules = [
            'name' => 'required|max:30|min:5',
            'detail' => 'required|max:255|min:10',
        ];

        if ($this->getMethod() == 'POST') {
            $rules += ['image' => 'required|mimes:png,jpeg,gif,jpg'];
        }

        return $rules;
    }
}
