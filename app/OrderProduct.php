<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class OrderProduct extends Model
{
    public function getOrderDetailsAttribute()
    {
        return [
            'product' => $this->product->name ?? '',
            // 'image' => 'Asset/Uploads/Products/' . $this->attributes['main_image'],
            'image' => 'Asset/Uploads/Products/' . $this->product->main_image,
            'ordered_date' => Carbon::parse($this->created_at)->format('m/d/Y') ?? '',
            'delivery_date' => Carbon::parse($this->delivery_date)->format('m/d/Y') ?? '',
            'total_price' => ($this->quantity * $this->unit_price) + $this->shipping_price,
            'unit_price' => $this->unit_price ?? '',
            'random_id' => $this->random_id ?? '',
            'quantity' => $this->quantity ?? '',
            'order_status' => $this->order_status ?? '',

        ];
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function retailer()
    {
        return $this->belongsTo(Retailer::class);
    }

    public function admin()
    {
        return $this->belongsTo(Retailer::class);
    }

    public function order_products()
    {
        return $this->hasMany(OrderProduct::class);
    }
    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}