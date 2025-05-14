<?php

namespace App\Http\Controllers;

use App\Models\Evento;
use App\Models\Servicio;
//use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Barryvdh\DomPDF\Facade\Pdf;

class ClienteEventoController extends Controller
{
    /**
     * Mostrar formulario de cotización.
     */
    public function create()
    {
        $servicios = Servicio::all();
        return view('cliente.cotizar', compact('servicios'));
    }

   public function store(Request $request)
    {
        // Validación
        $request->validate([
            'servicio_id' => 'required|exists:servicios,id',
            'ubicacion' => 'required|max:255',
            'fecha' => 'required|date|after:today',
            'personas' => 'required|integer|min:1'
        ]);

        $servicio = Servicio::findOrFail($request->servicio_id);
        $precioFinal = $servicio->precio * $request->personas;

        $evento = Evento::create([
            'servicio_id' => $servicio->id,
            'user_id' => auth()->id(),
            'precio_final' => $precioFinal,
            'ubicacion' => $request->ubicacion,
            'fecha' => $request->fecha
        ]);
        if (!$evento || !$servicio || !$precioFinal || !$request->personas) {
            abort(500, 'Error: Faltan datos para generar la cotización.');
        }
        $pdf = Pdf::loadView('cliente.cotizacion_pdf', [
            'evento' => $evento,
            'servicio' => $servicio,
            'personas' => $request->personas,
            'precioFinal' => $precioFinal
        ]);

        $pdfPath = storage_path('app/public/cotizaciones/cotizacion_' . $evento->id . '.pdf');
        if (!file_exists(dirname($pdfPath))) {
            mkdir(dirname($pdfPath), 0777, true);
        }
        $pdf->save($pdfPath);

        Mail::send('cliente.cotizacion_email', [
            'evento' => $evento,
            'servicio' => $servicio,
            'personas' => $request->personas,
            'precioFinal' => $precioFinal
        ], function ($message) use ($pdfPath) {
            $message->to(auth()->user()->email)
                ->subject('Cotización de tu Evento')
                ->attach($pdfPath, [
                    'as' => 'cotizacion.pdf',
                    'mime' => 'application/pdf',
                ]);
        });

        return redirect()->route('cliente.cotizar.form')->with('success', 'Cotización generada, guardada y enviada correctamente.');
    }
}
