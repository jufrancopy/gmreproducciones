<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator, Str, Config, Image;

use App\Models\Timeline;
use App\Models\Category;
use App\Models\Gallery;
use App\Models\TimelineProfile;
use Carbon\Carbon;

class TimelineController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        // $this->middleware('userstatus');
        // $this->middleware('isadmin');
    }

    public function getList(Request $request, $profileId)
    {
        setlocale(LC_ALL, 'es_ES');
        $timelines = Timeline::with('profile')->where('profile_id', $profileId)->orderBy('id', 'DESC')->paginate(30);
        $profileId;
        $timelineProfile = TimelineProfile::findOrFail($profileId);
        $data = ['timelines' => $timelines];

        return view('admin.timelines.home', get_defined_vars());
    }

    public function getHomeWeb(){

        setlocale(LC_ALL, 'es_ES');
        $timelineProfile = TimelineProfile::first();
        $timelines = Timeline::where('profile_id', $timelineProfile->id)->orderBy('date', 'ASC')->get();
        $data = ['timelines' => $timelines];

        return view('web.timelines.index', get_defined_vars());
        
    }

    public function getTimelineAdd($profile_id)
    {
        $profileId = $profile_id;
        $cats = Category::where('module', 1)->pluck('name', 'id');
        $data = ['cats' => $cats];
        $date = new \DateTime();
        $date->format('d-m-Y');

        return view('admin.timelines.add', get_defined_vars());
    }

    public function postTimelineAdd(Request $request)
    {
        $rules = [
            'title'         => 'required',
            'image'         => 'required',
            'date'          => 'required',
            'description'   => 'required',
        ];

        $messages = [
            'title.required'         => 'Debe agregar un título al Hito',
            'image.required'        => 'Debe incluir una imagen al Producto',
            'imagen.image'          => 'El archivo incluido, no es una imagen',
            'date.required'        => 'Debe agregar una fecha al Hito',
            'description.required'      => 'Debe describir los detalles del hito',

        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) :
            return back()->withErrors($validator)
                ->with('message', 'Se ha producido un error')
                ->with('typealert', 'danger')
                ->withInput();
        else :

            // Validacition to images
            $path = '/' . date('Y-m-d');
            $fileExt = trim($request->file('image')->getClientOriginalExtension());
            $upload_path = Config::get('filesystems.disks.uploads.root');
            $name = Str::slug(str_replace($fileExt, '', $request->file('image')->getClientOriginalName()));
            $fileName = rand(1, 999) . '-' . $name . '.' . $fileExt;
            $finalFile = $upload_path . '/' . $path . '/' . $fileName;

            // Insertion to DB
            $timeline = new Timeline;
            $timeline->title = $request->input('title');
            $timeline->slug = Str::slug($request->input('title'));
            $timeline->file_path = date('Y-m-d');
            $timeline->image = $fileName;
            $timeline->date = $request->input('date');
            $timeline->profile_id = $request->input('profile_id');
            $timeline->description = e($request->input('description'));


            if ($timeline->save()) :
                if ($request->hasFile('image')) :
                    $fl = $request->image->storeAs($path, $fileName, 'uploads');
                    $img = Image::make($finalFile);
                    $img->fit(256, 256, function ($constraint) {
                        $constraint->upsize();
                    });
                    $img->save($upload_path . '/' . $path . '/t_' . $fileName);
                endif;
                
                return redirect()->route('timelines.list', $timeline->profile_id)
                    ->with('message', 'timelineo agregado con éxito.')
                    ->with('typealert', 'success');

            endif;
        endif;
    }

    public function getTimelineEdit(Request $request, $id)
    {
        $timeline = Timeline::findOrFail($id);
        $cats = Category::where('module', 1)->pluck('name', 'id');
        $data = ['cats' => $cats, 'timelines' => $timeline];

        return view('admin.timelines.edit', get_defined_vars());
    }

    public function postTimelineEdit(Request $request, $id)
    {
        $rules = [
            'title'         => 'required',
            'date'          => 'required',
            'description'   => 'required',
        ];

        $messages = [
            'title.required'         => 'Debe agregar un título al Hito',
            'imagen.image'          => 'El archivo incluido, no es una imagen',
            'date.required'        => 'Debe agregar una fecha al Hito',
            'description.required'      => 'Debe describir los detalles del hito',

        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) :
            return back()->withErrors($validator)
                ->with('message', 'Se ha producido un error')
                ->with('typealert', 'danger')
                ->withInput();
        else :
            // Insertion to DB
            $timeline = Timeline::findOrFail($id);
            $imgPrevPath = $timeline->file_path;
            $imgPrev = $timeline->image;
            $timeline->title = $request->input('title');
            
            if ($request->hasFile('image')) :
                $path = '/' . date('Y-m-d');
                $fileExt = trim($request->file('image')->getClientOriginalExtension());
                $upload_path = Config::get('filesystems.disks.uploads.root');
                $name = Str::slug(str_replace($fileExt, '', $request->file('image')->getClientOriginalName()));
                $fileName = rand(1, 999) . '-' . $name . '.' . $fileExt;
                $finalFile = $upload_path . '/' . $path . '/' . $fileName;
                $timeline->file_path = date('Y-m-d');
                $timeline->image = $fileName;
            endif;

            $timeline->date = $request->input('date');
            $timeline->description = e($request->input('description'));

            if ($timeline->save()) :
                if ($request->hasFile('image')):
                    $fl = $request->image->storeAs($path, $fileName, 'uploads');
                    $img = Image::make($finalFile);
                    $img->fit(256, 256, function ($constraint) {
                        $constraint->upsize();
                    });
                    $img->save($upload_path . '/' . $path . '/t_' . $fileName);
                    unlink($upload_path.'/'.$imgPrevPath.'/'.$imgPrev);
                    unlink($upload_path.'/'.$imgPrevPath.'/t_'.$imgPrev);
                endif;
                
                return redirect()->route('timelines.list', $timeline->profile_id)
                    ->with('message', 'Hito editado con éxito.')
                    ->with('typealert', 'success');

            endif;
        endif;
    }

    public function postTimelineGallery(Request $request, $id)
    {
        $rules = [
            'file_image' => 'required',
        ];

        $messages = [
            'file_image.required' => 'Debe agregar una imagen',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) :
            return back()->withErrors($validator)
                ->with('message', 'Se ha producido un error')
                ->with('typealert', 'danger')
                ->withInput();
        else :
            if ($request->hasFile('file_image')) :
                $path = '/' . date('Y-m-d');
                $fileExt = trim($request->file('file_image')->getClientOriginalExtension());
                $upload_path = Config::get('filesystems.disks.uploads.root');
                $name = Str::slug(str_replace($fileExt, '', $request->file('file_image')->getClientOriginalName()));
                $fileName = rand(1, 999) . '-' . $name . '.' . $fileExt;
                $finalFile = $upload_path . '/' . $path . '/' . $fileName;

                // Make Gallery
                $gallery = new Gallery;
                $gallery->timeline_id = $id;
                $gallery->file_path = date('Y-m-d');
                $gallery->file_name = $fileName;

                if ($gallery->save()) :
                    if ($request->hasFile('file_image')) :
                        $fl = $request->file_image->storeAs($path, $fileName, 'uploads');
                        $img = Image::make($finalFile);
                        $img->fit(256, 256, function ($constraint) {
                            $constraint->upsize();
                        });
                        $img->save($upload_path . '/' . $path . '/t_' . $fileName);
                    endif;
                    return back()
                        ->with('message', 'Imagen subida con éxito.')
                        ->with('typealert', 'success');

                endif;
            endif;
        endif;
    }
    
    public function getTimelineGalleryDelete($id, $gid){
        $gallery = Gallery::findOrFail($gid);
        $path = $gallery->file_path;
        $file = $gallery->file_name;
        $upload_path = Config::get('filesystems.disks.uploads.root');

        if($gallery->timeline_id != $id){
            return back()
                        ->with('message', 'La Imagen no se puede eliminar.')
                        ->with('typealert', 'danger');
        }else{
            if($gallery->delete()):
                unlink($upload_path.'/'.$path.'/'.$file);
                unlink($upload_path.'/'.$path.'/t_'.$file);
                return back()
                        ->with('message', 'La Imagen se eliminó con éxito.')
                        ->with('typealert', 'success');
        endif;
        }
    
    }

    public function getTimelineDelete($id){
        $timeline = Timeline::find($id);
        $profileId = $timeline->profile_id;
        $timeline->delete();

        return redirect()->route('timelines.list', $profileId)
                    ->with('message', 'Hito eliminado con éxito.')
                    ->with('typealert', 'success');;
    }
}
