<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MegaMenu extends Model
{
    use HasFactory;

    public function sub_menu(){
        return $this->hasMany(SubMenu::class,'mega_menu_id','id');
    }

    public function sub_category(){
        return $this->hasMany(MenuCategory::class,'menu_id','id');
    }
}
