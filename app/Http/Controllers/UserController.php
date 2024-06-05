<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

// Intervention Image
use Image;

//Models
use App\Models\User;
use App\Models\Coverage;
use App\Models\UserAddress;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function getAccountEdit(Request $request)
    {
        $birthday = (is_null(Auth::user()->birthday)) ? [null, null, null] : $birthday = explode('-', Auth::user()->birthday);

        $data = ['birthday' => $birthday];

        return view('users.accounts.account_edit', $data);
    }

    public function postAccountAvatar(Request $request)
    {
        $rules = [
            'avatar' => 'required',
        ];

        $messages = [
            'avatar.required' => _sl('users.postAccountAvatar.avatar_required'),
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) :
            return back()->withErrors($validator)
                ->with('message', _sl('users.alerts.error_message'))
                ->with('typealert', 'danger')
                ->withInput();
        else :
            if ($request->hasFile('avatar')) :
                $user = User::find(Auth::id());
                $user->avatar = $this->postFileUpload('avatar', $request, [[64, 64, '64x64'], [128, 128, '128x128'], [256, 256, '256x256']]);

                if ($user->save()) :

                    return back()
                        ->with('message', _sl('users.alerts.success_message'))
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
            'apassword.required'    => _sl('users.postAccountPassword.apassword_required'),
            'apassword.min'         => _sl('users.postAccountPassword.apassword_min'),
            'password.required'     => _sl('users.postAccountPassword.password_required'),
            'password.min'          => _sl('users.postAccountPassword.password_min'),
            'cpassword.required'    => _sl('users.postAccountPassword.cpassword_required'),
            'cpassword.min'         => _sl('users.postAccountPassword.cpassword_min'),
            'cpassword.same'        => _sl('users.postAccountPassword.cpassword_same')
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) :
            return back()->withErrors($validator)
                ->with('message', _sl('users.alerts.error_message'))
                ->with('typealert', 'danger')
                ->withInput();
        else :
            $user = User::find(Auth::id());
            if (Hash::check($request->input('apassword'), $user->password)) :
                $user->password = Hash::make($request->input('password'));
                if ($user->save()) :
                    return redirect('/logout')->with('message', _sl('users.alerts.password_success_message'))->with('typealert', 'success');
                endif;
            else :
                return back()->with('message', _sl('users.alerts.password_incorrect_message'))->with('typealert', 'danger');
            endif;
        endif;
    }

    public function postAccountInfo(Request $request)
    {
        $rules = [
            'name'      => 'required',
            'lastname'  => 'required',
            'phone'     => 'required',
            'year'      => 'required',
            'day'       =>  'required'
        ];

        $messages = [
            'name.required'         => _sl('users.postAccountInfo.name_required'),
            'lastname.required'     => _sl('users.postAccountInfo.lastname_required'),
            'phone.required'        => _sl('users.postAccountInfo.phone_required'),
            'password.min'          => _sl('users.postAccountInfo.password_min'),
            'year.required'         => _sl('users.postAccountInfo.year_required'),
            'day.requerido'         => _sl('users.postAccountInfo.day_requerido'),
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) :
            return back()->withErrors($validator)
                ->with('message', _sl('users.alerts.error_message'))
                ->with('typealert', 'danger')
                ->withInput();
        else :
            $date = $request->input('year') . '-' . $request->input('month') . '-' . $request->input('day');

            $user = User::find(Auth::id());
            $user->name         = e($request->input('name'));
            $user->lastname     = e($request->input('lastname'));
            $user->phone        = e($request->input('phone'));
            $user->birthday     = date("Y-m-d", strtotime($date));
            $user->gender       = e($request->input('gender'));

            if ($user->save()) :
                return back()->with('message', _sl('users.alerts.info_update_success_message'))->with('typealert', 'success');
            endif;
        endif;
    }

    public function getAccountAddress()
    {
        $states = Coverage::where('coverage_type', 0)->pluck('name', 'id');

        $data = ['states' => $states];

        return view('users.accounts.address', $data);
    }

    public function postAccountAddress(Request $request)
    {
        $rules = [
            'name'          => 'required',
            'state_id'         => 'required',
            'city_id'          => 'required',
            'add1'          => 'required',
            'add2'          =>  'required',
            'add3'          =>  'required',
        ];

        $messages = [
            'name.required'         => _sl('users.postAccountAddress.name_required'),
            'state_id.required'        => _sl('users.postAccountAddress.state_id_required'),
            'city_id.required'         => _sl('users.postAccountAddress.city_id_required'),
            'add1.required'         => _sl('users.postAccountAddress.add1_required'),
            'add2.required'         => _sl('users.postAccountAddress.add2_required'),
            'add3.requerid'        => _sl('users.postAccountAddress.add3_requerid'),
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) :
            return back()->withErrors($validator)
                ->with('message', _sl('users.alerts.error_message'))
                ->with('typealert', 'danger')
                ->withInput();
        else :

            $address = new UserAddress;
            $address->user_id = Auth::id();
            $address->name = $request->name;
            $address->state_id = $request->state_id;
            $address->city_id = $request->city_id;
            $info = ['add1' => $request->add1, 'add2' => $request->add2, 'add3' => $request->add3, 'add4' => $request->add4];
            $address->addr_info = json_encode($info);

            if (count(collect(Auth::user()->getAddress)) == 0) :
                $address->default = 1;
            endif;

            if ($address->save()) :
                return back()
                    ->with('message', _sl('users.alerts.address_save_success_message'))
                    ->with('typealert', 'success');
            endif;
        endif;
    }

    public function getAccountAddressSetDefault(UserAddress $address)
    {
        if (Auth::id() != $address->user_id) :
            return back()
                ->with('message', _sl('users.alerts.address_edit_error_message'))
                ->with('typealert', 'danger');
        else :
            //Remove default 
            $default = UserAddress::find(Auth::user()->getAddressDefault->id);
            $default->default = 0;
            $default->save();

            //Update default     
            $address->default = 1;
            if ($address->save()) :
                return back()
                    ->with('message', _sl('users.alerts.address_update_success_message' . $address->name))
                    ->with('typealert', 'success');
            endif;
        endif;
    }

    public function getAccountAddressDelete(UserAddress $address)
    {
        if (Auth::id() != $address->user_id) :
            return back()
                ->with('message', _sl('users.alerts.address_delete_error_message'))
                ->with('typealert', 'danger');
        else :
            if ($address->default == 0) :

                if ($address->delete()) :
                    return back()
                        ->with('message', _sl('users.alerts.address_delete_success_message'))
                        ->with('typealert', 'success');
                endif;
            else :
                return back()
                    ->with('message', _sl('users.alerts.address_delete_default_error_message'))
                    ->with('typealert', 'success');
            endif;
        endif;
    }
}
