<?php echo '<?php';
$interfaceName = strtolower($repository.'Interface');
?> namespace App\Repository\{{$repository}};

use Illuminate\Support\Facades\Facade;

class {{$repository}}Facade extends Facade
{
    /**
     * Get the registered name of the repository.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'App\Repository\{{$repository}}\{{$repository}}Repository';
    }
}
