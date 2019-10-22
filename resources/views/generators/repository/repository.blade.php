<?php echo '<?php' ?> namespace App\Repository\{{$repository}};

use App\Repository\Repository;

class {{$repository}}Repository extends Repository implements {{$repository}}Interface
{
	/**
     * get model
     * @return string
     */
    public function model()
    {
        return "App\Repository\{{$repository}}\{{$repository}}Model";
    }
}