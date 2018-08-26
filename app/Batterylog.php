<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Batterylog extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'batterylogs';


    /**
    * The attributes that aren't mass assignable.
    *
    * @var array
    */
    protected $guarded = [];
}