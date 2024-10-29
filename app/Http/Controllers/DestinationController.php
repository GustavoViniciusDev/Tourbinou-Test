<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Destination;
use Inertia\Inertia;

class DestinationController extends Controller
{
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

        return redirect()->route('ride')->with('success', 'Destino registrado com sucesso!');
    }
}
