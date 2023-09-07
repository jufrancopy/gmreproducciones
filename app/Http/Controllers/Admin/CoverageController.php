<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Coverage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CoverageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('user.status');
        $this->middleware('user.permissions');
        $this->middleware('isadmin');
    }

    public function getList()
    {
        $states = Coverage::where('coverage_type', 0)->get();
        $data = ['states' => $states];

        return view('admin.coverage.list', $data);
    }

    public function postCoverageStateAdd(Request $request)
    {
        $rules = [
            'name' => 'required',
        ];

        $messages = [
            'name.required' => 'Nombre de la Cobertura es    requerida',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) :
            return back()->withErrors($validator)
                ->with('message', 'Se ha producido un error')
                ->with('typealert', 'danger')
                ->withInput();
        else :
            $coverage = new Coverage;
            $coverage->coverage_type = 0;
            $coverage->state_id = 0;
            $coverage->name = $request->name;
            $coverage->price = 0;
            $coverage->days = $request->days;

            if ($coverage->save()) :
                return back()
                    ->with('message', 'Cobertura de envío creada correctamente.')
                    ->with('typealert', 'success');
            endif;
        endif;
    }

    public function getCoverageEdit($id)
    {
        $coverage = Coverage::findOrFail($id);
        $data = ['coverage' => $coverage];

        return view('admin.coverage.edit', $data);
    }

    public function postCoverageStateEdit($id, Request $request)
    {
        $rules = [
            'name' => 'required'
        ];

        $messages = [
            'name.required' => 'Nombre de la Cobertura es    requerida'
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) :
            return back()->withErrors($validator)
                ->with('message', 'Se ha producido un error')
                ->with('typealert', 'danger')
                ->withInput();
        else :
            $coverage = Coverage::findOrFail($id);
            $coverage->status = $request->status;
            $coverage->name = $request->name;
            $coverage->days = $request->days;

            if ($coverage->save()) :
                return back()
                    ->with('message', 'Actualizado con éxito')
                    ->with('typealert', 'success');
            endif;
        endif;
    }

    public function getCoverageCities($id)
    {
        $state = Coverage::findOrfail($id);
        $cities = Coverage::where('state_id', $id)->get();
        $data = ['cities' => $cities, 'id' => $id, 'state' => $state];

        return view('admin.coverage.cities', $data);
    }

    public function postCoverageCityAdd(Request $request)
    {
        $rules = [
            'name' => 'required',
            'shipping_value' => ' required'
        ];

        $messages = [
            'name.required' => 'Nombre de la Cobertura es    requerida',
            'shipping_value.required' => 'El valor del envío es requerido',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) :
            return back()->withErrors($validator)
                ->with('message', 'Se ha producido un error')
                ->with('typealert', 'danger')
                ->withInput();
        else :
            $coverage = new Coverage;
            $coverage->coverage_type = 1;
            $coverage->state_id = $request->state_id;
            $coverage->name = $request->name;
            $coverage->price = $request->shipping_value;
            $coverage->days = $request->days;

            if ($coverage->save()) :
                return back()
                    ->with('message', 'Cobertura de envío creada correctamente.')
                    ->with('typealert', 'success');
            endif;
        endif;
    }

    public function getCoverageCityEdit($id)
    {
        $coverage = Coverage::findOrFail($id);
        $data = ['coverage' => $coverage];

        return view('admin.coverage.edit_city', $data);
    }

    public function postCoverageCityEdit($id, Request $request)
    {
        $rules = [
            'name' => 'required',
            'shipping_value' => ' required'
        ];

        $messages = [
            'name.required' => 'Nombre de la Ciudad es requerida',
            'shipping_value.required' => 'El valor del envío es requerido',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) :
            return back()->withErrors($validator)
                ->with('message', 'Se ha producido un error')
                ->with('typealert', 'danger')
                ->withInput();
        else :
            $coverage = Coverage::findOrFail($id);
            $coverage->name = $request->name;
            $coverage->status = $request->status;
            $coverage->price = $request->shipping_value;
            $coverage->days = $request->days;

            if ($coverage->save()) :
                return back()
                    ->with('message', 'Actualizado con éxito')
                    ->with('typealert', 'success');
            endif;
        endif;
    }

    public function postCoverageDelete($id)
    {
        $coverage = Coverage::findOrFail($id);

        if ($coverage->delete()) :
            return back()
                ->with('message', 'Cobertura de envío eliminada correctamente.')
                ->with('typealert', 'success');
        endif;
    }
}
