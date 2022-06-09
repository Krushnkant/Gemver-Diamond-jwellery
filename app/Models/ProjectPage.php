<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProjectPage extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'project_pages';

    protected $dates = ['deleted_at'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'parent_menu',
        'label',
        'route_url',
        'is_display_in_menu',
        'estatus',
    ];

}
