<?php namespace App\Repository\Post;
interface PostInterface {
	public function createPost(Array $params);

	public function createPostDemo(Array $params);

	public function updatePost(Array $params, $id);

	public function getMethod();

}
