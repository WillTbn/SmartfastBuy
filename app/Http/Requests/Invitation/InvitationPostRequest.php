<?php

namespace App\Http\Requests\Invitation;

use App\Models\AccountClient;
use App\Models\Client;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
class InvitationPostRequest extends FormRequest
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
        return [
            'name' => 'required|string',
            'email'=> ['email', 'max:255', Rule::unique(Client::class)],
            'person' => ['required', 'min:14', Rule::unique(AccountClient::class)],
            'birthday' => 'required|date',
            'apartment_id' => 'required|exists:apartments,id'
        ];
    }
}
