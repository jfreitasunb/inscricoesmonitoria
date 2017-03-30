@extends('templates.default')

@section('menu_aluno')
<div class="container">
  <div class="row">
    <nav class="navbar navbar-default col-md-8 col-md-offset-2" role="navigation">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bar1">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
      </div>
      <div class="collapse navbar-collapse" id="bar1">
        <ul class="nav navbar-nav">
          <!-- BEGIN dados_pessoais-->
          <li><a href="{dados_pessoais}">Dados Pessoais</a></li>
          <!-- END dados_pessoais -->
          <!-- BEGIN dados_bancario -->
          <li><a href="{dados_bancarios}">Dados Bancários</a></li>
          <!-- END dados_bancarios -->
          <!-- BEGIN dados_academicos-->
          <li><a href="{dados_academicos}">Dados Acadêmicos</a></li>
          <!-- END dados_academicos -->
          <!-- BEGIN escolher_monitoria -->
          <li><a href="{escolher_monitoria}">Escolher Monitoria</a></li>
          <!-- END escolher_monitoria -->
          <li><a href="logout.php">Sair</a></li>
        </ul>
      </div>
    </nav>
  </div>
</div>
@stop
