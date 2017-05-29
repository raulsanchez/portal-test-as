<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Module extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'parent_id',
        'order',
        'name',
        'type_link',
        'link',
        'icon',
        'visualize',
        'status',
        'created_at',
        'updated_at',
    ];
    protected $dates = ['deleted_at'];

    protected $hidden = ['created_at', 'updated_at', 'deleted_at'];

    public function roles()
    {
        return $this->belongsToMany('App\Models\Role');
    }

    public function parent()
    {
        return $this->belongsTo('App\Models\Module', 'parent_id', 'id') ;
    }
    public function childs()
    {
        return $this->hasMany('App\Models\Module', 'parent_id', 'id') ;
    }

    public function isVisible()
    {
        if ($this->visualize == "si") :
            return true;
        endif;
        return false;
    }
    public function isActive()
    {
        if ($this->status == "activo") :
            return true;
        endif;
        return false;
    }
}
