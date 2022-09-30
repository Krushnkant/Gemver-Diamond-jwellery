<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MenuPage extends Model
{
    use HasFactory;

    public function menupageshapestyle(){
        return $this->hasMany(MenuPageShapeStyle::class,'page_id','id');
    }
}
