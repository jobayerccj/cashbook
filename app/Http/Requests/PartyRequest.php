<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class PartyRequest extends Request
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
            'party_name' => ['required','min:3'],
            'party_email' => 'email',
            'party_phone' => 'required',
            'party_address' => 'required'
        ];
    }
}
