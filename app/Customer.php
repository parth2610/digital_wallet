<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    //
    protected $fillable = [
        'id','first_name', 'last_name', 'email','amount','balance','created_at','updated_at'
       ];
   
}
