<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AccountsModel extends Model
{
    //This model is related to tbl_accounts table
    protected $table='tbl_accounts';
    protected $fillable=['accounts_title','accounts_type'];
}
