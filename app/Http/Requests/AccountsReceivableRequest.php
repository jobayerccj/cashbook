<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class AccountsReceivableRequest extends Request
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
            'party_id' => ['required'],
            'accounts_debited' => 'required|integer|min:1',
            'expected_receieving_date' => 'required|date|after:today',
            'total_amount' => 'required|numeric|min:1'
        ];
    }
}
