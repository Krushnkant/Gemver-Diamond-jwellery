<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
//use Illuminate\Database\Eloquent\SoftDeletes;

class Settings extends Model
{
    use HasFactory;
    //use SoftDeletes;

    protected $table = 'settings';

    //protected $dates = ['deleted_at'];

    protected $fillable = [
        'company_name',
        'company_logo',
        'company_address',
        'company_mobile_no',
        'company_email',
        'youtub_url',
        'instagram_url',
        'twiter_url',
        'tiktok_url',
        'facebook_url',
    ];
}
