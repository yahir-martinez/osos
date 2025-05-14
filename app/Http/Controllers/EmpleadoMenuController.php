<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;

class EmpleadoMenuController extends Controller
{
    public function index()
    {
        $menus = Menu::all();
        return view('empleado.menu', compact('menus'));
    }
}
