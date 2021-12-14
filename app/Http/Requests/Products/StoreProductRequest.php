<?php

namespace App\Http\Requests\Products;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

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
    public function rules(Request $request)
    {
        if ($this->getMethod() == 'POST') {
            $rules = [
                'product_name' => 'required|max:30|min:5|unique:products',
                'detail' => 'required|max:255|min:10',
                'image' => 'required|mimes:png,jpeg,gif,jpg',
                // 'user_id' => 'required'
            ];
        } elseif ($this->getMethod() == 'PUT') {
            $rules = [
                'product_name' => ['required', 'max:30', 'min:5', 'string', Rule::unique('products')->ignore($request->id)],
                'detail' => 'required|max:255|min:10'
            ];
        }
        return $rules;
    }
    public function messages()
    {
        return [
            'product_name.required' => 'Please Enter Product Name',
            'detail.required' => 'Please Enter Product Detail',
            'image.required' => 'Please Enter Product Image',
            // 'user_id.required' => 'Please Select The User first',
        ];
    }
}
