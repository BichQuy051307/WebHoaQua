<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
//Chứa các Class định nghĩa các thành phần để thao tác với CSDL
class Category extends Model
{
	protected $table = 'categories';
	protected $fillable  = [
		'name', 'description', 'slug'
	];
}
