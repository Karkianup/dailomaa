<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SiteSetting extends Model
{
    public function getSiteDefaultImageAttribute()
    {
        return 'Asset/Uploads/Default/' . $this->attributes['default_image'];
    }
}
