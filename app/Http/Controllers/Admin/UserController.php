<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('user.status');
        $this->middleware('user.permissions');
        $this->middleware('isadmin');
    }

    public function getUsers($status)
    {
        if ($status == 'all') :
            $users = User::orderBy('id', 'Desc')->paginate(30);
        else :
            $users = User::where('status', $status)->orderBy('id', 'Desc')->paginate(30);
        endif;

        $data = ['users' => $users];

        return view('admin.users.home', get_defined_vars());
    }

    public function getUserView($id)
    {
        $user = User::findOrFail($id);
        $data = ['user', $user];

        return view('admin.users.view', get_defined_vars());
    }

    public function postUserEdit(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->role = $request->input('user_role');

        if ($request->input('user_role') == 1) :
            if (is_null($user->permissions)) :
                $permissions = [
                    'dashboard' => true
                ];
                $permissions = json_encode($permissions);
                $user->permissions = $permissions;
            endif;
        endif;

        if ($user->save()) :
            if ($request->input('user_role') == 1) :

                return redirect('/admin/user/' . $user->id . '/permissions')
                    ->with('message', 'Role actualizado')
                    ->with('typealert', 'success');
            else :
                return back()
                    ->with('message', 'Rol Actualizado')
                    ->with('typealert', 'success');
            endif;
        endif;
    }


    public function getUserBanned($id)
    {
        $user = User::findOrFail($id);
        if ($user->status == 100) :
            $user->status = 0;
            $message = "Usuario Reactivado.";
        else :
            $user->status = 100;
            $message = "Usuario Suspendido con éxito.";
        endif;

        if ($user->save()) :
            return back()
                ->with('message', $message)
                ->with('typealert', 'success');

        endif;
    }

    public function getUserPermissions($id)
    {
        $user = User::findOrFail($id);
        $data = ['user' => $user];

        return view('admin.users.permissions', $data);
    }

    public function postUserPermissions(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->permissions = $request->except(['_token']);

        if ($user->save()) :
            return back()
                ->with('message', 'Permiso asignado correctmente')
                ->with('typealert', 'success');
        endif;
    }
}
