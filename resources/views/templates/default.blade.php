<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
  <title>Inscrições Monitoria do MAT/UnB</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ asset('css/css_monitoria.css') }}" rel="stylesheet">

  @yield('stylesheets')
</head>
<body>
<div class="container">
    <div class="row">
      <div class="jumbotron col-xs-12">
        <div class="page-header">
          <h1 class="col-xs-12">Departamento de Matemática</h1> 
          <h2>Inscrições para a Monitoria do MAT: {{$periodo_inscricao}}</h2> 
        </div>
      </div>
    </div>
  </div>
  <div class="container">
    @include('templates.partials.alerts')
    @if (Auth::check())
      {{-- @include($templatemenu) --}}
      @if (Session::has('user_type') && Session::get('user_type')==='aluno')
        @include('templates.partials.menu_aluno')
        @yield('dados_pessoais')
        @yield('dados_bancarios')
        @yield('dados_academicos')
      @endif
      @if (Session::has('user_type') && Session::get('user_type')==='coordenador')
        @include('templates.partials.menu_coordenador')
        @yield('configura_monitoria')
        @yield('relatorio_monitoria')
      @endif
      @if (Session::has('user_type') && Session::get('user_type')==='admin')
        @include('templates.partials.menu_admin')
      @endif
    @else
      @yield('content')
    @endif
  </div>
</body>
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
  <script src="{{ asset('jquery/jquery-3.1.1.min.js') }}"></script>
  <!-- Include all compiled plugins (below), or include individual files as needed -->
  <script src="{{ asset('js/bootstrap.min.js') }}"></script>
  <script src="{{ asset('js/monitoria.js') }}"></script>
  

  @yield('scripts')

</html>
