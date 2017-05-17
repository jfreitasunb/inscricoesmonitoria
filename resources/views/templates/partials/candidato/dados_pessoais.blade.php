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
            <input id="numerorg" name="numerorg" type="text" class="form-control input-md" required="required" {{$numerorg}}>
          </div>
        </div>
      </div>

      <div class="form-group">
        <div class="row">
          <label class="col-md-4 control-label" for="emissorrg">Órgão Emissor</label>  
          <div class="col-md-4">
            <input id="emissorrg" name="emissorrg" type="text" class="form-control input-md" required="required" {{$emissorrg}}>
          </div>
        </div>
      </div>

      <div class="form-group">
        <div class="row">
          <label class="col-md-4 control-label" for="cpf">CPF</label>  
          <div class="col-md-4">
            <input id="cpf" name="cpf" type="text" placeholder="Somente números" class="form-control input-md" required="required" {{$cpf}}>
          </div>
        </div>
      </div>

      <div class="form-group">
        <div class="row">
          <label class="col-md-4 control-label" for="endereco">Endereço</label>  
          <div class="col-md-4">
            <input id="endereco" name="endereco" type="text" placeholder="" class="form-control input-md" required="" {{$endereco}}>
          </div>
        </div>
      </div>

      <div class="form-group">
        <div class="row">
          <label class="col-md-4 control-label" for="cidade">Cidade</label>  
          <div class="col-md-4">
            <input id="cidade" name="cidade" type="text" placeholder="" class="form-control input-md" required="" {{$cidade}}>
          </div>
        </div>
      </div>

      <div class="form-group">
        <div class="row">
          <label class="col-md-4 control-label" for="cep">CEP</label>  
          <div class="col-md-4">
            <input id="cep" name="cep" type="text" placeholder="" class="form-control input-md" required="" {{$cep}}>
          </div>
        </div>
      </div>

      <div class="form-group">
        <div class="row">
          <label class="col-md-4 control-label" for="estado">Estado</label>  
          <div class="col-md-4">
            <input id="estado" name="estado" type="text" placeholder="" class="form-control input-md" required="" {{$estado}}>
          </div>
        </div>
      </div>

      <div class="form-group">
        <div class="row">
          <label class="col-md-4 control-label" for="telefone">Telefone</label>  
          <div class="col-md-4">
            <input id="telefone" name="telefone" type="text" placeholder="(DD)#######" class="form-control input-md" required="" {{$telefone}}>
          </div>
        </div>
      </div>

      <div class="form-group">
        <div class="row">
          <label class="col-md-4 control-label" for="celular">Celular</label>  
          <div class="col-md-4">
            <input id="celular" name="celular" type="text" placeholder="(DD)#######" class="form-control input-md" required="" {{$celular}}>
          </div>
        </div>
      </div>

      <div class="col-xs-12" style="height:35px;"></div>
      <div class="form-group">
        <div class="row">
          <div class="col-md-6 col-md-offset-3 text-center">
            <input type="submit" name="registrar" id="register-submit" class="btn btn-primary btn-lg" tabindex="4" value="Enviar" {{$desativa_registro}}>
          </div>
        </div>
      </div>
    </fieldset>
  </form>
</div>