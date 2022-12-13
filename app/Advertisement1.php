<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Advertisement1 extends Model
{
    protected $table="advertisements1";
    protected $fillable=['title','url','link'];
    public $timestamps = false;
}