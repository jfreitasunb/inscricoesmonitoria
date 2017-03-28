@extends('templates.default')

@section('content')
  <div class="row">
    <div class="col-md-6 col-md-offset-3">
      <div class="panel panel-login">
        <div class="panel-heading">
          <div class="row">
            <div class="col-xs-6">
              <a href="#" id="login-form-link">Login</a>
            </div>
            <div class="col-xs-6">
              <a href="{{ route('auth.registrar') }}" id="register-form-link">Registrar</a>
            </div>
          </div>
        </div>
        </div>
        </div>
        </div>
@stop