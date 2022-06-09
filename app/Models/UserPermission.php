<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserPermission extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'user_permissions';

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'user_id',
        'project_page_id',
        'can_read',
        'can_write',
        'can_delete',
        'estatus',
    ];

    public function project_page(){
        return $this->hasOne(ProjectPage::class,'id','project_page_id');
    }

}
