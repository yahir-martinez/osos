<?php

namespace App\Http\Controllers;

use App\Models\Evento;
use App\Models\Servicio;
use Illuminate\Http\Request;

class EventoController extends Controller
{
    public function index(Request $request)
    {
        $eventos = Evento::with('servicio')->get();
        $servicios = Servicio::all();
        $eventoEdit = null;

        if ($request->has('edit')) {
            $eventoEdit = Evento::findOrFail($request->edit);
        }

        return view('admin.evento', compact('eventos', 'servicios', 'eventoEdit'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'servicio_id' => 'required|exists:servicios,id',
            'precio_final' => 'required|numeric',
            'ubicacion' => 'required|max:255',
            'fecha' => 'required|date'
        ]);

        Evento::create($request->all());

        return redirect()->route('eventos.index')->with('success', 'Evento creado correctamente');
    }

    public function update(Request $request, Evento $evento)
    {
        $request->validate([
            'servicio_id' => 'required|exists:servicios,id',
            'precio_final' => 'required|numeric',
            'ubicacion' => 'required|max:255',
            'fecha' => 'required|date'
        ]);

        $evento->update($request->all());

        return redirect()->route('eventos.index')->with('success', 'Evento actualizado correctamente');
    }

    public function destroy(Evento $evento)
    {
        $evento->delete();
        return redirect()->route('eventos.index')->with('success', 'Evento eliminado correctamente');
    }
}
