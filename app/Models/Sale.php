<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    public function getRouteKeyName(){
		return 'sale_code';
	}
    protected $guarded = [];
}

