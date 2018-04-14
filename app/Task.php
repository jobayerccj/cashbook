<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    public static function incomplete(){

    	return static::where('id', 1)->get();
    }
}
