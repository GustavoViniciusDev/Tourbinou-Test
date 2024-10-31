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
        $rides = Ride::with('destination:id,cidade,estado')->get();
        $destinations = Destination::select('id', 'cidade', 'estado')->get();
        return Inertia::render('Ride', [
            'rides' => $rides,
            'destinations' => $destinations,
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
            'imagem' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);


        $imagePath = null;
        if ($request->hasFile('imagem')) {
            $imagePath = $request->file('imagem')->store('rides', 'public');
        }

        Ride::create([
            'nome' => $request->nome,
            'horario' => $request->horario,
            'destino_id' => $request->destino_id,
            'descricao' => $request->descricao,
            'imagem' => $imagePath,
        ]);

        return redirect()->route('ride.index')->with('success', 'Passeio cadastrado com sucesso!');
    }

    public function edit($id)
    {
        $ride = Ride::findOrFail($id);
        $destinations = Destination::all();

        return Inertia::render('Rides/Create', [
            'ride' => $ride,
            'destinations' => $destinations,
        ]);
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'nome' => 'required|string|max:255',
            'horario' => 'required|string|in:manha,tarde,noite',
            'destino_id' => 'required|exists:destinations,id',
            'descricao' => 'nullable|string|max:260',
            'imagem' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $ride = Ride::findOrFail($id);

        if ($request->hasFile('imagem')) {
            $imagePath = $request->file('imagem')->store('rides', 'public');
            $validatedData['imagem'] = $imagePath;
        }

        $ride->update($validatedData);

        return redirect()->route('ride.index')->with('success', 'Passeio atualizado com sucesso!');
    }


    public function destroy($id)
    {
        $ride = Ride::findOrFail($id);
        $ride->delete();

        return redirect()->route('ride.index')->with('success', 'Passeio excluído com sucesso!');
    }

}
