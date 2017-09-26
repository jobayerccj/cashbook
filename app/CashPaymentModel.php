<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CashPaymentModel extends Model
{
    protected $table = 'tbl_cash_payments';

    /*protected $fillable = [
    	'party_id',
    	'accounts_credited',
    	'expected_payments_date',
    	'total_amount',
    	'description'
    ];*/
}
