<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'categories';

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'sr_no',
        'category_name',
        'parent_category_id',
        'category_thumb',
        'attribute_id_variation',
        'attribute_id_req_spec',
        'attribute_id_opt_spec',
        'estatus',
        'total_products',
        'order_return_days',
    ];

    public function attribute_terms(){
        return $this->hasMany(AttributeTerm::class,'attribute_id','attribute_id_variation');
    }

    public function attributes(){
        return $this->hasOne(Attribute::class,'id','attribute_id_variation');
    }

    public function child()
    {
        return $this->hasMany(Category::class, 'parent_category_id', 'id');
    }

    public function childs()
    {
        return $this->hasMany(Category::class, 'parent_category_id', 'id');
    }

    public function childss()
    {
        return $this->hasMany(Category::class, 'parent_category_id', 'id');
    }
}
