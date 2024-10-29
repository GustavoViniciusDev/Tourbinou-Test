<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Destination;
use Inertia\Inertia;

class DestinationController extends Controller
{

    public function index()
    {
        $destinations = Destination::all(['id','cidade', 'estado']);
        return Inertia::render('Destination', [
            'destinations' => $destinations,
        ]);
    }

    public function create()
    {
        return Inertia::render('Destinations/Create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'cidade' => 'required|string|max:255',
            'estado' => 'required|string|max:255',
        ]);

        Destination::create($validatedData);

        return redirect()->route('destination.index')->with('success', 'Destino registrado com sucesso!');
    }

    public function edit($id)
    {
        $destination = Destination::findOrFail($id);
        return Inertia::render('Destinations/Create', [
            'destination' => $destination,
        ]);
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'cidade' => 'required|string|max:255',
            'estado' => 'required|string|max:255',
        ]);

        $destination = Destination::findOrFail($id);
        $destination->update($validatedData);

        return redirect()->route('destination.index')->with('success', 'Destino atualizado com sucesso!');
    }

    public function destroy($id)
    {
        $destination = Destination::findOrFail($id);
        $destination->delete();

        return redirect()->route('destination.index')->with('success', 'Destino deletado com sucesso!');
    }


}
