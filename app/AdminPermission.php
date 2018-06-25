<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdminPermission extends Model
{
//    protected $table = 'admin_roles';
    public function roles(){
        return $this->belongsToMany('App\AdminRole','admin_permissions_role','role_id','permissions_id')
            ->withPivot(['role_id','user_id']);
    }
}
