<?php

namespace App\Http\Controllers;

use App\Models\Lcp;
use Illuminate\Http\Request;
use Inertia\Inertia;

class LcpsController extends Controller
{
    public function index ()
    {
        $lcps = Lcp::limit(40)
            ->get();
        return Inertia::render('lcps/Index', [
            'lcpsProp' => $lcps,
            'totalItemsProp' => Lcp::count()
        ]);
    }

    public function create ()
    {
        return Inertia::render('lcps/Create');
    }

    public function store (Request $request)
    {
        $lcp = $request->validate([
            'is_numeric' => 'boolean',
            'value' => 'required',
        ]);
        
        Lcp::create($lcp);
        $request->session()->flash('message', 'Se ha creado un lcp correctamente');
        return redirect()->route('lcps.index');
    }

    public function show ($id)
    {
        $lcp = Lcp::find($id);
        return Inertia::render('lcps/Show', ['lcp' => $lcp]);
    }

    public function edit ($id)
    {
        $lcp = Lcp::find($id);
        return Inertia::render('lcps/Edit', ['lcp' => $lcp]);
    }

    public function update (Request $request, $id)
    {
        $validated_lcp = $request->validate([
            'value' => 'required',
            'required' => 'boolean',
        ]);

        $lcp = Lcp::find($id);
        $lcp->value = $validated_lcp['value'];
        $lcp->is_numeric = $validated_lcp['is_numeric'];
        $lcp->save();
        $request->session()->flash('message', 'Se ha editado el lcp ' . $lcp->value);
        return redirect()->route('lcps.show', $id);
    }

    public function destroy (Request $request, $id)
    {
        $lcp = Lcp::find($id);
        $lcp_value = $lcp->value;
        $lcp->delete();
        $request->session()->flash('message', 'Se ha eliminado el lcp ' . $lcp_value . ' correctamente');
        return redirect()->route('lcps.index');
    }
}
