<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class AccountsRequest extends Request
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
            //
            'accounts_title'=>'required|unique:tbl_accounts,accounts_title',
            'accounts_type'	=>'required'
        ];
    }
}
