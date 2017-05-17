@extends('templates.default')

@section('stylesheets')
  <link href="{{ asset('css/parsley.css') }}" rel="stylesheet">
@endsection

@section('dados_pessoais')
<div class="row">
  <form class="form-horizontal" action="" method="post">
    <fieldset class="scheduler-border">
      <legend class="scheduler-border">Dados Pessoais</legend>

      <div class="form-group">
        <div class="row">
          <label class="col-md-4 control-label" for="nome">Nome</label>  
          <div class="col-md-4">
            <input id="nome" name="nome" type="text" class="form-control input-md" required="required" {{$periodo_inscricao}}>
          </div>
        </div>
      </div>

      <div class="form-group">
        <div class="row">
          <label class="col-md-4 control-label" for="numerorg">RG</label>  
          <div class="col-md-4">
            <input id="numerorg" name="numerorg" type="text" class="form-control input-md" required="required">
          </div>
        </div>
      </div>

      <div class="form-group">
        <div class="row">
          <label class="col-md-4 control-label" for="emissorrg">Órgão Emissor</label>  
          <div class="col-md-4">
            <input id="emissorrg" name="emissorrg" type="text" class="form-control input-md" required="required">
          </div>
        </div>
      </div>

      <div class="form-group">
        <div class="row">
          <label class="col-md-4 control-label" for="cpf">CPF</label>  
          <div class="col-md-4">
            <input id="cpf" name="cpf" type="text" placeholder="Somente números" class="form-control input-md" required="required">
          </div>
        </div>
      </div>

      <div class="form-group">
        <div class="row">
          <label class="col-md-4 control-label" for="endereco">Endereço</label>  
          <div class="col-md-4">
            <input id="endereco" name="endereco" type="text" placeholder="" class="form-control input-md" required="">
          </div>
        </div>
      </div>

      <div class="form-group">
        <div class="row">
          <label class="col-md-4 control-label" for="cidade">Cidade</label>  
          <div class="col-md-4">
            <input id="cidade" name="cidade" type="text" placeholder="" class="form-control input-md" required="">
          </div>
        </div>
      </div>

      <div class="form-group">
        <div class="row">
          <label class="col-md-4 control-label" for="cep">CEP</label>  
          <div class="col-md-4">
            <input id="cep" name="cep" type="text" placeholder="" class="form-control input-md" required="">
          </div>
        </div>
      </div>

      <div class="form-group">
        <div class="row">
          <label class="col-md-4 control-label" for="estado">Estado</label>  
          <div class="col-md-4">
            <input id="estado" name="estado" type="text" placeholder="" class="form-control input-md" required="">
          </div>
        </div>
      </div>

      <div class="form-group">
        <div class="row">
          <label class="col-md-4 control-label" for="telefone">Telefone</label>  
          <div class="col-md-4">
            <input id="telefone" name="telefone" type="text" placeholder="(DD)#######" class="form-control input-md" required="">
          </div>
        </div>
      </div>

      <div class="form-group">
        <div class="row">
          <label class="col-md-4 control-label" for="celular">Celular</label>  
          <div class="col-md-4">
            <input id="celular" name="celular" type="text" placeholder="(DD)#######" class="form-control input-md" required="">
          </div>
        </div>
      </div>

      <div class="col-xs-12" style="height:35px;"></div>
      <div class="form-group">
        <div class="row">
          <div class="col-md-6 col-md-offset-3 text-center">
            <input type="submit" name="registrar" id="register-submit" class="btn btn-primary btn-lg" tabindex="4" value="Enviar">
          </div>
        </div>
      </div>
    </fieldset>
  </form>
</div>
@endsection

@section('scripts')
  <script type="text/javascript" src="{{ asset('bower_components/jquery/jquery.min.js') }}"></script>
  <script type="text/javascript" src="{{ asset('bower_components/moment/min/moment.min.js')}}"></script>
  <script type="text/javascript" src="{{ asset('bower_components/moment/locale/pt-br.js')}}"></script>
  <script type="text/javascript" src="{{ asset('bower_components/eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js')}}"></script>
  <link rel="stylesheet" href="{{ asset('bower_components/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css')}}" />
  <script src="{{ asset('bower_components/moment/locale/fr.js')}}"></script>
  <script type="text/javascript" src="{{ asset('js/datepicker.js') }}"></script>
  <script type="text/javascript" src="{{ asset('js/parsely.min.js') }}"></script>
@endsection
