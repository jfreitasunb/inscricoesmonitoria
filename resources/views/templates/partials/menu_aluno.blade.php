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
            <li><a href="#">Dados Pessoais</a></li>
            <li><a href="#">Dados Bancários</a></li>
            <li><a href="#">Dados Acadêmicos</a></li>
            <li><a href="#">Escolher Monitoria</a></li>
            <li><a href="{{ route('auth.logout') }}">Sair</a></li>
          </ul>
        </div>
      </nav>
    </div>