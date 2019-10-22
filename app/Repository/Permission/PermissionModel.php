<?php namespace App\Repository\Permission;

use Illuminate\Database\Eloquent\Model;
use Zizaco\Entrust\EntrustPermission;

class PermissionModel extends EntrustPermission {

	/**
	 * The database table used by the model.
	 *
	 * @var  string
	 */
	protected $table = 'permissions';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var  array
	 */
	protected $fillable = [
    	'name', 'display_name', 'description'
    ];
    
    public function roles(){
     	return $this->belongsToMany('App\Repository\Role\RoleModel','permission_role','permission_id', 'role_id');
    }

}
