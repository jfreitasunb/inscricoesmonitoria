@extends('templates.default')

@section('configura_monitoria')
  <form action="" method="POST">
    <legend>Configurar período da abertura da inscrição</legend>
    <div class="row">
      <div class='col-xs-4'>
          <div class="form-group form-inline">
              <label for="">Início da Inscríção:</label>
              <div class='input-group date' id='inicio_inscricao'>
                  <input type='text' class="form-control" name="inicio_inscricao"/>
                  <span class="input-group-addon">
                      <span class="glyphicon glyphicon-calendar"></span>
                  </span>
              </div>
          </div>
      </div>
      <div class='col-xs-4'>
          <div class="form-group form-inline">
              <label for="">Final da Inscríção:</label>
              <div class='input-group date' id='fim_inscricao'>
                  <input type='text' class="form-control" name="fim_inscricao"/>
                  <span class="input-group-addon">
                      <span class="glyphicon glyphicon-calendar"></span>
                  </span>
              </div>
          </div>
      </div>
      <div class="col-xs-4">
        <div class="form-group form-inline">
        <label for="">Semestre: </label>
          <input type="radio" name="semestre" class="radio" value="1"> 1
          <input type="radio" name="semestre" class="radio" value="2"> 2
        </div>
      </div>
    </div>

    <legend>Escolher disciplinas disponíveis para a Monitoria</legend>
    <div class="row">
      <div class="col-xs-12">
        <div class="form-group form-horizontal">
          <input type="checkbox" name="selectAll" id="disciplinas" /> Selecionar todos
          <table class="table table-striped" id="disciplinas">
            <thead>
              <tr>
                <th>Disponível</th>
                <th>Disciplina</th>
                <th>Disponível</th>
                <th>Disciplina</th>
              </tr>
            </thead>
            <tbody>
            <?php $i=0;?>
            @while ($i < sizeof($disciplinas))
                <tr>
                  <td><input type="checkbox" id="disciplinas" name="escolhas_coordenador[]" class="checkbox" {{ $disciplinas[$i]->codigo }}></td>
                  <td>{{ $disciplinas[$i]->nome }}</td>
                  @if ($i+1<sizeof($disciplinas))
                    <td><input type="checkbox" id="disciplinas" name="escolhas_coordenador[]" class="checkbox" {{ $disciplinas[$i+1]->codigo }}></td>
                    <td>{{ $disciplinas[$i+1]->nome }}</td>
                  @endif
                </tr>
                <?php $i=$i+2;?>
            @endwhile
            </tbody>
          </table>
        </div>
      </div>
    </div>

    <div id="hidden_form_container" style="display:none;"></div>
    <div class="col-xs-12" style="height:35px;"></div>
        <div class="form-group">
          <div class="row">
            <div class="col-md-6 col-md-offset-3 text-center">
              <input type="submit" name="registrar" id="register-submit" class="btn btn-primary btn-lg" tabindex="4" value="Enviar">
            </div>
          </div>
        </div>
  </form>

  <div id="result"></div>
@stop
