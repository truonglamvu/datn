<?php namespace App\Repository\Menus;

use Illuminate\Database\Eloquent\Model;

class MenusModel extends Model {

	/**
	 * The database table used by the model.
	 *
	 * @var  string
	 */
	protected $table = 'menus';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var  array
	 */
	protected $fillable = [
		'menu_name', 'type', 'parent_id', 'visible_on','id'
	];

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var  array
	 */
	protected $hidden = [];

	public function posts(){
		return $this->hasMany('App\Repository\Post\PostModel','menu_id','id');
	}


	public function scopeParent($query)
	{
		return $query->where('parent_id',0)
					 ->orderBy('id','asc');
	}

	public function getVisibleOnAttribute($value){
		$data = unserialize($value);
		return (is_array($data)) ? $data : [];
	}
}
