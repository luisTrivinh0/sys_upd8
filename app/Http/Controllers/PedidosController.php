<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PedidosController extends Controller
{
  public function index()
  {
    $pedidos = DB::table('pedidos')
      ->get();
    return view('pedidos.index', compact('pedidos'));
  }
}
