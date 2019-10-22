<?php namespace App\Repository\Post;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class PostTestCase extends TestCase
{
    /**
     * A basic functional test example.
     *
     * @return  void
     */
    public function PostTestExample()
    {
        $this->visit('/')
             ->see('This is Unit Test')
             ->dontSee('Rails');
    }
}