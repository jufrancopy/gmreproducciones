<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Config;
use Intervention\Image\Facades\Image;

use App\Models\Category;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('user.status');
        $this->middleware('user.permissions');
        $this->middleware('isadmin');
    }

    public function getHome($module)
    {
        $cats = Category::where('module', $module)
            ->where('parent', 0)
            ->orderBy('order', 'ASC')
            ->get();

        $data = ['cats' => $cats, 'module'=>$module];

        return view('admin.categories.home', get_defined_vars());
    }

    public function postCategoryAdd(Request $request, $module)
    {
        $rules = [
            'name' =>    'required',
            'icon' =>    'required',
        ];

        $messages = [
            'name.required' => 'Debe darle un nombre a la nueva categoría',
            'icon.required' => 'Debe elegir un icono',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) :
            return back()->withErrors($validator)
                ->with('message', 'Se ha producido un error')
                ->with('typealert', 'danger');
        else :
            $uploadIcon = $this->postFileUpload('icon', $request);
            $icon = json_decode($uploadIcon, true);
            if($icon['upload'] == "error"):
                return back()->with('message', 'No se pudo subir el archivo.')->with('typealert', 'danger');
            endif;

            $category = new Category;
            $category->module = $module;
            $category->parent = $request->input('parent');
            $category->name = e($request->input('name'));
            $category->slug = Str::slug($request->input('name'));
            $category->icon= $uploadIcon;

            if ($category->save()) :
                return back()->with('message', 'Categoría creada con éxito.')->with('typealert', 'success');
            endif;
        endif;
    }

    public function getCategoryEdit($id)
    {
        $category = Category::find($id);
        $data = ['cat' => $category];

        return view('admin.categories.edit', get_defined_vars());
    }

    public function postCategoryEdit(Request $request, $id)
    {
        $rules = [
            'name' =>    'required',
            // 'icono' =>     'required'
        ];

        $messages = [
            'name.required' => 'Debe darle un nombre a la nueva categoría',
            // 'icono.required' => 'Es necesario agragar un ícono',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) :
            return back()->withErrors($validator)
                ->with('message', 'Se ha producido un error')
                ->with('typealert', 'danger');
        else :
            $category = Category::find($id);
            $category->name = e($request->input('name'));
            $category->slug = Str::slug($request->input('name'));
            if ($request->hasFile('icono')) :
                $actual_icon = $category->icono;
                $actual_file_path = $category->file_path;
                $path = '/' . date('Y-m-d');
                $fileExt = trim($request->file('icono')->getClientOriginalExtension());
                $upload_path = Config::get('filesystems.disks.uploads.root');
                $name = Str::slug(str_replace($fileExt, '', $request->file('icono')->getClientOriginalName()));
                $fileName = rand(1, 999) . '-' . $name . '.' . $fileExt;
                $fl = $request->icono->storeAs($path, $fileName, 'uploads');
                $category->file_path = date('Y-m-d');
                $category->icono = $fileName;
                if (!is_null($actual_icon)) :
                    unlink($upload_path . '/' . $actual_file_path . '/' . $actual_icon);
                endif;
            endif;
            $category->order = $request->input('order');

            if ($category->save()) :
                return back()->with('message', 'Categoría editada con éxito.')->with('typealert', 'success');
            endif;
        endif;
    }

    public function postSubCategoriesEdit($id){
        $category = Category::findOrFail($id);
        $data = ['category' => $category];

        return view('admin.categories.sub_categories', get_defined_vars());
    }

    public function getCategoryDelete($id)
    {
        $cat = Category::find($id);

        if ($cat->delete()) :
            return back()->with('message', 'Categoría borrada con éxito.')->with('typealert', 'success');

        endif;
    }
}
