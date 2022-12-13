<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Banner extends Model
{
    protected $table = 'banners';

    protected $fillable = [
        'title',
        'description',
        'slug',
        'url',
        'image',
        'status'
    ];

    public function setTitleAttribute($value)
    {
        $this->attributes['title'] = $value;

        $this->attributes['slug'] = Str::slug($value);
        // $this->attributes['slug'] = str_replace(' ', '-', $value);
    }

    public function getBannerImageAttribute()
    {
        return 'Asset/Uploads/Banner/' . $this->attributes['image'];
    }


    // For getting Banner Active Status
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

    public function getBannerDetailsAttribute()
    {
        return [
            'title' => $this->title ?? 'Not Available',
            'description' => $this->description ?? 'Not Available',
            'slug' => $this->slug ?? '',
            'image' => $this->image ? 'Asset/Uploads/Banner/' . $this->attributes['image'] : 'Asset/Uploads/Default/' . $defaultImage,

        ];
    }
}
