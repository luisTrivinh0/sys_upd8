<?php
//Controller de Clientes
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ClientesController extends Controller
{
  public function index()
  {
    $clientes = DB::table('clientes')->select(DB::raw('id, nome, cpf, sexo, endereco, cidade, estado, data_nascimento, (select 1 from pedidos p where p.id_cliente = clientes.id) as fk_pedido'))
    ->get();
    return view('clientes.index', compact('clientes'));
  }
  public function create()
  {
    return view('clientes.form');
  }

  public function update_form(Request $request)
  {
    $cliente = DB::table('clientes')->where('id', '=', $request->alt)->get();
    $cliente = $cliente[0];
    return view('clientes.form', compact('cliente'));
  }

  public function update(Request $request)
  {
    DB::table('clientes')->where('id', $request->id)
    ->update([
      "nome"     => "$request->nome",
      "cpf"      => "$request->cpf",
      "sexo"     => "$request->sexo",
      "endereco" => "$request->endereco",
      "cidade"   => "$request->cidade",
      "estado"   => "$request->estado",
      "data_nascimento"   => "$request->data_nascimento"
    ]);
    return redirect()->route('cli_index')->with(['mensagem' => "Cliente Atualizado!"]);
  }


  public function store(Request $request)
  {
    DB::table('clientes')->insert([
      "nome"     => "$request->nome",
      "cpf"      => "$request->cpf",
      "sexo"     => "$request->sexo",
      "endereco" => "$request->endereco",
      "cidade"   => "$request->cidade",
      "estado"   => "$request->estado",
      "data_nascimento" => "$request->data_nascimento"
    ]);
    return redirect()->route('cli_index')->with(['mensagem' => "Cliente Cadastrado!"]);
  }

  public function delete(Request $request)
  {
    DB::table('clientes')->where('id', $request->del)->delete();
    return redirect()->route('cli_index')->with(['mensagem' => "Cliente Excluído!"]);
  }
}
