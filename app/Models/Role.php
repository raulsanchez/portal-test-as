<?php
namespace App\Models;

use Zizaco\Entrust\EntrustRole;

class Role extends EntrustRole
{
    protected $fillable = ['name', 'display_name', 'description', 'created_at', 'updated_at'];

    public function modules()
    {
        return $this->belongsToMany('App\Models\Module');
    }
}
