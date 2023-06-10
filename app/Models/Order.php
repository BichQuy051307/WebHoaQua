<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
//Chứa các Class định nghĩa các thành phần để thao tác với CSDL
class Order extends Model
{
	protected $table = 'orders';
	protected $fillable  = [
		'order_id', 'user_id', 'name', 'phone', 'email', 'address',
		'customer_notes', 'notes',
		'amount', 'score_awards', 'status', 'censor_id'
	];

    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class, 'order_id', 'order_id');
    }

    public function censor()
    {
        return $this->belongsTo(User::class, 'censor_id');
    }
}
