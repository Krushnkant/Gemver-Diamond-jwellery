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

    public function category(){
        return $this->hasOne(Category::class,'id','category_id');
    }

    public function section31_category(){
        return $this->hasOne(Category::class,'id','section31_category_id');
    }

    public function section32_category(){
        return $this->hasOne(Category::class,'id','section32_category_id');
    }

    public function section33_category(){
        return $this->hasOne(Category::class,'id','section33_category_id');
    }
}
