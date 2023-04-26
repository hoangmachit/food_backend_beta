<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Payment;
use App\Models\OrderDetail;
use App\Models\OrderStatus;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'order';
    protected $fillable = [
        'token_id',
        'user_name',
        'phone_number',
        'total',
        'payment_id',
        'order_status_id'
    ];
    public function payment()
    {
        return $this->hasOne(Payment::class, 'id', 'payment_id');
    }
    public function order_status()
    {
        return $this->hasOne(OrderStatus::class, 'id', 'order_status_id');
    }
    public function order_detail()
    {
        return $this->hasMany(OrderDetail::class, 'order_id', 'id');
    }
}