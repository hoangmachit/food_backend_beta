<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Product;

class OrderDetail extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'order_detail';
    protected $fillable = [
        'product_id',
        'name',
        'desc',
        'image',
        'price',
        'quantity',
        'order_id'
    ];
    public function getThumbnailAttribute()
    {
        $image =  $this->image && $this->image != "" ? 'uploads/product/' . $this->image : "/image/no-image.gif";
        return asset($image);
    }
    public function Product()
    {
        return $this->hasOne(Product::class, 'id', 'product_id');
    }
}
