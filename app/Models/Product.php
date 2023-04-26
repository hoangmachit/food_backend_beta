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
        'user_id'
    ];
    public function getThumbnailAttribute()
    {
        return asset('uploads/product/'.$this->image);
    }
}