<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductVariant extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'product_variants';

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'product_id',
        'product_title',
        'images',
        'regular_price',
        'sale_price',
        'auto_discount_rs',
        'auto_discount_percent',
        'sale_price_for_premium_member',
        'estatus',
        'term_item_id',
        'stock',
    ];

    public function product(){
        return $this->hasOne(Product::class,'id','product_id');
    }

    public function product_variant_specification(){
        return $this->hasMany(ProductVariantSpecification::class,'product_variant_id','id');
    }

    public function product_variant_variants(){
        return $this->hasMany(ProductVariantVariant::class,'product_variant_id','id');
    }

    public function attribute_term(){
        return $this->hasOne(AttributeTerm::class,'id','term_item_id');
    }

    public function getVariantImagesAttribute(){
        $images = explode(",",$this->images);
        $arr = array();
        foreach ($images as $image){
            array_push($arr,'public/'.$image);
        }
        return $arr;
    }

    public function wishlist(){
        return $this->hasOne(Wishlist::class,'product_variant_id','id');
    }
}
