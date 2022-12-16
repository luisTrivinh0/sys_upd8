@php
$active_c = '';
$url = $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
if (strstr($url, 'clientes')
   or strstr($url, 'pedidos')){
  $active_c = 'active';
}
@endphp
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="{{route('index')}}">Sistema Laravel</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
      <ul class="navbar-nav">
        <li class="nav-item dropdown">
          <a class="nav-link {{$active_c}} dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Cadastros
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
            <li><a class="dropdown-item" href="{{route('cli_index')}}">Clientes</a></li>
            <li><a class="dropdown-item" href="{{route('p_index')}}">Pedidos</a></li>
          </ul>
        </li>
      </ul>
    </div>
  </div>
</nav>
