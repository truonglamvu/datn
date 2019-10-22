<?php echo '<?php'; ?> namespace App\Repository\{{$repository}};

use Illuminate\Database\Eloquent\Model;

class {{$repository}}Model extends Model {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = '{{$table}}';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [];

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = [];

}
