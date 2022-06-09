<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    use SoftDeletes;

    protected $table = 'users';

    protected $dates = ['deleted_at'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'parent_user_id','email','password','username','first_name','last_name','full_name','mobile_no','gst_no','pickup_location','profile_pic','gender',
        'role','estatus','dob','otp','otp_created_at','referral_id','decrypted_password','category_ids'
    ];
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getProfilePicAttribute(){
        if($this->attributes['profile_pic'] != null){
            return asset('images/profile_pic/'.$this->attributes['profile_pic']);
        }else{
            return null;
        }
    }

    public function cover_photos(){
        return $this->hasMany(UserCoverPhotos::class,'user_id','id');
    }

    public function getCountryAttribute(){
        $country = Country::where('id',$this->attributes['country'])->pluck('name')->first();
        return $country;
    }

    public function getStateAttribute(){
        $State = State::where('id',$this->attributes['state'])->pluck('name')->first();
        return $State;
    }

    public function getCityAttribute(){
        $City = City::where('id',$this->attributes['city'])->pluck('name')->first();
        return $City;
    }
}
