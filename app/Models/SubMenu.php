<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubMenu extends Model
{
    use HasFactory;

    

    public function sub_category(){
        return $this->hasMany(MenuCategory::class,'menu_id','id');
    }
}
