<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

class Category extends Model
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

    public function getCategoryDetailsAttribute()
    {
        // $siteSetting = SiteSetting::select('default_image')->get()->toArray();

        // $defaultImage = $siteSetting[0]['default_image'];

        return [
            'name' => Str::limit($this->name, 30),
            'slug' => $this->slug ?? '',
            'image' => 'Asset/Uploads/Categories/' . $this->attributes['image'] ?? 'Asset/Uploads/Default/default.png',
            'created_date' => Carbon::parse($this->created_at)->format('m/d/Y'),
            'updated_date' => Carbon::parse($this->updated_at)->format('m/d/Y'),

        ];
    }


    public function sub_categories()
    {
        return $this->hasMany(SubCategory::class);
    }

    public function brands()
    {
        return $this->hasMany(Brand::class);
    }
}
