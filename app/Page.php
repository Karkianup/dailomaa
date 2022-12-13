<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use App\SiteSetting;

class Page extends Model
{
    protected $table = 'pages';

    protected $fillable = [
        'title',
        'content',
        'image',
        'slug',
        'status'
    ];

    public function setTitleAttribute($value)
    {
        $this->attributes['title'] = $value;

        $this->attributes['slug'] = Str::slug($value);
        // $this->attributes['slug'] = str_replace(' ', '-', $value);
    }

    public function getPageImageAttribute()
    {
        $siteSetting = SiteSetting::select('default_image')->get()->toArray();

        $defaultImage = $siteSetting[0]['default_image'];

        if ($this->attributes['image']) {
            return 'Asset/Uploads/Page/' . $this->attributes['image'];
        } else {
            // return 'Asset/Uploads/Default/';
            return 'Asset/Uploads/Default/' . $defaultImage;
        }
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
}
