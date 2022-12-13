<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;

class SubCategory extends Model
{
    public function setNameAttribute($value)
    {
        $this->attributes['name'] = $value;

        $this->attributes['slug'] = Str::slug($value);
    }

    public function getFeaturedStatusAttribute()
    {
        if ($this->is_featured == 1) {
            return [
                'status' => 'fas fa-check text-success fa-2x',
            ];
        } else {
            return [
                'status' => 'fas fa-times text-danger fa-2x',
            ];
        }
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

    public function getSubCategoryDetailsAttribute()
    {
        return [
            'name' => Str::limit($this->name, 30),
            'category' => $this->category->name,
            'slug' => $this->slug ?? '',
            'image' => 'Asset/Uploads/Sub-Categories/' . $this->attributes['image'],
            'created_date' => Carbon::parse($this->created_at)->format('m/d/Y'),
            'updated_date' => Carbon::parse($this->updated_at)->format('m/d/Y'),
            'products_count' => $this->products->count() ?? '',
        ];
    }


    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function brands()
    {
        return $this->hasMany(Brand::class);
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
