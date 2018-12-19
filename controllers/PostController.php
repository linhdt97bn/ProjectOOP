<?php

require "models/Post.php";

class PostController
{

	public function index() {
		$posts = Post::all();
		return view('post.all', compact('posts'));
	}

	public function show($postId) {
		$post = Post::find($postId);
		return view('post.detail', compact('post'));
	}
}