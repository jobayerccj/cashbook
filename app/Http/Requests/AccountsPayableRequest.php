<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class AccountsPayableRequest extends Request
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
            'accounts_credited' => 'required|integer|min:1',
            'expected_payments_date' => 'required|date',
            'total_amount' => 'required|numeric|min:1'
        ];
    }
}
