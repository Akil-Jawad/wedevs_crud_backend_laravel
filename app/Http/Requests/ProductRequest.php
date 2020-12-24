<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            //
            'image' => 'required|image|max:2048|mimes:jpg,bmp,png,jpeg',
            'image' => 'required',
            'title' => 'required|string',
            'description' => 'required',
            'price' => 'required|numeric',
        ];
    }

    public function messages()
    {
        return [
            'image.required' => 'Image is required',
            'image.image' => 'File must be an image',
            'image.size' => 'Size should not be more than 2 MB',
            'image.mimes' => 'File not recognized.Supported file types are jpg,bmp,png,jpeg',
            'title.required' => 'Title is required',
            'price.required' => 'Price is required',
            'description.required' => 'Description is required',
            'price.numeric' => 'Price must be numeric'
        ];
    }
}
