<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Parameter;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ParametersController extends Controller
{
    //
    public function index ()
    {
        $parameters = Parameter::limit(40)
            ->get();
        return Inertia::render('parameters/Index', [
            'parametersProp' => $parameters,
            'totalItemsProp' => Parameter::count()
        ]);
    }

    public function create ()
    {
        return Inertia::render('parameters/Create');
    }

    public function store (Request $request)
    {
        $parameter = $request->validate([
            'name' => 'required|unique:parameters,name'
        ]);
        
        Parameter::create($parameter);
        $request->session()->flash('message', 'Se ha creado un parametro correctamente');
        return redirect()->route('parameters.index');
    }

    public function show ($id)
    {
        $parameter = Parameter::find($id);
        return Inertia::render('parameters/Show', ['parameter' => $parameter]);
    }

    public function edit ($id)
    {
        $parameter = Parameter::find($id);
        return Inertia::render('parameters/Edit', ['parameter' => $parameter]);
    }

    public function update (Request $request, $id)
    {
        $validated_parameter = $request->validate([
            'name' => 'required|unique:parameters,name'
        ]);

        $parameter = Parameter::find($id);
        $parameter->name = $validated_parameter['name'];
        $parameter->save();
        $request->session()->flash('message', 'Se ha editado el parametro ' . $parameter->name);
        return redirect()->route('parameters.show', $id);
    }

    public function destroy (Request $request, $id)
    {
        $parameter = Parameter::find($id);
        $parameter_name = $parameter->name;
        $parameter->delete();
        $request->session()->flash('message', 'Se ha eliminado el parametro ' . $parameter_name . ' correctamente');
        return redirect()->route('parameters.index');
    }
}
