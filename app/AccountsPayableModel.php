<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AccountsPayableModel extends Model
{
    protected $table = 'tbl_accounts_payables';

    protected $fillable = [
    	'party_id',
    	'accounts_credited',
    	'expected_payments_date',
    	'total_amount',
    	'description'
    ];
}
