<?php

namespace App\Http\Requests\Contents;

use Illuminate\Foundation\Http\FormRequest;

class StoreContent extends FormRequest
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
          'title' => 'required',
          'description' => 'required',
          'thumbnail' => 'nullable|image|max:2048',
          'creator_image' => 'nullable|image|max:2048',
          'category' => 'required',
      ];
    }
}
