<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = [
        'ip_address',
        'category_id',
        'diamond_id',
        'veriant_id',
        'specification_term_id',
    ];
}
