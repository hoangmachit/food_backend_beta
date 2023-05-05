<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $table = 'product';
    protected $appends = array('thumbnail');
    protected $fillable = [
        'name',
        'desc',
        'price',
        'image',
        'status',
        'status_payment',
        'buy',
        'user_id'
    ];
    public function getThumbnailAttribute()
    {
        $image =  $this->image && $this->image != "" ? 'uploads/product/' . $this->image : "/image/no-image.gif";
        return asset($image);
    }
}
