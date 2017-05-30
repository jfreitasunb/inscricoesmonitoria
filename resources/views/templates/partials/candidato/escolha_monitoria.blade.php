@extends('templates.default')

@section('stylesheets')
  <link href="{{ asset('css/parsley.css') }}" rel="stylesheet">
@endsection

@section('escolha_monitoria')
      <form data-parsley-validate="" action="" method="POST" class="form-group" enctype="multipart/form-data">
      <fieldset class="scheduler-border">
        <legend class="scheduler-border">Monitorias disponíveis</legend>
        <h4 align="center">Escolha até três (03) disciplinas, em ordem de prioridade.</h4>
        <div class="form-inline">
          <div class="row">
          <p>
            <div class="form-group col-xs-6">
              <label for="email">Disciplina:</label>
              <select id="id_disciplina" name="escolha_aluno[]" class="form-control" required="">
                <option value="" selected=""></option>
                @foreach ($escolhas as $escolha)
                  <option value="{{$escolha->codigo}}">{{$escolha->nome}}</option>
                @endforeach
              </select>
            </div>
            <div class="form-group col-xs-6">
              <label for="email">Menção:</label>
              <select id="id_mencao" name="mencao_aluno[]" class="form-control" required="">
                <option selected="" value=""></option>
                <option value="SS">SS</option>
                <option value="MS">MS</option>
                <option value="MM">MM</option>
              </select>
            </div> 
            </p>
          </div>
          <div class="row">
            <p>
            <div class="form-group col-xs-6">
              <label for="email">Disciplina:</label>
              <select id="id_disciplina" name="escolha_aluno[]" class="form-control">
              <option value="" selected=""></option>
                @foreach ($escolhas as $escolha)
                  <option value="{{$escolha->codigo}}">{{$escolha->nome}}</option>
                @endforeach
              </select>
            </div>
            <div class="form-group col-xs-6">
              <label for="email">Menção:</label>
              <select id="id_mencao" name="mencao_aluno[]" class="form-control">
                <option selected="" value=""></option>
                <option value="SS">SS</option>
                <option value="MS">MS</option>
                <option value="MM">MM</option>
              </select>
            </div>
            </p>
            </div>
            <div class="row">
            <p>
            <div class="form-group col-xs-6">
              <label for="email">Disciplina:</label>
              <select id="id_disciplina" name="escolha_aluno[]" class="form-control">
              <option value="" selected=""></option>
                @foreach ($escolhas as $escolha)
                  <option value="{{$escolha->codigo}}">{{$escolha->nome}}</option>
                @endforeach
              </select>
            </div>
            <div class="form-group col-xs-6">
              <label for="email">Menção:</label>
              <select id="id_mencao" name="mencao_aluno[]" class="form-control" >
                <option selected="" value=""></option>
                <option value="SS">SS</option>
                <option value="MS">MS</option>
                <option value="MM">MM</option>
              </select>
            </div> 
            </p>      
          </div>
        </div>
      </fieldset>
      <fieldset class="scheduler-border">
          <legend class="scheduler-border">Você será monitor de um projeto de monitoria específico?</legend>
          <h4>Atenção: Apenas marque SIM se você foi convidado por um professor.</h4>
          <div class="form-horizontal">
              <p>
                <input type="radio" name="monitor_projeto" id="monitor_projeto" value="nao" required="" @if(Request::old('monitor_projeto')=="nao") checked @endif> Não<br>
                <input type="radio" name="monitor_projeto" id="monitor_projeto" value="sim" @if(Request::old('monitor_projeto')=="sim") checked @endif> Sim. Por favor, digite abaixo o nome do professor que será responsável por sua monitoria. Neste caso, apenas será possível matrícula na opção de monitoria voluntária.<br>
              </p>
              <h4>Caso tenha respondido "SIM" à questão anterior, escreva o nome do professor que será responsável por sua monitoria.</h4>
              <div class="col-md-6">
                <input id="nome_professor" name="nome_professor" type="text" class="form-control input-md" value="{{Request::old('nome_professor') ?: '' }}">
              </div>
            </div>
        </fieldset>

      <fieldset class="scheduler-border">
        <legend class="scheduler-border">Tipo de Monitoria</legend>
          <div class="form-horizontal">
            <div class="row">
              <p>
                <input type="radio" name="tipo_monitoria" id="somentevoluntaria" value="somentevoluntaria" required="" @if(Request::old('tipo_monitoria')=="somentevoluntaria") checked @endif> Somente voluntária<br>
                <input type="radio" name="tipo_monitoria" id="somenteremunerada" value="somenteremunerada" @if(Request::old('tipo_monitoria')=="somenteremunerada") checked @endif> Somente remunerada<br>
                <input type="radio" name="tipo_monitoria" id="indiferente" value="indiferente" @if(Request::old('tipo_monitoria')=="indiferente") checked @endif> Indiferente<br>
              </p>
          </div>
        </fieldset>
    
        <fieldset class="scheduler-border">
          <legend class="scheduler-border">Explicite seus dias e horários possíveis para a monitoria:</legend>
          <p>
          <div class="form-horizontal">
            <div class="row">
              <table class="table table-striped">                     
                <div class="table responsive">
                  <thead>
                    <tr>
                    <th></th>
                    @foreach($array_horarios_disponiveis as $hora_disponivel)
                      <th class="text-center">{{$hora_disponivel}}</th>
                    @endforeach
                    </tr>
                  </thead>
                  <tbody>
                  @foreach($array_dias_semana as $dia_semana)
                    <tr>
                      <td>{{$dia_semana}}</td>
                      <td scope="row" class="text-center">
                        <input type="radio" name="nome_hora_monitoria_{{$dia_semana}}" id="radio_hora_monitoria" value="{{$dia_semana}}_{{$array_horarios_disponiveis[0]}}">
                      </td>
                      <td class="text-center">
                        <input type="radio" name="nome_hora_monitoria_{{$dia_semana}}" id="radio_hora_monitoria" value="{{$dia_semana}}_{{$array_horarios_disponiveis[1]}}">
                      </td>
                      <td class="text-center">
                        <input type="radio" name="nome_hora_monitoria_{{$dia_semana}}" id="checkbox_hora_monitoria" value="{{$dia_semana}}_{{$array_horarios_disponiveis[2]}}">
                      </td>
                    </tr>
                    @endforeach
                  </tbody>
                </div>
              </table>
            </div>
          </div>
          </p>
        </fieldset>

        <fieldset class="scheduler-border">
        <legend class="scheduler-border">Declaração de conhecimento das regras da Monitoria da UnB:</legend>
          <div class="row">
            <p>
              <input type="checkbox" name="concordatermos" id="concordatermos" value="1" required="">
              Declaro conhecer os critérios de participação do Programa de Monitoria de Graduação, estabelecidos pela Resolução CEPE no 008/90 de 26.10.1990 (disponível online em <a href="http://tinyurl.com/hg3ch99" target="_blank">http://tinyurl.com/hg3ch99</a>), e ser conhecedor que a participação no Programa não estabelece nenhum vínculo empregatício meu junto a Fundação Universidade de Brasília – UnB.
            </p>
          </div>
      </fieldset>

      <div class="col-xs-12" style="height:35px;"></div>
        <div class="form-group">
          <div class="row">
            <div class="col-md-6 col-md-offset-3 text-center">
              <input type="submit" name="registrar" id="register-submit" class="btn btn-primary btn-lg" tabindex="4" value="Enviar">
            </div>
          </div>
        </div>
      <input type="hidden" name="_token" value="{{ Session::token() }}">
    </form>
@endsection

@section('scripts')
  <script src="{{ asset('js/parsley.min.js') }}"></script>
  <script src="{{ asset('i18n/pt-br.js') }}"></script>
@endsection
