<?php

namespace App\Http\Requests\Block;

use Illuminate\Foundation\Http\FormRequest;

class BlockPostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    // public function authorize(): bool
    // {
    //     return false;
    // }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        // unique:blocks,name,except,id
        return [
            'name' =>'required|unique:blocks,name',
            'condominia_id' => 'required|exists:condominias,id'
        ];
    }
}
