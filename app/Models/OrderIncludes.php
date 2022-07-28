<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderIncludes extends Model
{
    use HasFactory;

    public function orderincludesdata(){
        return $this->hasMany(OrderIncludesData::class,'order_id','id');
    }
}
