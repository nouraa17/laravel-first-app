<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */

    public function my_rules()
    {
        $arr = [
            'name' => 'required',
            'info' => 'required',
            'price' => 'required|numeric',
        ];
        if ($this->getRequestUri() == '/products'){
            $arr['images'] = 'required|array';
            $arr['images.*'] = 'required|mimes:jpeg,png,jpg,gif,svg|max:2048';
        }
        return $arr;
    }
    public function rules(): array
    {
        return $this->my_rules();
    }
}
