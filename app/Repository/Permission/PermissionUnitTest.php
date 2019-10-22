<?php namespace App\Repository\Permission;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class PermissionTestCase extends TestCase
{
    /**
     * A basic functional test example.
     *
     * @return  void
     */
    public function PermissionTestExample()
    {
        $this->visit('/')
             ->see('This is Unit Test')
             ->dontSee('Rails');
    }
}