<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inquiry extends Model
{
    use HasFactory;
    protected $table = "inquiry";
    protected $fillable = [
    	'name','mobile_no','email','SKU','stone_no','qty','inquiry','specification_term_id','whatsapp_number','country_code_mobile','country_code_whatsapp'
    ];
}