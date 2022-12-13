<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

class Brand extends Model
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

    public function getBrandDetailsAttribute()
    {
        return [
            'name' => Str::limit($this->name, 30),
            'slug' => $this->slug ?? '',
            'category' => $this->category->name ?? '',
            'sub_category' => $this->sub_category->name ?? '',
            'image' => 'Asset/Uploads/Brands/' . $this->attributes['image'],
            'created_date' => Carbon::parse($this->created_at)->format('m/d/Y'),
            'updated_date' => Carbon::parse($this->updated_at)->format('m/d/Y')

        ];
    }


    public function products()
    {
        return $this->hasMany(Product::class);
    }
    public function sub_category()
    {
        return $this->belongsTo(SubCategory::class);
    }
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
