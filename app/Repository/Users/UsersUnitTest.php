<?php namespace App\Repository\Users;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class UsersTestCase extends TestCase
{
    /**
     * A basic functional test example.
     *
     * @return  void
     */
    public function UsersTestExample()
    {
        $this->visit('/')
             ->see('This is Unit Test')
             ->dontSee('Rails');
    }
}