<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class RoleController extends Controller
{
#membuat function index untuk menampilkan data role
    public function index()
    {
        $roles = DB::table('view_role')->get();

        return view('role.index', compact('roles'));
    }

#membuat function create untuk menampilkan form create role
        public function create()
    {
        return view('role.create');
    }

#membuat function update untuk mengupdate data role
        public function update(Request $request, $id)
    {
        $nama_role = $request->input('nama_role');

        DB::update(
            'UPDATE role SET nama_role = ? WHERE idrole = ?',
            [$nama_role, $id]
        );

        return redirect('/role');
    }

#membuat function delate untuk menghapus data role
        public function destroy($id)
    {
            DB::delete(
                'DELETE FROM role WHERE idrole = ?',
                [$id]
            );

            return redirect('/role');
    }

#membuat function edit untuk menampilkan form edit role
    public function edit($id)
    {
        $role = DB::select(
            'SELECT * FROM role WHERE idrole = ?',
            [$id]
        );

        return view('role.edit', compact('role'));
    }


#membuat function store untuk menyimpan data role ke database
        public function store(Request $request)
    {
        $nama_role = $request->input('nama_role');

        DB::insert(
            'INSERT INTO role (nama_role) VALUES (?)',
            [$nama_role]
        );

        return redirect('/role');
}
}
