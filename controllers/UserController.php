<?php 

require "models/User.php";

class UserController
{

	public function index() {
		$result = User::all();
		return view('user.all', compact('result'));
	}

	public function show($userId) {
		$result = User::find($userId);
		return view('user.detail', compact('result'));
	}

	public function create() {
		$arr = [
			'username' => 'user1',
			'email'    => 'user1@gmail.com',
			'password' => '123456',
			'a'        => 'a',
		];
		$result = User::create($arr);
		return view('user.user', compact('result'));
	}

	public function update($id) {
		User::find($id)->update(['username' => 'update_user', 'password' => '123456789']);
		return view('user.user', ['result' => 'ok']);
	}

	public function getUserAndPost($userId, $postId) {
		$result = 'Id user: ' . $userId;
		$result .= '<br>Id post: ' . $postId;
		return view('user.user', compact('result'));
	}
}
