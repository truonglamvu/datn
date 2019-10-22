<?php namespace App\Repository\Post;

use Illuminate\Database\Eloquent\Model;

class PostModel extends Model {

	/**
	 * The database table used by the model.
	 *
	 * @var  string
	 */
	protected $table = 'posts';

	protected $fillable=[
    	'content', 'title', 'url', 'description_parameter', 'method', 'active', 'user_id', 'menu_id', 'data_return', 'error', 'header'
    ];

    public function user(){
        return $this->belongsTo('App\Repository\Users\UsersModel');
}

    public function menu(){
        return $this->belongsTo('App\Repository\Menus\MenusModel');
    }

    public function getMethod()
    {
        $method = '';
        switch ($this->method) {
            case '1':
                $method = "GET";
                break;

            case '2':
                $method = "POST";
                break;

            case '3':
                $method = "PUT";
                break;

            case '4':
                $method = "PATCH";
                break;

            case '5':
                $method = "DELETE";
                break;
        }

        return $method;
    }

    public function getParamater()
    {
        return unserialize($this->description_parameter);
    }

    public function getError()
    {
        return unserialize($this->error);
    }

    public function getHeader()
    {
        return unserialize($this->header);
    }
    
    // public function getDescriptionParameterAttribute($value)
    // {
    //     return unserialize($value);
    // }

    // public function getErrorAttribute($value)
    // {
    //     return unserialize($value);
    // }

    // public function getHeaderAttribute($value)
    // {
    //     return unserialize($value);
    // }
}
