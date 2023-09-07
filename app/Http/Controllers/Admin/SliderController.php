<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Slider;

use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;


class SliderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('user.status');
        $this->middleware('user.permissions');
        $this->middleware('isadmin');
    }
    public function getHome()
    {
        $sliders = Slider::orderBy('s_order', 'ASC')->get();

        $data = ['sliders' => $sliders];

        return view('admin.sliders.home', $data);
    }

    public function postSliderAdd(Request $request)
    {
        $rules = [
            'name'      =>  'required',
            'img'       =>  'required',
            'content'   =>  'required',
            's_order'   =>  'required'
        ];

        $messages = [
            'name.required'     => 'El nombre slider es requerido.',
            'img.required'      =>  'Seleccione una imagen para el Slider.',
            'content'           =>  'Debe agregar un contenido.',
            's_order.required'  =>  'Es necesario indicar un orden.'
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) :
            return back()->withErrors($validator)
                ->with('message', 'Se ha producido un error')
                ->with('typealert', 'danger');
        else :
            $path = '/' . date('Y-m-d');
            $fileExt = trim($request->file('img')->getClientOriginalExtension());
            $upload_path = Config::get('filesystems.disks.uploads.root');
            $name = Str::slug(str_replace($fileExt, '', $request->file('img')->getClientOriginalName()));
            $fileName = rand(1, 999) . '-' . $name . '.' . $fileExt;

            $slider = new Slider;
            $slider->user_id = Auth::id();
            $slider->status = $request->input('visible');
            $slider->name = e($request->input('name'));
            $slider->file_path = $path;
            $slider->file_name = $fileName;
            $slider->content = e($request->input('content'));
            $slider->s_order = e($request->input('s_order'));

            if ($slider->save()) :
                if ($request->hasFile('img')) :
                    $fl = $request->img->storeAs($path, $fileName, 'uploads');
                endif;
                return back()->with('message', 'Slider creado con éxito.')->with('typealert', 'success');

            endif;

        endif;
    }

    public function getSliderEdit(Request $request, $id)
    {
        $slider = Slider::findOrFail($id);
        $data = ['slider' => $slider];

        return view('admin.sliders.edit', $data);
    }

    public function postSliderEdit(Request $request, $id)
    {
        dd($request->all());

        $rules = [
            'name'      =>  'required',
            'content'   =>  'required',
            's_order'   =>  'required'
        ];

        $messages = [
            'name.required'     => 'El nombre slider es requerido.',
            'content.required'  =>  'Debe agregar un contenido.',
            's_order.required'  =>  'Es necesario indicar un orden.'
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) :
            return back()->withErrors($validator)
                ->with('message', 'Se ha producido un error')
                ->with('typealert', 'danger');
        else :
            $slider = Slider::find($id);
            $slider->status = $request->input('visible');
            $slider->name = e($request->input('name'));
            $slider->content = e($request->input('content'));
            $slider->s_order = e($request->input('s_order'));

            if ($slider->save()) :
                return back()->with('message', 'Slider editado con éxito.')->with('typealert', 'success');
            endif;
        endif;
    }
    public function getSliderDelete($id)
    {
        $slider = Slider::findOrFail($id);

        if ($slider->delete()) :
            return back()->with('message', 'Slider enviado a la Papelerea')->with('typealert', 'success');
        endif;
    }
}
