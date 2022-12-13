<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    use Notifiable;

    protected $guard = 'admin';

    protected $fillable = [
        'name', 'email', 'password',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function getSuperAdminAttribute()
    {
        if ($this->is_super == 1) {
            return [
                'status' => 'badge badge-success',
                'message' => 'Yes',
            ];
        } else {
            return [
                'status' => 'badge badge-danger',
                'message' => 'No',
            ];
        }
    }
}
