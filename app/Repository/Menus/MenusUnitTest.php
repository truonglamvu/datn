<?php namespace App\Repository\Menus;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class MenusTestCase extends TestCase
{
    /**
     * A basic functional test example.
     *
     * @return  void
     */
    public function MenusTestExample()
    {
        $this->visit('/')
             ->see('This is Unit Test')
             ->dontSee('Rails');
    }
}