<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Method;

class MethodsController extends Controller
{
    public function index ()
    {
        $methods = Method::limit(40)
            ->get();
        return Inertia::render('methods/Index', [
            'methodsProp' => $methods,
            'totalItemsProp' => Method::count()
        ]);
    }

    public function create ()
    {
        return Inertia::render('methods/Create');
    }

    public function store (Request $request)
    {
        $method = $request->validate([
            'name' => 'required|unique:methods,name'
        ]);
        
        Method::create($method);
        $request->session()->flash('message', 'Se ha creado un metodo correctamente');
        return redirect()->route('methods.index');
    }

    public function show ($id)
    {
        $method = Method::find($id);
        return Inertia::render('methods/Show', ['method' => $method]);
    }

    public function edit ($id)
    {
        $method = Method::find($id);
        return Inertia::render('methods/Edit', ['method' => $method]);
    }

    public function update (Request $request, $id)
    {
        $validated_method = $request->validate([
            'name' => 'required|unique:methods,name'
        ]);

        $method = Method::find($id);
        $method->name = $validated_method['name'];
        $method->save();
        $request->session()->flash('message', 'Se ha editado el metodo ' . $method->name);
        return redirect()->route('methods.show', $id);
    }

    public function destroy (Request $request, $id)
    {
        $method = Method::find($id);
        $method_name = $method->name;
        $method->delete();
        $request->session()->flash('message', 'Se ha eliminado el metodo ' . $method_name . ' correctamente');
        return redirect()->route('methods.index');
    }
}
