<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $table = 'reviews';

    protected $fillable = [
        'user_id',
        'product_id',
        'user_type',
        'message',
        'rating',
        'status'
    ];

    public function getActiveStatusAttribute()
    {
        if ($this->status == 1) {
            return [
                'status' => 'badge badge-success',
                'message' => 'Replied',
            ];
        } else {
            return [
                'status' => 'badge badge-danger',
                'message' => 'Not Replied',
            ];
        }
    }

    public function product()
    {
        return $this->belongsTo(Product::class,'product_id','id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function retailer()
    {
        return $this->belongsTo(Retailer::class);
    }
}