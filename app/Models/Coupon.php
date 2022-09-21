<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Coupon extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'coupons';

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'coupon_code',
        'discount_type_id',
        'coupon_amount',
        'allow_cod',
        'usage_per_user',
        'expiry_date',
        'estatus',
    ];

    public function discount_type(){
        return $this->hasOne(DiscountType::class,'id','discount_type_id');
    }
}
