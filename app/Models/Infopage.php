<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
//use Illuminate\Database\Eloquent\SoftDeletes;

class Infopage extends Model
{
    use HasFactory;
    //use SoftDeletes;

    protected $table = 'pageinfo';

    //protected $dates = ['deleted_at'];

    protected $fillable = [
        'aboutus_image',
        'aboutus_contant', 
    ];
}
