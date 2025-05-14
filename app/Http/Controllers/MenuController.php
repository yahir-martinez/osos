<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function index(Request $request)
    {
        $menus = Menu::all();
        $menuEdit = null;

        if ($request->has('edit')) {
            $menuEdit = Menu::findOrFail($request->edit);
        }

        return view('admin.menu', compact('menus', 'menuEdit'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required',
            'precio' => 'required|numeric',
            'descripcion' => 'required|max:255',
            'imagen' => 'nullable|string'
        ]);

        Menu::create($request->all());

        return redirect()->route('menus.index')->with('success', 'Menú creado correctamente');
    }

    public function update(Request $request, Menu $menu)
    {
        $request->validate([
            'nombre' => 'required',
            'precio' => 'required|numeric',
            'descripcion' => 'required|max:255',
            'imagen' => 'nullable|string'
        ]);

        $menu->update($request->all());

        return redirect()->route('menus.index')->with('success', 'Menú actualizado correctamente');
    }

    public function destroy(Menu $menu)
    {
        $menu->delete();
        return redirect()->route('menus.index')->with('success', 'Menú eliminado correctamente');
    }
}
