<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $table = 'menus';

    protected $fillable = [
        'menu_title',
        'menu_category_id',
        'mega_menu',
        'category_id',
        'type',
        'order',
        'sub_url',
        'url',
        'status'
    ];

    public function menu_category()
    {
        return $this->belongsTo(MenuCategory::class, 'menu_category_id');
    }


    public function menu_items()
    {
        return $this->hasMany(MenuItem::class);
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
