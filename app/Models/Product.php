<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'product_name',
        'description',
        'image',
        'user_id',
    ];

    public function getImageThumbUrlAttribute()
    {
        if ($this->image) {
            return url('storage/products/thumbnails/' . $this->image);
        }
    }
    public function getImageUrlAttribute()
    {
        if ($this->image) {
            return url('storage/products/' . $this->image);
        }
    }
}
