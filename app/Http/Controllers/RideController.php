<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Destination;
use Inertia\Inertia;
use App\Models\Ride;

class RideController extends Controller
{

    public function index()
    {
        $rides = Ride::all();
        return Inertia::render('Ride',[
            'rides' => $rides,
        ]);
    }

    public function create()
    {
        $destinations = Destination::all();

        return Inertia::render('Rides/Create', [
            'destinations' => $destinations,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'horario' => 'required|string|in:manha,tarde,noite',
            'destino_id' => 'required|exists:destinations,id',
            'descricao' => 'nullable|string|max:260',
        ]);

        Ride::create([
            'nome' => $request->nome,
            'horario' => $request->horario,
            'destino_id' => $request->destino_id,
            'descricao' => $request->descricao,
        ]);

        return redirect()->route('ride.index')->with('success', 'Passeio cadastrado com sucesso!');
    }

}
