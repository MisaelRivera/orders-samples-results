<?php

namespace App\Http\Controllers;

use App\Models\Parameter;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Rule;

class RulesController extends Controller
{
    public function index ()
    {
        $rules = Rule::limit(40)
            ->get();
        return Inertia::render('rules/Index', [
            'rulesProp' => $rules,
            'totalItemsProp' => Rule::count()
        ]);
    }

    public function create ()
    {
        return Inertia::render('rules/Create');
    }

    public function store (Request $request)
    {
        $rule = $request->validate([
            'name' => 'required|unique:rules,name'
        ]);
        
        Rule::create($rule);
        $request->session()->flash('message', 'Se ha creado una norma correctamente');
        return redirect()->route('rules.index');
    }

    public function show ($id)
    {
        $rule = Rule::find($id);
        $parameters = Parameter::all();
        $parameters = $parameters->map(function ($parameter) {
            return ['value' => $parameter->name, 'key' => $parameter->parameter_id];
        });
        return Inertia::render('rules/Show', [
            'rule' => $rule,
            'parameters' => $parameters
        ]);
    }

    public function edit ($id)
    {
        $rule = Rule::find($id);
        return Inertia::render('rules/Edit', ['rule' => $rule]);
    }

    public function update (Request $request, $id)
    {
        $validated_rule = $request->validate([
            'name' => 'required|unique:rules,name'
        ]);

        $rule = Rule::find($id);
        $rule->name = $validated_rule['name'];
        $rule->save();
        $request->session()->flash('message', 'Se ha editado la norma ' . $rule->name);
        return redirect()->route('rules.show', $id);
    }

    public function destroy (Request $request, $id)
    {
        $rule = Rule::find($id);
        $rule_name = $rule->name;
        $rule->delete();
        $request->session()->flash('message', 'Se ha eliminado la norma ' . $rule_name . ' correctamente');
        return redirect()->route('rules.index');
    }
}
