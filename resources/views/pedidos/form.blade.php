<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://igorescobar.github.io/jQuery-Mask-Plugin/js/jquery.mask.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js" integrity="sha512-pHVGpX7F/27yZ0ISY+VVjyULApbDlD0/X0rgGbTqCE7WFW5MezNTWG/dnhtbBuICzsd0WQPgpE4REBLv+UqChw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.js" integrity="sha512-0XDfGxFliYJPFrideYOoxdgNIvrwGTLnmK20xZbCAvPfLGQMzHUsaqZK8ZoH+luXGRxTrS46+Aq400nCnAT0/w==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <title>Cadastro de Clientes</title>
  </head>
  <body>
    @yield('navbar', View::make('main.navbar'))
    @show
    <div class="container">
      <form action="<?=(isset($cliente)) ? route('p_update') : route('p_save')?>" method='POST'>
        @csrf
        <div class="row mt-2">
          <div class="col-md-3">
            <label class="form-label" for="endereco">Data do Pedido *</label>
            <input class="form-control" type="date" value="<?= (isset($pedido)) ? date('Y-m-d', strtotime($pedido->data)) : ''; ?>" name="endereco" id="endereco" maxlength="120" required>
          </div>
          <div class="col-md-3">
            <label class="form-label" for="cliente">Cliente *</label>
            <select id="estado" name="cliente" class="form-control" required>
            </select>
          </div>
          <div class="col-md-4">
            <label class="form-label" for="valor">Valor *</label>
            <input class="form-control" type="text" value="<?= (isset($pedido)) ? $pedido->valor : ''; ?>" name="valor" id="valor" required>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6 mb-2">
            <a href="javascript:history.back()">
              <button class="btn btn-warning mt-3" type="button">Voltar</button>
            </a>
          </div>
          <div class="col-md-6 mb-2 text-right">
            <button class="btn btn-success mt-3" type="submit">Salvar</button>
          </div>
        </div>
      </form>
    </div>
  </body>
  <script>
    $("#valor").mask('#.##0,00', {reverse: true});
  </script>
  @yield('footer', View::make('main.footer'))
  @show
</html>