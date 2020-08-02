<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    //
    protected $fillable = [
        'id','customer_id', 'amount', 'currency','status','created_at','updated_at'
       ];
}
