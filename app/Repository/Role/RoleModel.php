<?php namespace App\Repository\Role;

use Illuminate\Database\Eloquent\Model;
use Zizaco\Entrust\EntrustRole;

class RoleModel extends EntrustRole {

	/**
	 * The database table used by the model.
	 *
	 * @var  string
	 */
	protected $table = 'roles';

    protected $primaryKey = 'id';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var  array
	 */
	protected $fillable = [
		'name', 'display_name', 'description'
	];

	 public function users(){
    	return $this->belongsToMany('App\Repository\Users\UsersModel','role_user', 'role_id', 'user_id');
    }

    public function permissions(){
        return $this->belongsToMany('App\Repository\Permission\PermissionModel','permission_role','role_id','permission_id');
    }
    
    // public function can($permission)
    // {
    //     $permission = $this->permissions()->where('name', $permission)->first();
    //     return (!empty($permission));
    // }

    public function posts(){
        return $this->hasMany('App\Repository\Post\PostModel');
    }

    public function menus(){
        return $this->belongsToMany('App\Repository\Menus\MenusModel', 'menu_roles', 'role_id', 'menu_id');
    }

    public function perms()
    {
    	return $this->permissions();
    }

}
