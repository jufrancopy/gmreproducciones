<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// use Validator, Hash, Auth, Mail, Str;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

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

        // Mensajes de validación
        $messages = [
            'email.required' => _sl('login.messages.email_required'),
            'email.email' => _sl('login.messages.email_email'),
            'password.required' => _sl('login.messages.password_required'),
            'password.min' => _sl('login.messages.password_min')
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) :
            return back()->withErrors($validator)
                ->with('message', _sl('login.messages.title'))
                ->with('typealert', 'danger');
        else :
            if (Auth::attempt(['email' => $request->input('email'), 'password' => $request->input('password')], true)) :
                if (Auth::user()->status == 100) :
                    return redirect('/logout');
                else :
                    return redirect('/');
                endif;
            else :
                return back()->with('message', _sl('login.messages.error'))->with('typealert', 'danger');
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
            'name.required' => _sl('register.messages.name_required'),
            'lastname.required' => _sl('register.messages.lastname_required'),
            'email.required' => _sl('register.messages.email_required'),
            'email.email' => _sl('register.messages.email_email'),
            'email.unique' => _sl('register.messages.email_unique'),
            'password.required' => _sl('register.messages.password_required'),
            'password.min' => _sl('register.messages.password_min'),
            'cpassword.required' => _sl('register.messages.cpassword_required'),
            'cpassword.min' => _sl('register.messages.cpassword_min'),
            'cpassword.same' => _sl('register.messages.cpassword_same')
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
                return redirect('/login')->with('message', _sl('register.messages.success'))->with('typealert', 'success');
            endif;
        endif;
    }

    public function getLogout()
    {
        $status = Auth::user()->status;
        Auth::logout();

        if ($status == 100) :
            return redirect('/login')
                ->with('message', _sl('messages.suspended_account'))
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
            'email.required'  =>  _sl('recover.messages.email_required'),
            'email.email'     =>  _sl('recover.messages.email_email')
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) :
            return back()->withErrors($validator)
                ->with('message', _sl('messages.error'))
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
                        ->with('message', _sl('recover.cod_sent'))
                        ->with('typealert', 'success');
                endif;
            else :
                return back()->with('message', _sl('recover.email_not_exist'))->with('typealert', 'danger');
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
            'email.required' => _sl('recover.messages.email_required'),
            'email.email' => _sl('recover.messages.email_email'),
            'code.required' => _sl('recover.messages.cod_sent')
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
                    return redirect('/login')->with('message', _sl('recover.success'))->with('typealert', 'success');
                endif;
            else :
                return back()->with('message', _sl('recover.error'))->with('typealert', 'danger');
            endif;
        endif;
    }
}
