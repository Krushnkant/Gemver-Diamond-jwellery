<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemCart extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id','item_id','item_type','specification','item_quantity','certificate','certificate_price'
      ];
}
