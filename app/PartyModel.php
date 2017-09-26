<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PartyModel extends Model
{
    protected $table = 'tbl_parties';

    protected $fillable = [
    	'party_name',
    	'party_email',
    	'party_phone',
    	'party_address'
    ];
}
