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
            $category = new Category;
            $category->module = $module;
            $category->parent = $request->input('parent');
            $category->name = e($request->input('name'));
            $category->slug = Str::slug($request->input('name'));
            $category->icon= $this->postFileUpload('icon', $request);

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
            if ($request->hasFile('icon')) :
                $actualIcon = $category->icon;
                if (!is_null($actualIcon)):
                    $this->getDeleteFile('uploads', $actualIcon);
                endif;
                $category->icon = $this->postFileUpload('icon', $request);
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
