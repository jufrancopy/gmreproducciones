<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Validator, Hash, Auth, Mail, Str;
use App\Mail\UserSendRecover, App\Mail\UserSendNewPassword;
use App\Models\User;

class ConnectController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest')->except(['getLogout']);
    }

    public function getLogin()
    {
        return view('connect.login');
    }

    public function postLogin(Request $request)
    {
        $rules = [
            'email'     => 'required|email',
            'password'  => 'required|min:8'
        ];

        $messages = [
            'email.required'        => 'Correo electrónico es requerido.',
            'email.email'           => 'Formato de correo inválido.',
            'password.required'     => 'Debe ingresar su contraseña',
            'password.min'          =>  'La contraseña debe tener al menos 8 caracteres'
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) :
            return back()->withErrors($validator)
                ->with('message', 'Se ha producido un error')
                ->with('typealert', 'danger');
        else :
            if (Auth::attempt(['email' => $request->input('email'), 'password' => $request->input('password')], true)) :
                if (Auth::user()->status == 100) :
                    return redirect('/logout');
                else :
                    return redirect('/');
                endif;
            else :
                return back()->with('message', 'Correo electrónico o contraseña incorrecta')->with('typealert', 'danger');
            endif;
        endif;
    }

    public function getRegister()
    {
        return view('connect.register');
    }

    public function postRegister(Request $request)
    {
        $rules = [
            'name'      => 'required',
            'lastname'  => 'required',
            'email'     => 'required|email|unique:users,email',
            'password'  => 'required|min:8',
            'cpassword' => 'required|same:password'
        ];

        $messages = [
            'name.required'         =>  'El nombre es requerido',
            'lastname.required'     =>  'El apellido es requerido',
            'email.required'        =>  'Correo es requerido.',
            'email.email'           =>  'Formato de correo inválido.',
            'email.unique'          =>  'Contamos con un usuario con el mismo correo. Ingrese otro correo',
            'password.required'     =>  'Por favor, escriba una contraseña.',
            'password.min'          =>  'La contraseña debe contar al menos con 8 caracteres.',
            'cpassword.required'    =>  'Debe confirmar la contraseña',
            'cpassword.min'         =>  'La contraseña debe contar al menos con 8 caracteres. ',
            'cpassword.same'        =>  'No coincide con la contraseña ingresada. '

        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) :
            return back()->withErrors($validator)
                ->with('message', 'Se ha producido un error')
                ->with('typealert', 'danger');
        else :
            $user = new User;
            $user->name = e($request->input('name'));
            $user->lastname = e($request->input('lastname'));
            $user->email = e($request->input('email'));
            $user->password = Hash::make($request->input('password'));

            if ($user->save()) :
                return redirect('/login')->with('message', 'El usuario ha sido creado con éxito')->with('typealert', 'success');
            endif;
        endif;
    }

    public function getLogout()
    {
        $status = Auth::user()->status;
        Auth::logout();

        if ($status == 100) :
            return redirect('/login')
                ->with('message', 'Cuenta suspendida')
                ->with('typealert', 'danger');
        else :
            return redirect('/');
        endif;
    }

    public function getRecover()
    {
        return view('connect.recover');
    }

    public function postRecover(Request $request)
    {
        $rules = [
            'email'     => 'required|email',
        ];

        $messages = [
            'email.required'        =>  'Ingrese el correo con el que se registró.',
            'email.email'           =>  'Formato de correo inválido.'
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) :
            return back()->withErrors($validator)
                ->with('message', 'Se ha producido un error')
                ->with('typealert', 'danger');
        else :
            $user = User::where('email', $request->input('email'))->count();
            if ($user == 1) :
                $user = User::where('email', $request->input('email'))->first();
                $code = rand(100000, 999999);
                $data = [
                    'name' => $user->name,
                    'email' => $user->email,
                    'code' => $code
                ];
                $u = User::find($user->id);
                $u->password_code = $code;
                if ($u->save()) :

                    Mail::to($user->email)->send(new UserSendRecover($data));

                    return redirect('/reset?email=' . $user->email)
                        ->with('message', 'Ingrese el código que enviamos a su correo electrónico')
                        ->with('typealert', 'success');
                endif;
            else :
                return back()->with('message', 'Correo electrónico ingresado no existe')->with('typealert', 'danger');
            endif;
            return $user;
        endif;
    }

    public function getReset(Request $request)
    {
        $data = ['email' => $request->get('email')];

        return view('connect.reset', $data);
    }

    public function postReset(Request $request)
    {
        $rules = [
            'email'     => 'required|email',
            'code'      => 'required'
        ];

        $messages = [
            'email.required'        =>  'Ingrese el correo con el que se registró.',
            'email.email'           =>  'Formato de correo inválido.',
            'code.required'         =>  'Ingrese el código que enviamos a su correo.'
        ];

        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) :
            return back()->withErrors($validator)
                ->with('message', 'Se ha producido un error')
                ->with('typealert', 'danger');
        else :
            $user = User::where('email', $request->input('email'))->where('password_code', $request->input('code'))->count();

            if ($user == 1) :
                $length = 8;
                $user = User::where('email', $request->input('email'))->where('password_code', $request->input('code'))->first();
                $new_password = Str::random($length);
                $user->password = Hash::make($new_password);
                $user->password_code = null;
                if ($user->save()) :
                    $data = [
                        'name' => $user->name,
                        'password' => $new_password
                    ];
                    Mail::to($user->email)->send(new UserSendNewPassword($data));
                    return redirect('/login')->with('message', 'La contraseña ha sido restablecida')->with('typealert', 'success');
                endif;
            else :
                return back()->with('message', 'El correo electrónico y el código de recuperación son incorrectos.')->with('typealert', 'danger');
            endif;
        endif;
    }
}
