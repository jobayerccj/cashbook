<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AccountsReceivableModel extends Model
{
    protected $table = 'tbl_accounts_receivables';

    protected $fillable = [
    	'party_id',
    	'accounts_debited',
    	'expected_receieving_date',
    	'total_amount',
    	'description'
    ];
}
