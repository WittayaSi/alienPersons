<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Home extends Model
{
    //
    protected $table = 'homes';
    protected $primaryKey = 'ID';
    public $timestamp = false;
}
