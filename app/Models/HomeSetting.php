<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HomeSetting extends Model
{
    use HasFactory;

    public function category(){
        return $this->hasOne(Category::class,'id','section_customise_link');
    }
}
