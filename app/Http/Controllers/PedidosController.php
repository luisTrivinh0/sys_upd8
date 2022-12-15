<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PedidosController extends Controller
{
  public function index()
  {
    $pedidos = DB::table('pedidos')->join('clientes', 'pedidos.id_cliente', '=', 'clientes.id')
      ->get();
    return view('pedidos.index', compact('pedidos'));
  }

  public function create()
  {
    $clientes = DB::table('clientes')
    ->get();
    return view('pedidos.form', compact('clientes'));
  }

  public function update_form(Request $request)
  {
    $pedido = DB::table('pedidos')->where('id', '=', $request->alt)->get();
    $pedido = $pedido[0];
    $clientes = DB::table('clientes')
    ->get();
    return view('clientes.form', compact('pedido', 'clientes'));
  }

  public function update(Request $request)
  {
    DB::table('pedidos')->where('id', $request->id)
      ->update([
        "id_cliente" => "$request->id_cliente",
        "data"      => "$request->data",
        "valor"     => str_replace(',', '.',str_replace('.', '',$request->valor)),
      ]);
    return redirect()->route('p_index')->with(['mensagem' => "Pedido Atualizado!"]);
  }

  public function store(Request $request)
  {
    DB::table('pedidos')->insert([
      "id_cliente" => "$request->id_cliente",
      "data"      => "$request->data",
      "valor"     => str_replace(',', '.', str_replace('.', '', $request->valor)),
    ]);
    return redirect()->route('p_index')->with(['mensagem' => "Pedido Cadastrado!"]);
  }

  public function delete(Request $request)
  {
    DB::table('pedidos')->where('id', $request->del)->delete();
    return redirect()->route('p_index')->with(['mensagem' => "Pedido Excluído!"]);
  }
}
