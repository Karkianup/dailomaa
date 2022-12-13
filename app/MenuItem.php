<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MenuItem extends Model
{
    protected $table = 'menu_items';

    protected $fillable = [
        'menu_item_title',
        'menu_id',
        'category_id',
        'type',
        'order',
        'url',
        'route',
        'status'
    ];

    public function menu()
    {
        return $this->belongsTo(Menu::class);
    }
    
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

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
}
