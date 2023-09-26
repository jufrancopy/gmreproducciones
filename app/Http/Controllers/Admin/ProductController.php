<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Config;

use Validator;
use Image;

use App\Models\Category;
use App\Models\Product;
use App\Models\PGallery;
use App\Models\Inventory;
use App\Models\Variant;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('user.status');
        $this->middleware('user.permissions');
        $this->middleware('isadmin');
    }

    public function getHome($status)
    {
        switch ($status) {
            case '0':
                $products = Product::with(['category', 'subCategory', 'getPrice'])->where('status', 0)->orderBy('id', 'DESC')->paginate(10);
                break;
            case '1':
                $products = Product::with(['category', 'subCategory', 'getPrice'])->where('status', 1)->orderBy('id', 'DESC')->paginate(10);
                break;
            case 'all':
                $products = Product::with(['category', 'subCategory', 'getPrice'])->orderBy('id', 'DESC')->paginate(10);
                break;
            case 'trash':
                $products = Product::with(['category', 'subCategory', 'getPrice'])->onlyTrashed()->orderBy('id', 'DESC')->paginate(10);
                break;
        }

        $data = ['products' => $products];

        return view('admin.products.home', get_defined_vars());
    }

    public function getProductAdd()
    {
        $cats = Category::where('parent', 0)->pluck('name', 'id');
        $data = ['cats' => $cats];

        return view('admin.products.add', get_defined_vars());
    }

    public function postProductAdd(Request $request)
    {
        $rules = [
            'name'          => 'required',
            'image'         => 'required',
            'category_id'   => 'required',
            'content'       => 'required',
        ];

        $messages = [
            'name.required'         => 'Debe agregar un nombre al Producto',
            'image.required'        => 'Debe incluir una imagen al Producto',
            'category_id.required'  => 'Defina a que categoría pertenecerá el producto',
            'imagen.image'          => 'El archivo incluido, no es una imagen',
            'content.required'      => 'Debe describir el producto',

        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) :
            return back()->withErrors($validator)
                ->with('message', 'Se ha producido un error')
                ->with('typealert', 'danger')
                ->withInput();
        else :
            $product = new Product;
            $product->status = 0;
            $product->code = e($request->input('code'));
            $product->name = $request->input('name');
            $product->slug = Str::slug($request->input('name'));
            $product->category_id = e($request->input('category_id'));
            $product->subCategory_id = e($request->input('subCategory_id'));
            $product->image = $this->postFileUpload('image', $request, [[328,328, '328x328']]);
            $product->in_discount = $request->input('in_discount');
            $product->discount = $request->input('discount');
            $product->content = e($request->input('content'));

            if ($product->save()) :
                return redirect('/admin/product/' . $product->id . '/edit')
                    ->with('message', 'Producto agregado con éxito.')
                    ->with('typealert', 'success');

            endif;
        endif;
    }

    public function getProductEdit(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $cats = Category::where('module', 0)->where('parent', 0)->pluck('name', 'id');
        $data = ['cats' => $cats, 'products' => $product];

        return view('admin.products.edit', get_defined_vars());
    }

    public function postProductEdit(Request $request, $id)
    {
        $rules = [
            'name'          => 'required',
            'category_id'   => 'required',
            'content'       => 'required',
        ];

        $messages = [
            'name.required'         => 'Debe agregar un nombre al Producto',
            'category_id.required'  => 'Defina a que categoría pertenecerá el producto',
            'content.required'      => 'Debe describir el producto',

        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) :
            return back()->withErrors($validator)
                ->with('message', 'Se ha producido un error')
                ->with('typealert', 'danger')
                ->withInput();
        else :
            // Insertion to DB
            $product = Product::findOrFail($id);
            $imgPrevPath = $product->file_path;
            $imgPrev = $product->image;
            $product->status = $request->input('status');
            $product->code = e($request->input('code'));
            $product->name = $request->input('name');
            $product->category_id = e($request->input('category_id'));
            $product->subCategory_id = e($request->input('subCategory_id'));

            if ($request->hasFile('image')) :
                $actualImage = $product->image;
                if (!is_null($actualImage)) :
                    $this->getDeleteFile('uploads', $actualImage, ['328x328', '512x512']);
                endif;
                $product->image = $this->postFileUpload('image', $request, [[328,328, '328x328']]);
            endif;

            $product->in_discount = $request->input('in_discount');
            $product->discount = $request->input('discount');
            $product->discount_until_date = $request->input('discount_until_date');
            $product->content = e($request->input('content'));

            if ($product->save()) :
                $this->getUpdateMinPrice($product->id);
                return back()
                    ->with('message', 'Producto editado con éxito.')
                    ->with('typealert', 'success');

            endif;
        endif;
    }

    public function postProductGallery(Request $request, $id)
    {
        $rules = [
            'file_image' => 'required',
        ];

        $messages = [
            'file_image.required' => 'Debe agregar un nombre al Producto',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) :
            return back()->withErrors($validator)
                ->with('message', 'Se ha producido un error')
                ->with('typealert', 'danger')
                ->withInput();
        else :
            if ($request->hasFile('file_image')) :
                
                // Make Gallery
                $gallery = new PGallery;
                $gallery->product_id = $id;
                $gallery->file_name = $this->postFileUpload('file_image', $request, [[328,328, '328x328']]);
                
                if ($gallery->save()) :
                    
                    return back()
                        ->with('message', 'Imagen subida con éxito.')
                        ->with('typealert', 'success');

                endif;
            endif;
        endif;
    }

    public function getProductGalleryDelete($id, $gid)
    {
        $gallery = PGallery::findOrFail($gid);
        $upload_path = Config::get('filesystems.disks.uploads.root');

        if ($gallery->product_id != $id) {
            return back()
                ->with('message', 'La Imagen se puede eliminar.')
                ->with('typealert', 'danger');
        } else {
            if ($gallery->delete()) :
                return back()
                    ->with('message', 'La Imagen se eliminó con éxito.')
                    ->with('typealert', 'success');
            endif;
        }
    }

    public function postProductSearch(Request $request)
    {

        $rules = [
            'search' => 'required',
        ];

        $messages = [
            'search.required' => 'Debe indicar al menos dos letras',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) :
            return redirect('/admin/products/1')->withErrors($validator)
                ->with('message', 'Se ha producido un error')
                ->with('typealert', 'danger')
                ->withInput();
        else :
            switch ($request->input('filter')):
                case '0':
                    $products = Product::with('category')->where('name', 'LIKE', '%' . $request->input('search') . '%')
                        ->where('status', $request->input('status'))->orderBy('id', 'DESC')->get();
                    break;
                case '1':
                    $products = Product::with('category')->where('code', $request->input('search'))->orderBy('id', 'DESC')->get();
                    break;
            endswitch;
            $data = ['products' => $products];

            return view('admin.products.search', $data);
        endif;
    }
    public function postProductDelete($id)
    {
        $product = Product::findOrFail($id);

        if ($product->delete()) :
            return back()->with('message', 'Producto enviado a la Papelerea')->with('typealert', 'success');
        endif;
    }

    public function getProductRestore($id)
    {
        $product = Product::onlyTrashed()->where('id', $id)->first();
        if ($product->restore()) :
            $product->status = 0;
            $product->save();

            return redirect('/admin/product/' . $product->id . '/edit')->with('message', 'Producto reactivado')->with('typealert', 'success');
        endif;
    }

    public function getProductInventory($id)
    {
        $product = Product::findOrFail($id);
        $data = ['product' => $product];

        return view('admin.products.inventory', $data);
    }

    public function postProductInventory(Request $request, $id)
    {
        $rules = [
            'name'          => 'required',
            'price'         => 'required'
        ];

        $messages = [
            'name.required'         => 'Debe agregar un nombre al Producto',
            'price.required'        => 'Debe agregar un precio al producto'
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) :
            return back()->withErrors($validator)
                ->with('message', 'Se ha producido un error')
                ->with('typealert', 'danger')
                ->withInput();
        else :
            $inventory = new Inventory;
            $inventory->product_id = $id;
            $inventory->name = e($request->input('name'));
            $inventory->quantity = e($request->input('inventory'));
            $inventory->price = e($request->input('price'));
            $inventory->limited = e($request->input('limited'));
            $inventory->minimum = e($request->input('minimum'));

            if ($inventory->save()) :
                $this->getUpdateMinPrice($inventory->product_id);
                return back()
                    ->with('message', 'Inventario guardado correctamente.')
                    ->with('typealert', 'success');
            endif;
        endif;
    }

    public function getProductInventoryEdit($id)
    {
        $inventory = Inventory::findOrFail($id);
        $data = ['inventory' => $inventory];

        return view('admin.products.inventory_edit', $data);
    }

    public function postProductInventoryEdit($id, Request $request)
    {
        $rules = [
            'name'          => 'required',
            'price'         => 'required'
        ];

        $messages = [
            'name.required'         => 'Debe agregar un nombre al Producto',
            'price.required'        => 'Debe agregar un precio al producto'
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) :
            return back()->withErrors($validator)
                ->with('message', 'Se ha producido un error')
                ->with('typealert', 'danger')
                ->withInput();
        else :
            $inventory = Inventory::find($id);
            $inventory->name = e($request->input('name'));
            $inventory->quantity = e($request->input('inventory'));
            $inventory->price = e($request->input('price'));
            $inventory->limited = e($request->input('limited'));
            $inventory->minimum = e($request->input('minimum'));

            if ($inventory->save()) :
                $this->getUpdateMinPrice($inventory->product_id);
                return back()
                    ->with('message', 'Inventario actualizado correctamente.')
                    ->with('typealert', 'success');
            endif;
        endif;
    }

    public function getProductInventoryDeleted($id)
    {
        $inventory = Inventory::findOrFail($id);

        if ($inventory->delete()) :
            $this->getUpdateMinPrice($inventory->product_id);
            return back()->with('message', 'Inventario enviado a la Papelerea')->with('typealert', 'success');
        endif;
    }

    public function postProductInventoryVariantAdd($id, Request $request)
    {
        $rules = [
            'name'          => 'required'
        ];

        $messages = [
            'name.required'         => 'Nombre de la variante es requerido'
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) :
            return back()->withErrors($validator)
                ->with('message', 'Se ha producido un error')
                ->with('typealert', 'danger')
                ->withInput();
        else :
            $inventory = Inventory::findOrFail($id);
            $variant = new Variant;
            $variant->product_id = $inventory->product_id;
            $variant->inventory_id = $id;
            $variant->name = e($request->input('name'));

            if ($variant->save()) :
                return back()
                    ->with('message', 'Variante creada correctamente.')
                    ->with('typealert', 'success');
            endif;
        endif;
    }

    public function getProductVariantDelete($id)
    {
        $variant = Variant::findOrFail($id);

        if ($variant->delete()) :
            return back()->with('message', 'Variante enviado a la Papelerea')->with('typealert', 'success');
        endif;
    }

    public function getUpdateMinPrice($id)
    {
        $product = Product::find($id);
        $price = $product->getPrice->min('price');
        $product->price = $price;
        $product->save();
    }
}
