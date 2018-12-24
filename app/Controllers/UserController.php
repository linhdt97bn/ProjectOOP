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
        return view('user.add');
    }

    public function store()
    {
        $request = new Request();

        foreach ($request->all() as $value) {
            if (empty($value)) {
                return view('error.validate');
            }
        }

        $user = User::create($request->only(['username', 'password', 'email']));
        dd($user);
    }

    public function update($id)
    {
        User::find($id)->update(['username' => 'update_user', 'password' => '123456789']);
        return view('user.add', ['user' => 'ok']);
    }

    public function destroy($id)
    {
        $user = User::find($id);
        if (!empty($user)) {
            $user->delete();
        }
        header('location:/ProjectOOP/user');
    }
}
