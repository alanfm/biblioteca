<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta name="generator" content="Bootply" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>Biblioteca - Login</title>
    <base href="<?php echo BASE_SITE;?>">
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <!--[if lt IE 9]>
      <script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
    <link href="assets/css/styles.css" rel="stylesheet">
  </head>
  <body>


<!-- Modal -->
<div class="modal show" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title text-center" id="myModalLabel">Login</h1>
        <p class="text-center">Sistema de Gerenciamento de Biblioteca</p>
      </div>
      <div class="modal-body">
        <div class="row">
          <form class="form-horizontal col-md-10 col-md-offset-1" method="POST" action="security/login" id="cadastro">
            <div class="form-group">
              <input type="text" name="usuario_login" class="form-control input-lg" placeholder="Login" required autofocus>
            </div>
            <div class="form-group">
              <input type="password" name="usuario_senha" class="form-control input-lg" placeholder="Senha" required>
            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-primary btn-lg btn-block">Entrar</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>



    
    <!--login modal
    <div id="loginModal" class="modal show" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
              <h1 class="text-center">Login</h1>
          </div>
          <div class="modal-body">
            <form class="form col-md-12" action="security/login" method="POST">
              <div class="form-group">
                <input type="text" name="usuario_login" class="form-control input-lg" placeholder="Login">
              </div>
              <div class="form-group">
                <input type="password" name="usuario_senha" class="form-control input-lg" placeholder="Senha">
              </div>          
              <div class="modal-footer">
                <button class="btn btn-primary btn-lg btn-block">Entrar</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    -->
    <script type="text/javascript" src="assets/js/jquery.min.js"></script>
    <script type="text/javascript">
    //<![CDATA[
    (window.jQuery)||document.write('<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"><\/script>');//]]>
    </script>
    <script src="assets/js/bootstrap.min.js"></script>
  </body>
</html>