<?php namespace App\Repository\Role;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class RoleTestCase extends TestCase
{
    /**
     * A basic functional test example.
     *
     * @return  void
     */
    public function RoleTestExample()
    {
        $this->visit('/')
             ->see('This is Unit Test')
             ->dontSee('Rails');
    }
}