<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NewsArticle extends Model
{
    use HasFactory;

    public function getImageUrlAttribute()
    {
        if (!$this->image) {
            return null;
        }

        return url($this->image);
    }

}
