
<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/app.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pedidos</title>
  </head>
  <body>
    @yield('navbar', View::make('main.navbar'))
    @show
    <div class="col-12 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <h4 class="text-center card-title text-info">Cadastro de Pedidos</h4>
          <br>
          <table class="table table-striped table-bordered" id="datatable">
            <thead>
                <th class="text-center align-middle">ID</th>
                <th class="text-center align-middle">Cliente</th>
                <th class="text-center align-middle">
                  <a href="{{ route('p_form') }}">
                    <button type="button" class="btn btn-info">
                       Novo
                    </button>
                  </a>
                </th>
            </thead>
            <tbody>
              @foreach ($pedidos as $pedido)
                <tr>
                  <td class="text-center">{{ $pedido->id }}</td>
                  <td class="text-center">{{ $pedido->id_cliente }}</td>
                  <td class="text-center">
                    <form>
                      <button class="btn btn-warning" type="submit" name="alt" value="{{ $pedido->id }}" formaction="{{route('p_alt')}}">Alterar</button>
                      <button class="btn btn-danger" type="submit" name="del" value="{{ $pedido->id }}" formaction="{{route('p_del')}}">Excluir</button>
                    </form>
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </body>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.css">
  <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.js"></script>
  <script>
    $(document).ready( function () {
      $('#datatable').DataTable({
        "language": {
            "sProcessing":    "Processando...",
            "sLengthMenu":    "Mostrar _MENU_ registros",
            "sZeroRecords":   "Não há resultados encontrados",
            "sEmptyTable":    "Não há dados",
            "sInfo":          "Mostrando registros de _START_ à _END_ de um total de _TOTAL_ registros",
            "sInfoEmpty":     "Mostrando registros de 0 à 0 de um total de 0 registros",
            "sInfoFiltered":  "(filtrado de um total de _MAX_ registros)",
            "sInfoPostFix":   "",
            "sSearch":        "Procurar:",
            "sUrl":           "",
            "sInfoThousands":  ",",
            "sLoadingRecords": "Carregando...",
            "oPaginate": {
                "sFirst":    "Primeiro",
                "sLast":    "Último",
                "sNext":    "Próxima",
                "sPrevious": "Anterior"
            },
            "oAria": {
                "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                "sSortDescending": ": Activar para ordenar la columna de manera descendente"
            }
        }
      });
    } );
    var msg ="{{ session()->get('mensagem')}}";
    if (msg != ""){
      Swal.fire(
              'Sucesso!',
              msg,
              'success'
            )
    }
  </script>
        @yield('footer', View::make('main.footer'))
    @show
</html>