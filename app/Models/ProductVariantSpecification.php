<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use GhanuZ\FindInSet\FindInSetRelationTrait;

class ProductVariantSpecification extends Model
{
    use HasFactory;
    use SoftDeletes;
    use FindInSetRelationTrait;

    protected $table = 'product_variant_specifications';

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'product_variant_id',
        'product_id',
        'attribute_id',
        'attribute_term_id',
        'type',
        'estatus',
    ];

    public function attribute(){
        return $this->hasOne(Attribute::class,'id','attribute_id');
    }

    public function attribute_term(){
        return $this->hasOne(AttributeTerm::class,'id','attribute_term_id');
    }

    // public function attribute_termc(){
    //     return $this->FindInSetOne(AttributeTerm::class,'id','attribute_term_id');
    // }

    public function attribute_terms(){
        return $this->FindInSetOne(AttributeTerm::class,'attribute_term_id','id');
    }
}
