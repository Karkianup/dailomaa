<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class PaymentMethod extends Model
{
    protected $table = 'payment_methods';

    protected $fillable = [
        'title',
        'url',
        'slug',
        'image',
        'status'
    ];

    public function setTitleAttribute($value)
    {
        $this->attributes['title'] = $value;

        $this->attributes['slug'] = Str::slug($value);
        // $this->attributes['slug'] = str_replace(' ', '-', $value);
    }

    // For getting Page Active Status
    public function getActiveStatusAttribute()
    {
        if ($this->status == 1) {
            return [
                'status' => 'badge badge-success',
                'message' => 'Active',
            ];
        } else {
            return [
                'status' => 'badge badge-danger',
                'message' => 'InActive',
            ];
        }
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
