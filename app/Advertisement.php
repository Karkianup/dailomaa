<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Advertisement extends Model
{
    protected $table="advertisements";
    protected $fillable=["title","url",'link'];
    public $timestamps = false;


}