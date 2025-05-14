<?php

namespace App\Http\Controllers;

use App\Models\Servicio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ServicioController extends Controller
{
    public function index()
    {
        // Obtener todos los servicios
        $servicios = Servicio::all();

        // Retornar la vista con los servicios
        return view('admin.servicio', compact('servicios'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required',
            'precio' => 'required|numeric',
            'descripcion' => 'required|max:255',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',  // Validación de imagen
        ]);

        // Subir imagen
        if ($request->hasFile('imagen')) {
            $imagenPath = $request->file('imagen')->store('imagenes', 'public');  // Guardar en public/imagenes
        }

        Servicio::create([
            'nombre' => $request->nombre,
            'precio' => $request->precio,
            'descripcion' => $request->descripcion,
            'imagen' => $imagenPath ?? '',  // Guardar la ruta de la imagen
        ]);

        return redirect()->route('servicios.index')->with('success', 'Servicio creado correctamente');
    }

    public function update(Request $request, Servicio $servicio)
    {
        $request->validate([
            'nombre' => 'required',
            'precio' => 'required|numeric',
            'descripcion' => 'required|max:255',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',  // Validación de imagen
        ]);

        // Subir imagen si la hay
        if ($request->hasFile('imagen')) {
            // Eliminar imagen anterior si existe
            if ($servicio->imagen) {
                Storage::disk('public')->delete($servicio->imagen);
            }
            // Subir nueva imagen
            $imagenPath = $request->file('imagen')->store('imagenes', 'public');
        } else {
            $imagenPath = $servicio->imagen;  // No hay cambio en la imagen
        }

        $servicio->update([
            'nombre' => $request->nombre,
            'precio' => $request->precio,
            'descripcion' => $request->descripcion,
            'imagen' => $imagenPath,  // Guardar la nueva ruta de la imagen
        ]);

        return redirect()->route('servicios.index')->with('success', 'Servicio actualizado correctamente');
    }
}
