<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class SamplesController extends Controller
{
    //
    public function create (Request $request, $order_id, $samples_number) {
        $starting_number = $request->has('starting_number') ? $request->query('starting_number'):1;
        $data = [
            'starting_number' => $starting_number,
            'order_id' => $order_id,
            'samples_number' => $samples_number
        ];

        return Inertia::render('samples/Create', $data);   
    }
}
