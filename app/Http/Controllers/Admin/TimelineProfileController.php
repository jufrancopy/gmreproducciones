<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;

use App\Models\Category;
use App\Models\Timeline;
use App\Models\TimelineProfile;

class TimelineProfileController extends Controller
{
    public function __construct(){
        
        $this->middleware('auth');
        // $this->middleware('userstatus');
        // $this->middleware('isadmin');
    }

    public function index(Request $request)
    {
        $timelinesProfiles = TimelineProfile::paginate(10);
        
        return view ('admin.timelines.profiles.index', get_defined_vars());
    }

    
    public function create()
    {
        $categories = Category::pluck('name', 'id');
        
        return view('admin.timelines.profiles.create', get_defined_vars());
    }

    public function store(Request $request)
    {
        $rules = [
            'name'         => 'required',
            'description'   => 'required',
        ];

        $messages = [
            'name.required'         => 'Debe agregar un nombre.',
            'description.required'      => 'Debe describir los detalles del hito',

        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) :
            return back()->withErrors($validator)
                ->with('message', 'Se ha producido un error')
                ->with('typealert', 'danger')
                ->withInput();
        else:            
            $timelinesProfile = TimelineProfile::create($request->all());
            $timelinesProfile->save();
        
        endif;

        return redirect()->route('timeline-profiles.index')
                    ->with('message', 'Perfil de Linea de Tiempo creado con éxito.')
                    ->with('typealert', 'success');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $timelineProfile = TimelineProfile::findOrFail($id);

        return view ('admin.timelines.profiles.edit', get_defined_vars());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $rules = [
            'name'         => 'required',
            'description'   => 'required',
        ];

        $messages = [
            'name.required'         => 'Debe agregar un nombre.',
            'description.required'      => 'Debe describir los detalles del hito',

        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) :
            return back()->withErrors($validator)
                ->with('message', 'Se ha producido un error')
                ->with('typealert', 'danger')
                ->withInput();
        else:   
            $timelinesProfile = TimelineProfile::find($id);
            $timelinesProfile->fill($request->all())->save();
        endif;

        return redirect()->route('timeline-profiles.index')
                    ->with('message', 'Perfil de Linea de Tiempo editado con éxito.')
                    ->with('typealert', 'success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
        $timelineProfile = TimelineProfile::find($id);
        $timelineProfile->delete();

        return redirect()->route('timeline-profiles.index')
        ->with('message', 'Perfil de Linea de Tiempo eliminado con éxito.')
        ->with('typealert', 'success');
    }
}
