<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePostRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            "title"=> "required|min:5|unique:posts",
            "category"=> "required|exists:categories,id" ,
            "description"=> "required|min:10",
            "photos"=>"required",
            "photos.*"=>"mimes:jpg,jpeg,png|file|max:512",
            "feature_image"=> "nullable|mimes:jpg,jpeg,png|file|max:512"
        ];
    }
}
