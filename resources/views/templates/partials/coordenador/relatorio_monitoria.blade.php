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
			      	<th scope="row"><a href="{!! route('gera.relatorio', ['id_monitoria' => $relatorio->id_monitoria]) !!}">{{$relatorio->id_monitoria}}</a></th>
			      	<td><a href="{!! route('gera.relatorio', ['id_monitoria' => $relatorio->id_monitoria]) !!}">{{$relatorio->ano_monitoria}}</a></td>
			      	<td><a href="{!! route('gera.relatorio', ['id_monitoria' => $relatorio->id_monitoria]) !!}">{{$relatorio->semestre_monitoria}}</a></td>
			      	<td><a href="{!! route('gera.relatorio', ['id_monitoria' => $relatorio->id_monitoria]) !!}">{{$relatorio->inicio_inscricao}}</a></td>
			      	<td><a href="{!! route('gera.relatorio', ['id_monitoria' => $relatorio->id_monitoria]) !!}">{{$relatorio->fim_inscricao}}</a></td>
			    	</tr>
		    	@endforeach
		  	</tbody>
		</table>
  </form>
@stop
