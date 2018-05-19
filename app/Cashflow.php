<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cashflow extends Model
{
    protected $table = 'cashflow';

    protected $fillable = ['name', 'description', 'amount', 'flow_type', 'balance'];
}
