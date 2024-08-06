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
            'name' => 'required|unique:lcps,name'
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
            'name' => 'required|unique:lcps,name'
        ]);

        $lcp = Lcp::find($id);
        $lcp->name = $validated_lcp['name'];
        $lcp->save();
        $request->session()->flash('message', 'Se ha editado el lcp ' . $lcp->name);
        return redirect()->route('lcps.show', $id);
    }

    public function destroy (Request $request, $id)
    {
        $lcp = Lcp::find($id);
        $lcp_name = $lcp->name;
        $lcp->delete();
        $request->session()->flash('message', 'Se ha eliminado el lcp ' . $lcp_name . ' correctamente');
        return redirect()->route('lcps.index');
    }
}
