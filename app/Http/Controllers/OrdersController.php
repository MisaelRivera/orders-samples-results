<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use Inertia\Inertia;

class OrdersController extends Controller
{
    //
    public function index ()
    {
        $orders = Order::with(['samples'])
            ->orderBy('id', 'desc')
            ->limit(40)
            ->get();
        $count = Order::count();
        return Inertia::render('orders/Index', ['ordersProp' => $orders, 'totalItemsProp' => $count]);
    }

    public function create ()
    {
        return Inertia::render('orders/Create');
    }

    public function store (Request $request)
    {
        $order = $request->validate([
            'tipo_muestra' => 'required',
            'fecha_recepcion' => 'required',
            'hora_recepcion' => 'required',
            'numero_muestras' => 'required|min:0|max:30',
        ],
        [
          'tipo_muestra.required' => 'Igrese el tipo de muestra',  
          'fecha_recepcion.required' => 'Igrese la fecha de recepcion',  
          'hora_recepcion.required' => 'Igrese la hora de recepcion',  
          'numero_muestras.required' => 'Igrese el numero de muestras',  
          'numero_muestras.min' => 'El numero de muestras debe ser al menos 0',  
          'numero_muestras.max' => 'El numero de muestras no debe ser mas de 30',  
        ]);

        $created_order = Order::create($order);
        $request->session()->flash('message', 'La orden ha sido creada correctamente.');
        return redirect("/samples/create/$created_order->id/$created_order->numero_muestras");
    }
}
