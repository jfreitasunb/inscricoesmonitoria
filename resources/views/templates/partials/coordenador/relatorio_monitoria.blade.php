@extends('templates.default')

@section('relatorio_monitoria')
  <form action="" method="POST">
    <legend>Relatório de inscritos</legend>
	
    <table class="table table-striped">
  <thead>
    <tr>
      <th>Id Monitoria</th>
      <th>Ano</th>
      <th>Semestre</th>
      <th>Início</th>
      <th>Fim</th>
    </tr>
  </thead>
  <tbody>
  	@foreach($relatorio_disponivel as $relatorio)
    <tr>
      <th scope="row">{{$relatorio->id_monitoria}}</th>
      <td>{{$relatorio->ano_monitoria}}</td>
      <td>{{$relatorio->semestre_monitoria}}</td>
      <td>{{$relatorio->inicio_inscricao}}</td>
      <td>{{$relatorio->fim_inscricao}}</td>
    </tr>
    @endforeach
  </tbody>
</table>
  </form>

@stop
