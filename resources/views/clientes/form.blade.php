<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://igorescobar.github.io/jQuery-Mask-Plugin/js/jquery.mask.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js" integrity="sha512-pHVGpX7F/27yZ0ISY+VVjyULApbDlD0/X0rgGbTqCE7WFW5MezNTWG/dnhtbBuICzsd0WQPgpE4REBLv+UqChw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.js" integrity="sha512-0XDfGxFliYJPFrideYOoxdgNIvrwGTLnmK20xZbCAvPfLGQMzHUsaqZK8ZoH+luXGRxTrS46+Aq400nCnAT0/w==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <title>Cadastro de Clientes</title>
  </head>
  <body>
    <div class="container">
      <form action="<?=(isset($cliente)) ? route('cli_update') : route('cli_save')?>" method='POST'>
        @csrf
        <div class="form-row mt-5">
          <div class="col-md-4">
            <label class="form-label" for="cpf">CPF *</label>
            <input value="<?= (isset($cliente)) ? $cliente->id : ''; ?>" type="hidden" name="id" id="id" hidden>
            <input class="form-control cpf" value="<?= (isset($cliente)) ? $cliente->cpf : ''; ?>" type="text" name="cpf" id="cpf" required>
          </div>
          <div class="col-md-4">
            <label class="form-label" for="nome">Nome *</label>
            <input class="form-control" type="text" value="<?= (isset($cliente)) ? $cliente->nome : ''; ?>" name="nome" id="nome" maxlength="90" required>
          </div>
          <div class="col-md-2">
            <label class="form-label" for="data_nascimento">Data de Nascimento</label>
            <input class="form-control" value="<?= (isset($cliente)) ? date('Y-m-d', strtotime($cliente->data_nascimento)) : date('Y-m-d'); ?>" type="date" name="data_nascimento" id="data_nascimento">
          </div>
          <div class="col-md-2">
            <label class="form-label" for="sexo">Sexo *</label>
            <select id="sexo" name="sexo" class="form-control" required>
              <option value="">Selecione</option>
              <option value="M">Masculino</option>
              <option value="F">Feminino</option>
            </select>
          </div>
        </div>
        <div class="form-row mt-2">
          <div class="col-md-5">
            <label class="form-label" for="endereco">Endereço *</label>
            <input class="form-control" type="text" value="<?= (isset($cliente)) ? $cliente->endereco : ''; ?>" name="endereco" id="endereco" maxlength="120" required>
          </div>
          <div class="col-md-4">
            <label class="form-label" for="cidade">Cidade *</label>
            <input class="form-control" type="text" value="<?= (isset($cliente)) ? $cliente->cidade : ''; ?>" name="cidade" id="cidade" maxlength="120" required>
          </div>
          <div class="col-md-3">
            <label class="form-label" for="estado">Estado *</label>
            <select id="estado" name="estado" class="form-control" required>
              <option value="AC">Acre</option>
              <option value="AL">Alagoas</option>
              <option value="AP">Amapá</option>
              <option value="AM">Amazonas</option>
              <option value="BA">Bahia</option>
              <option value="CE">Ceará</option>
              <option value="DF">Distrito Federal</option>
              <option value="ES">Espírito Santo</option>
              <option value="GO">Goiás</option>
              <option value="MA">Maranhão</option>
              <option value="MT">Mato Grosso</option>
              <option value="MS">Mato Grosso do Sul</option>
              <option value="MG">Minas Gerais</option>
              <option value="PA">Pará</option>
              <option value="PB">Paraíba</option>
              <option value="PR">Paraná</option>
              <option value="PE">Pernambuco</option>
              <option value="PI">Piauí</option>
              <option value="RJ">Rio de Janeiro</option>
              <option value="RN">Rio Grande do Norte</option>
              <option value="RS">Rio Grande do Sul</option>
              <option value="RO">Rondônia</option>
              <option value="RR">Roraima</option>
              <option value="SC">Santa Catarina</option>
              <option value="SP">São Paulo</option>
              <option value="SE">Sergipe</option>
              <option value="TO">Tocantins</option>
              <option value="EX">Estrangeiro</option>
            </select>
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
    $("#cpf").mask('000.000.000-00')
  </script>
</html>