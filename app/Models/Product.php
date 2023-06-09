<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
//Chứa các Class định nghĩa các thành phần để thao tác với CSDL
class Product extends Model
{
	protected $table = 'products';
	protected $fillable  = [
		'name', 'code', 'description', 'category_id', 'slug', 'image', 'price',  'price_sale', 'quantity', 'bought', 'view_count', 'status', 'unit'
	];
}
