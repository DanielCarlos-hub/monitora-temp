<?php

namespace App\Http\Controllers\Dashboard\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Support\ExceptionTreatment;
use Illuminate\Http\Request;

class UsersController extends Controller
{

    public function index(Request $request)
    {
        if($request->ajax()){

            $users = User::all();

            return datatables()->of($users)->make(true);
        }

        return view('dashboard.admin.usuarios.index');
    }

    public function create()
    {
        return view('dashboard.admin.usuarios.create');
    }

    public function store(Request $request)
    {
        try {

            $user = $request->user;

            User::create($user);

            $notification = array(
                'message' => 'Novo usuário foi adicionado',
                'alert-type' => 'success'
            );

            return redirect()->route('dashboard.admin.usuarios.index')->with($notification);

        } catch (\Exception $e) {
            return back()->with((new ExceptionTreatment($e, 'Usuário'))->getMessage());
        }
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        try {

            $user = User::findOrFail($id);

            return view('dashboard.admin.usuarios.edit', compact('user'));

        } catch (\Exception $e) {

            return back()->with((new ExceptionTreatment($e, 'Usuário'))->getMessage());
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $user = User::findOrFail($id);

            $user->update([
                'nome' => $request->nome,
                'email' => $request->email,
                'username' => $request->username,
            ]);

            $notification = array(
                'message' => 'Usuário atualizado',
                'alert-type' => 'success'
            );

            return redirect()->route('dashboard.admin.usuarios.index')->with($notification);

        } catch (\Exception $e) {

            return back()->with((new ExceptionTreatment($e, 'Usuário'))->getMessage());
        }
    }

    public function destroy($id)
    {
        //
    }
}
