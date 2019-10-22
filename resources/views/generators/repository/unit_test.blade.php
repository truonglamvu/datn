<?php echo '<?php' ?> namespace App\Repository\{{$repository}};

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class {{$repository}}TestCase extends TestCase
{
    /**
     * A basic functional test example.
     *
     * @return void
     */
    public function {{$repository}}TestExample()
    {
        $this->visit('/')
             ->see('This is Unit Test')
             ->dontSee('Rails');
    }
}