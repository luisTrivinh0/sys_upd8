
<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/app.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <script src="https://igorescobar.github.io/jQuery-Mask-Plugin/js/jquery.mask.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js" integrity="sha512-pHVGpX7F/27yZ0ISY+VVjyULApbDlD0/X0rgGbTqCE7WFW5MezNTWG/dnhtbBuICzsd0WQPgpE4REBLv+UqChw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.js" integrity="sha512-0XDfGxFliYJPFrideYOoxdgNIvrwGTLnmK20xZbCAvPfLGQMzHUsaqZK8ZoH+luXGRxTrS46+Aq400nCnAT0/w==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <title>Clientes</title>
  </head>
  <body>
    @yield('navbar', View::make('main.navbar'))
    @show
    <div class="col-12 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <h4 class="text-center card-title text-info">Cadastro de Clientes</h4>
          <br>
          <table class="table table-striped table-bordered" id="datatable">
            <thead>
                <th class="text-center align-middle">ID</th>
                <th class="text-center align-middle">Cliente</th>
                <th class="text-center align-middle">CPF</th>
                <th class="text-center align-middle">Data Nasc.</th>
                <th class="text-center align-middle">Endereço</th>
                <th class="text-center align-middle">Sexo</th>
                <th class="text-center align-middle">
                  <a href="{{ route('cli_form') }}">
                    <button type="button" class="btn btn-info">
                       Novo
                    </button>
                  </a>
                </th>
            </thead>
            <tbody>
              @foreach ($clientes as $cliente)
                <tr>
                  <td class="text-center">{{ $cliente->id }}</td>
                  <td class="text-center">{{ $cliente->nome }}</td>
                  <td class="text-center">{{ $cliente->cpf }}</td>
                  <td class="text-center">{{ ($cliente->data_nascimento != NULL ? date('d/m/Y', strtotime($cliente->data_nascimento)) : 'Sem Data') }}</td>
                  <td class="text-center">{{ $cliente->endereco . ' - ' . $cliente->cidade . '/' . $cliente->estado}}</td>
                  <td class="text-center">{{ ($cliente->sexo != 'M' ? 'Feminino': 'Masculino') }}</td>
                  <td class="text-center">
                    <form>
                      <button class="btn btn-warning" type="submit" name="alt" value="{{ $cliente->id }}" formaction="{{route('cli_alt')}}">Alterar</button>
                      <button class="btn btn-danger" type="submit" name="del" value="{{ $cliente->id }}" formaction="{{route('cli_del')}}">Excluir</button>
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
