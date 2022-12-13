<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $table = 'contacts';

    protected $fillable = [
        'subject',
        'name',
        'email',
        'phone_number',
        'message',
        'reply',
        'status',
    ];
}
