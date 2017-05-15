<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ServiceQ extends Model
{
    //
    protected $table = 'service_questions';
    protected $primaryKey = 'ID';
    public $timestamp = false;
}
