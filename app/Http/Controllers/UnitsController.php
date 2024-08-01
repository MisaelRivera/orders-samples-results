<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Unit;

class UnitsController extends Controller
{
    public function index ()
    {
        $units = Unit::limit(40)
            ->get();
        return Inertia::render('units/Index', [
            'unitsProp' => $units,
            'totalItemsProp' => Unit::count()
        ]);
    }

    public function create ()
    {
        return Inertia::render('units/Create');
    }

    public function store (Request $request)
    {
        $unit = $request->validate([
            'name' => 'required|unique:units,name'
        ]);
        
        Unit::create($unit);
        $request->session()->flash('message', 'Se ha creado una unidad correctamente');
        return redirect()->route('units.index');
    }

    public function show ($id)
    {
        $unit = Unit::find($id);
        return Inertia::render('units/Show', ['unit' => $unit]);
    }

    public function edit ($id)
    {
        $unit = Unit::find($id);
        return Inertia::render('units/Edit', ['unit' => $unit]);
    }

    public function update (Request $request, $id)
    {
        $validated_unit = $request->validate([
            'name' => 'required|unique:units,name'
        ]);

        $unit = Unit::find($id);
        $unit->name = $validated_unit['name'];
        $unit->save();
        $request->session()->flash('message', 'Se ha editado la unidad ' . $unit->name);
        return redirect()->route('units.show', $id);
    }

    public function destroy (Request $request, $id)
    {
        $unit = Unit::find($id);
        $unit_name = $unit->name;
        $unit->delete();
        $request->session()->flash('message', 'Se ha eliminado la unidad ' . $unit_name . ' correctamente');
        return redirect()->route('units.index');
    }
}
