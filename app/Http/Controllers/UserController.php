<?php

namespace App\Http\Controllers;

use GuzzleHttp\Middleware;
use Illuminate\Http\Request;
use Validator, Image, Auth, Config, Str, Hash;
use App\Models\User;


class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function getAccountEdit(Request $request)
    {
        $birthday = (is_null(Auth::user()->birthday)) ? [null,null,null] : $birthday = explode('-', Auth::user()->birthday);
        
        $data = ['birthday' => $birthday];
        
        return view('users.account_edit', $data);
    }

    public function postAccountAvatar(Request $request)
    {
        $rules = [
            'avatar' => 'required',
        ];

        $messages = [
            'avatar.required' => 'Debe agregar un nombre al Producto',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) :
            return back()->withErrors($validator)
                ->with('message', 'Se ha producido un error')
                ->with('typealert', 'danger')
                ->withInput();
        else :
            if ($request->hasFile('avatar')) :
                $path = '/' . Auth::id();
                $fileExt = trim($request->file('avatar')->getClientOriginalExtension());
                $upload_path = Config::get('filesystems.disks.uploads_users.root');
                $name = Str::slug(str_replace($fileExt, '', $request->file('avatar')->getClientOriginalName()));
                $fileName = rand(1, 999) . '_' . $name . '.' . $fileExt;
                $finalFile = $upload_path . '/' . $path . '/' . $fileName;

                // Add Avatar
                $user = User::find(Auth::id());
                $avatar = $user->avatar;
                $user->avatar = $fileName;

                if ($user->save()) :
                    if ($request->hasFile('avatar')) :
                        $fl = $request->avatar->storeAs($path, $fileName, 'uploads_users');
                        $img = Image::make($finalFile);
                        $img->fit(256, 256, function ($constraint) {
                            $constraint->upsize();
                        });
                        $img->save($upload_path . '/' . $path . '/av_' . $fileName);
                    endif;

                    unlink($upload_path . '/' . $path . '/' . $avatar);
                    unlink($upload_path . '/' . $path . '/av_' . $avatar);

                    return back()
                        ->with('message', 'Avatar subido con éxito.')
                        ->with('typealert', 'success');
                endif;
            endif;
        endif;
    }

    public function postAccountPassword(Request $request)
    {
        $rules = [
            'apassword' => 'required|min:8',
            'password'  => 'required|min:8',
            'cpassword' => 'required|min:8|same:password',
        ];

        $messages = [
            'apassword.required'    => 'Escriba su contraseña actual',
            'apassword.min'         => 'La contraseña actual debe tener 8 caracteres',
            'password.required'     => 'Escriba la nueva contraseña',
            'password.min'          => 'Su contraseña nueva debe contar con al menos 8 caracteres',
            'cpassword.required'    => 'Debe confirmar la nueva contraseña',
            'cpassword.min'         => 'La nueva contrasenna debe contar con al menos 8 caracteres',
            'cpassword.same'        => 'Las contraseñas no coinciden'
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) :
            return back()->withErrors($validator)
                ->with('message', 'Se ha producido un error')
                ->with('typealert', 'danger')
                ->withInput();
        else:
            $user = User::find(Auth::id());
            if (Hash::check($request->input('apassword'), $user->password)):
                $user->password = Hash::make($request->input('password'));
                if ($user->save()):
                    return back()->with('message', 'Contraseña actualizada con éxito')->with('typealert', 'success');
                endif;
            else:
                return back()->with('message', 'Su contraseña actual es incorecta')->with('typealert', 'danger');
            endif;
        endif;
    }

    public function postAccountInfo(Request $request){

        $rules = [
            'name'      => 'required',
            'lastname'  => 'required',
            'phone'     => 'required',
            'year'      => 'required',
            'day'       =>  'required'
        ];

        $messages = [
            'name.required'         => 'Su nombre es requerido',
            'lastname.required'     => 'Su apellido es requerido',
            'phone.required'        => 'Su número de teléfono es requerido',
            'password.min'          => 'Su contraseña nueva debe contar con al menos 8 caracteres',
            'year.required'         => 'Su año de nacimiento es requerido',
            'day.requerido'         => 'Su año de nacimiento es requerido',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if($validator->fails()):
            return back()->withErrors($validator)
                ->with('message', 'Se ha producido un error')
                ->with('typealert', 'danger')
                ->withInput();
        else:
            $date = $request->input('year').'-'.$request->input('month').'-'.$request->input('day');
            
            $user = User::find(Auth::id());
            $user->name         = e($request->input('name'));
            $user->lastname     = e($request->input('lastname'));
            $user->phone        = e($request->input('phone'));
            $user->birthday     = date("Y-m-d",strtotime($date));
            $user->gender       = e($request->input('gender'));

            if($user->save()):
                return back()->with('message', 'Su información ha sido actualizada correctamente')->with('typealert', 'success');
            endif;
        endif;

    }
}
