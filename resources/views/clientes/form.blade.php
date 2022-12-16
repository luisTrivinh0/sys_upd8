

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
    <form action="<?=(isset($cliente)) ? route('cli_update') : route('cli_save')?>" method='POST'>
      @csrf
      <div class="row mt-5">
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
      <div style="display: none;" id="map" hidden></div>
      <div class="row mt-2">
        <div class="col-md-5">
          <label class="form-label" for="endereco">Endereço *</label>
          <input class="form-control" type="text" value="<?= (isset($cliente)) ? $cliente->endereco : ''; ?>" name="endereco" id="endereco" placeholder="Busque pelo endereço e selecione" maxlength="255" required>
        </div>
        <div class="col-md-3">
          <label class="form-label" for="estado">Estado *</label>
          <select id="estado" name="estado" class="form-select" onchange='busca_cidades($("#estado").find("option:selected").attr("id"));'required>
            <option value="" selected>Selecione um Estado</option>
          </select>
        </div>
        <div class="col-md-4">
          <label class="form-label" for="cidade">Cidade *</label>
          <select id="cidade" name="cidade" class="form-select" required>
          </select>
        </div>
      </div>
      <div class="row">
        <div class="col-md-6 mb-2">
          <a href="javascript:history.back()">
            <button class="btn btn-warning mt-3" type="button">Voltar</button>
          </a>
        </div>
        <div class="col-md-6 mb-2 text-end">
          <button class="btn btn-success mt-3" type="submit">Salvar</button>
        </div>
      </div>
    </form>
  </div>
</body>
<script async src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCLYIM9y3BiU0MVmgq3TjWXrteh3iFJUBg&callback=initAutocomplete&libraries=places&v=weekly"></script>
<script>
  function initAutocomplete() {
    const map = new google.maps.Map(document.getElementById("map"), {
      center: { lat: -33.8688, lng: 151.2195 },
      zoom: 13,
      mapTypeId: "roadmap",
    });
    // Create the search box and link it to the UI element.
    const input = document.getElementById("endereco");
    const searchBox = new google.maps.places.SearchBox(input);
    map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);
    // Bias the SearchBox results towards current map's viewport.
    map.addListener("bounds_changed", () => {
      searchBox.setBounds(map.getBounds());
    });
    let markers = [];
    // Listen for the event fired when the user selects a prediction and retrieve
    // more details for that place.
    searchBox.addListener("places_changed", () => {
      const places = searchBox.getPlaces();
      if (places.length == 0) {
        return;
      }
      // Clear out the old markers.
      markers.forEach((marker) => {
        marker.setMap(null);
      });
      markers = [];
      // For each place, get the icon, name and location.
      const bounds = new google.maps.LatLngBounds();
      places.forEach((place) => {
        if (!place.geometry || !place.geometry.location) {
          console.log("Returned place contains no geometry");
          return;
        }
        const icon = {
          url: place.icon,
          size: new google.maps.Size(71, 71),
          origin: new google.maps.Point(0, 0),
          anchor: new google.maps.Point(17, 34),
          scaledSize: new google.maps.Size(25, 25),
        };
        // Create a marker for each place.
        markers.push(
          new google.maps.Marker({
            map,
            icon,
            title: place.name,
            position: place.geometry.location,
          })
        );
        console.log(place.address_components);
        console.log(place.address_components[0].short_name.length);
        if(place.address_components[1].short_name.length == 2){
          $('#estado').val(place.address_components[1].short_name).change();
          busca_cidades($('#estado').val(), place.address_components[0].short_name);
        }else if(place.address_components[2].short_name.length == 2){
          $('#estado').val(place.address_components[2].short_name).change();
          busca_cidades($('#estado').val(), place.address_components[1].short_name);
        }else if(place.address_components[3].short_name.length == 2){
          $('#estado').val(place.address_components[3].short_name).change();
          busca_cidades($('#estado').val(), place.address_components[2].short_name);
        }else if(place.address_components[4].short_name.length == 2){
          $('#estado').val(place.address_components[4].short_name).change();
          busca_cidades($('#estado').val(), place.address_components[3].short_name);
        }else if(place.address_components[5].short_name.length == 2){
          $('#estado').val(place.address_components[5].short_name).change();
          busca_cidades($('#estado').val(), place.address_components[4].short_name);
        }else if(place.address_components[6].short_name.length == 2){
          $('#estado').val(place.address_components[6].short_name).change();
          busca_cidades($('#estado').val(), place.address_components[5].short_name);
        }else if(place.address_components[7].short_name.length == 2){
          $('#estado').val(place.address_components[7].short_name).change();
          busca_cidades($('#estado').val(), place.address_components[6].short_name);
        }
        if (place.geometry.viewport) {
          // Only geocodes have viewport.
          bounds.union(place.geometry.viewport);
        } else {
          bounds.extend(place.geometry.location);
        }
      });
      map.fitBounds(bounds);
    });
  }
  window.initAutocomplete = initAutocomplete;
  $(document).ready(function () {
    $.ajax({
        type: "get",
        url: "https://servicodados.ibge.gov.br/api/v1/localidades/estados/",
        data: {orderBy: 'nome'},
        dataType: 'json',
        contentType: "application/json; charset=utf-8",
        success: function (obj) {
          if (obj != null) {
            var selectbox = $('#estado');
            $.each(obj, function (i, d) {
               if('{{(isset($cliente)) ? $cliente->estado : ''}}' == d.sigla){
                 $('<option>').val(d.sigla).attr('id', d.id).text(d.nome).appendTo(selectbox).attr("selected","selected");
               }else{
                 $('<option>').val(d.sigla).attr('id', d.id).text(d.nome).appendTo(selectbox);
               }
            });
            if ( $('#estado').val() == ""){
              $('#estado').val('').change();
            }
          }
        }
    });
  });
  $('#estado').val('{{(isset($cliente)) ? $cliente->estado : ''}}').change();
  if('{{(isset($cliente)) ? $cliente->estado : ''}}' != ""){
    busca_cidades('{{(isset($cliente)) ? $cliente->estado : ''}}', '{{(isset($cliente)) ? $cliente->cidade : ''}}');
  }
  function busca_cidades(id, cidade = "") {
    $.ajax({
      type: "get",
      url: "https://servicodados.ibge.gov.br/api/v1/localidades/estados/"+id+"/municipios",
      data: {},
      dataType: 'json',
      contentType: "application/json; charset=utf-8",
      success: function (obj) {
        if (obj != null) {
          var selectbox = $('#cidade');
          if(obj == ""){
              $('<option>').val('').text('Selecione um Estado para Filtrar a Cidade').appendTo(selectbox).attr("selected","selected");
          }else{
            selectbox.find('option').remove();
            $.each(obj, function (i, d) {
              console.log(cidade);
              if (cidade == d.nome){
                $('<option>').val(d.nome).text(d.nome).appendTo(selectbox).attr("selected","selected");
              }else{
                $('<option>').val(d.nome).text(d.nome).appendTo(selectbox);
              }
            });
          }
        }
      }
    });
  }
  $('#sexo').val('{{(isset($cliente)) ? $cliente->sexo : ''}}').change();
  $("#cpf").mask('000.000.000-00')
</script>
@yield('footer', View::make('main.footer'))
@show
