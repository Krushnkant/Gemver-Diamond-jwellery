<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AttributeTerm extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'attribute_terms';

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'attrterm_name',
        'attrterm_thumb',
        'estatus',
        'attribute_id'
    ];

    public function attribute(){
        return $this->hasOne(Attribute::class,'id','attribute_id');
    }
}
