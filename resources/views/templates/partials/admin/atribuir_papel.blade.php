@extends('templates.default')

@section('stylesheets')
  <link href="{{ asset('css/parsley.css') }}" rel="stylesheet">
@endsection

@section('ativa_conta')
  <div class="row">
    <form action="{{ route('atribuir.papel') }}" method="POST" data-parsley-validate class="form-horizontal">
      <fieldset class="scheduler-border">
        <legend class="scheduler-border">Pesquisar usuário</legend>
        
        <div class="form-group" {{ $errors->has('codigo') ? ' has-error' : '' }}>
          <div class="row">
            <label class="col-md-2 control-label" for="codigo">E-mail</label>  
            <div class="col-md-2">
              <input id="email" name="email" type="text" class="form-control input-md" required="" data-parsley-type="email" value="{{Request::old('email') ?: '' }}">
            </div>
          </div>
          @if ($errors->has('email'))
            <span class="help-block">{{ $errors->first('email') }}</span>
          @endif
        </div>

        <div class="col-xs-12" style="height:35px;"></div>
        <div class="form-group">
          <div class="row">
            <div class="col-md-6 col-md-offset-3 text-center">
              <input type="submit" name="registrar" id="register-submit" class="btn btn-primary btn-lg" tabindex="4" value="Pesquisar">
            </div>
          </div>
        </div>
      </fieldset>
      <input type="hidden" name="_token" value="{{ Session::token() }}">
    </form>
  </div>
@endsection

@section('scripts')
  <script src="{{ asset('js/parsley.min.js') }}"></script>
  <script src="{{ asset('i18n/pt-br.js') }}"></script>
@endsection
