<?php namespace App\Repository\Users;

// use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Auth;
use Zizaco\Entrust\Traits\EntrustUserTrait;

class UsersModel extends Auth {

	use Notifiable, EntrustUserTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'users';

    protected $fillable = [
        'name', 'email', 'password', 'date_of_birth', 'address', 'gender', 'phone','login_name','avarta', 'status',
    ];

    // public $timestamps = false;

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function roles(){
        return $this->belongsToMany('App\Repository\Role\RoleModel','role_user', 'user_id','role_id');
    }

    public function posts(){
        return $this->hasMany('App\Repository\Post\PostModel');
    }

    public function addNew($input)
    {
        $check = static::where('facebook_id',$input['facebook_id'])->first();

        if(is_null($check)){
            return static::create($input);
        }

        return $check;
        
    }

}
