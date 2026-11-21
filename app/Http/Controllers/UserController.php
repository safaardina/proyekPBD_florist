<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $user = DB::select('SELECT * FROM view_user');

        return view('user.index', compact('user'));
    }

    public function create()
    {
        $role = DB::select('SELECT * FROM role');

        return view('user.create', compact('role'));
    }

    public function store(Request $request)
    {
        $username = $request->input('username');
        $password = bcrypt($request->input('password'));
        $idrole = $request->input('idrole');

        DB::insert(
            'INSERT INTO user (username, password, idrole) VALUES (?, ?, ?)',
            [$username, $password, $idrole]
        );

        return redirect('/user');
    }

    public function edit($id)
    {
        $user = DB::select(
            'SELECT * FROM user WHERE iduser = ?',
            [$id]
        );

        $role = DB::select('SELECT * FROM role');

        return view('user.edit', compact('user', 'role'));
    }

    public function update(Request $request, $id)
    {
        $username = $request->input('username');
        $idrole = $request->input('idrole');
        $password = $request->input('password');

        if ($password != '') {
            $password = bcrypt($password);

            DB::update(
                'UPDATE user SET username = ?, password = ?, idrole = ? WHERE iduser = ?',
                [$username, $password, $idrole, $id]
            );
        } else {
            DB::update(
                'UPDATE user SET username = ?, idrole = ? WHERE iduser = ?',
                [$username, $idrole, $id]
            );
        }

        return redirect('/user');
    }

    public function destroy($id)
    {
        DB::delete(
            'DELETE FROM user WHERE iduser = ?',
            [$id]
        );

        return redirect('/user');
    }
}
