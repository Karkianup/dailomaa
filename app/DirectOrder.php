<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class DirectOrder extends Model
{
    const ORDER_COMPLETE = 1;
    const ORDER_CANCELLED = 2;
    const ORDER_DELIVERED = 3;
    const ORDER_OUT_FOR_DELIVERY = 4;

    protected $tables = 'direct_orders';

    protected $attributes = [
        'status' => self::ORDER_COMPLETE,
    ];

    public function getOrderDetailsAttribute()
    {
        return [
            'ordered_date' => Carbon::parse($this->created_at)->format('m/d/Y') ?? '',
            'name' => $this->name ?? '',
            'contact_number' => $this->contact_number ?? '',
            'address' => $this->address ?? '',
            'body' => $this->body ?? '',

        ];
    }
}
