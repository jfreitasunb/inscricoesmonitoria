@extends('templates.default')

@section('content')
  <div class="container">
    <div class="row">
      <div class="col-md-6 col-md-offset-3">
        <div class="panel panel-login">
          <div class="panel-heading">
            <div class="row">
              <div class="col-xs-6">
                <a href="#" id="login-form-link">Login</a>
              </div>
            </div>
          </div>
          <div class="panel-body">
            <div class="row">
              <div class="col-lg-12">
                <form id="login-form" action="" method="post" role="form">
                  <div class="form-group">
                    <div class="required-field-block">
                      <input type="text" name="username" id="username" tabindex="1" class="form-control" placeholder="Matrícula" value="">
                        <div class="required-icon">
                          <div class="text">*</div>
                        </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="required-field-block">
                      <input type="password" name="password" id="password" tabindex="2" class="form-control" placeholder="Senha">
                      <div class="required-icon">
                        <div class="text">*</div>
                      </div>
                    </div>
                    <div class="col-xs-12" style="height:20px;"></div>
                    <div class="form-group">
                      <div class="row">
                        <div class="col-sm-6 col-sm-offset-3">
                          <input type="submit" name = "login" id="login-submit" tabindex="4" class="form-control btn btn-login" value="Entrar">
                        </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="row">
                        <div class="col-lg-12">
                          <div class="text-center">
                            <a href="#" tabindex="5" class="forgot-password">Esqueceu a senha?</a>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@stop
