<?php 

require_once 'app/models/User.php';

class UserController
{

    public function index()
    {
        $users = User::all();
        return view('user.all', compact('users'));
    }

    public function show($userId)
    {
        $user = User::find($userId);
        return view('user.detail', compact('user'));
    }

    public function create()
    {
        $arr = [
            'username' => 'user1',
            'email'    => 'user1@gmail.com',
            'password' => '123456',
            'a'        => 'a',
        ];
        $user = User::create($arr);
        return view('user.add', compact('user'));
    }

    public function update($id)
    {
        User::find($id)->update(['username' => 'update_user', 'password' => '123456789']);
        return view('user.add', ['user' => 'ok']);
    }
}
