<?php

namespace App\Http\Requests\User;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules;
use Illuminate\Validation\Rule;

class ResponsablePostResquest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|min:5',
            'email' => 'required|string|email|max:255|unique:'.User::class,
            'password' => ['required', 'confirmed', Rules\Password::defaults() ],
            'genre' => 'required|max:1',
            'birthday' => 'required|date',
            'notifications' => 'required',
            'condominia_id' => 'exists:condominias,id',
            // verificar existencia na tabela roles
            'role_id' => 'required',
            'person' => [
                'required','max:11',
                // Rule::unique('accounts')->ignore($this->user_id, 'user_id')
                Rule::unique('accounts')
            ],
            'telephone' => 'min:10|max:11',
            'phone'=>'',
        ];
    }
}
