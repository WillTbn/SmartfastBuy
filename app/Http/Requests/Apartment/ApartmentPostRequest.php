<?php

namespace App\Http\Requests\Apartment;

// use Illuminate\Database\Eloquent\Builder;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ApartmentPostRequest extends FormRequest
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
        // Rule::unique('users')->where(fn (Builder $query) => $query->where('account_id', 1))


        return [
            'number' => [
                'required',
                // unique:apartments,number,block_id'
                Rule::unique('apartments')->where(fn($query) => $query->where('block_id',$this->block_id ))
            ],
            'condominia_id' => 'required|exists:condominias,id',
            'floor' => '',
            'block_id' =>   'required|exists:blocks,id'
        ];
    }
}
