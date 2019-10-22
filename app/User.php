<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Zizaco\Entrust\Traits\EntrustUserTrait;
class User extends Model
{
    use Notifiable, EntrustUserTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    // protected $fillable = [
    //     'name', 'email', 'password', 'date_of_birth', 'address', 'gender', 'phone','login_name','avarta', 'status',
    // ];
    // public $timestamps = false;

    // /**
    //  * The attributes that should be hidden for arrays.
    //  *
    //  * @var array
    //  */
    // protected $hidden = [
    //     'password', 'remember_token',
    // ];

    // public function user_roles(){
    //     return $this->hasMany('App\UserRole');
    // }

    // public function roles(){
    //     // dd('vao day');
    //     return $this->belongsToMany('App\Repository\Role\RoleModel','role_user');
    // }

    // public function posts(){
    //     return $this->hasMany('App\Repository\Post\PostModel');
    // }

    // public function hasRole($role)
    // {
    //     $role = $this->roles()->where('name', $role)->first();
    //     return (!empty($role));
    // }

    
}
