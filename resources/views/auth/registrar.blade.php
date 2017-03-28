@extends('templates.default')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-6 col-md-offset-3">
      <div class="panel panel-login">
        <div class="panel-heading">
          <div class="row">
            <div class="col-xs-12">
              <a href="#" id="register-form-link">Registrar</a>
            </div>
            <hr>
          </div>
        </div>
        <div class="panel-body">
          <div class="row">
            <div class="col-lg-12">
              <form id="register-form" action="{{ route('auth.registrar') }}" method="post" role="form">
                <div class="form-group{{ $errors->has('nome') ? ' has-error' : '' }}">
                  <label for="nome" class="control-label">Nome</label>
                  <input type="text" name="nome" id="nome" tabindex="1" class="form-control" placeholder="Nome" value="{{ Request::old('nome') ?: '' }}">
                  @if ($errors->has('nome'))
                      <span class="help-block">{{ $errors->first('nome') }}</span>
                  @endif
                </div>
                <div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
                  <label for="username" class="control-label">Matrícula</label>
                  <input type="text" name="username" id="username" tabindex="1" class="form-control"  placeholder="Matrícula" value="{{ Request::old('username') ?: '' }}">
                  @if ($errors->has('username'))
                      <span class="help-block">{{ $errors->first('username') }}</span>
                  @endif
                </div>
                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                  <label for="email" class="control-label">E-mail</label>
                  <input type="email" name="email" id="email" tabindex="1" class="form-control" placeholder="Email" value="{{ Request::old('email') ?: '' }}">
                  @if ($errors->has('email'))
                      <span class="help-block">{{ $errors->first('email') }}</span>
                  @endif
                </div>
                <div class="form-group{{ $errors->has('confirmar-email') ? ' has-error' : '' }}">
                  <label for="confirmar-email" class="control-label">Confirmar E-mail</label>
                  <input type="email" name="confirmar-email" id="confirmar-email" tabindex="1" class="form-control" placeholder="Confirmar Email" value="{{ Request::old('confirmar-email') ?: '' }}">
                  @if ($errors->has('confirmar-email'))
                      <span class="help-block">{{ $errors->first('confirmar-email') }}</span>
                  @endif
                </div>
                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                  <label for="password" class="control-label">Senha</label>
                  <input type="password" name="password" id="password" tabindex="2" class="form-control" placeholder="Senha">
                  @if ($errors->has('password'))
                      <span class="help-block">{{ $errors->first('password') }}</span>
                  @endif
                </div>
                <div class="form-group{{ $errors->has('confirmar-password') ? ' has-error' : '' }}">
                  <label for="confirmar-password" class="control-label">Confirmar Senha</label>
                  <input type="password" name="confirmar-password" id="confirmar-password" tabindex="2" class="form-control" placeholder="Confirmar Senha">
                  @if ($errors->has('confirmar-password'))
                      <span class="help-block">{{ $errors->first('confirmar-password') }}</span>
                  @endif
                </div>
                <div class="form-group">
                  <div class="row">
                    <div class="col-sm-6 col-sm-offset-3">
                      <input type="submit" name="registrar" id="register-submit" tabindex="4" class="form-control btn btn-register" value="Registrar">
                    </div>
                  </div>
                </div>
                <input type="hidden" name="_token" value="{{ Session::token() }}">
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@stop