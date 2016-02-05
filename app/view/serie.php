<?php
include 'template/header.php';
include 'template/menu.php';
?>
<div class="page-header">
  <h1>Serie/Ano Cadastrados</h1>
</div>
<div class="row">
  <div class="col-md-6">
    <p><button class="btn btn-primary btn-lg btn-block" data-toggle="modal" data-target="#myModal">Nova Serie/Ano</button></p>
    <div class="panel panel-default">
      <div class="panel-heading">Ultimas Serie/Ano Cadastradas</div>
      <table class="table table-hover">
        <thead>
          <tr>
            <th>#</th>
            <th>Ano</th>
            <th>Turma</th>
            <th>Turno</th>
            <th>Opções</th>
          </tr>
        </thead>
        <tbody class="serie-table-list"></tbody>
      </table>
    </div>
  </div>
  <div class="col-md-6">
    <form action="serie/search" method="POST" id="search">
      <input type="hidden" name="serie_filter" value="serie_nome">
      <div class="row">
        <div class="col-md-3">
          <select class="form-control" name='serie_filter'>
            <option value="serie_ano">Ano</option>
            <option value="serie_turma">Turma</option>
            <option value="serie_turno">Turno</option>
          </select>
        </div>         
        <div class="col-md-9">
          <div class="input-group">
            <input type="text" name="serie_search" class="form-control" placeholder="Digite a sua pesquisa...">
            <span class="input-group-btn">
              <input class="btn btn-default" type="submit" value="Buscar">
            </span>
          </div><!-- /input-group -->
        </div>
      </div>
    </form>
    <div class="panel panel-default panel-result">
      <div class="panel-heading">Resultado da busca</div>
      <table class="table table-hover">
        <thead>
          <tr>
            <th>#</th>
            <th>Ano</th>
            <th>Turma</th>
            <th>Turno</th>
            <th>Opções</th>
          </tr>
        </thead>
        <tbody class="serie-table-search"></tbody>
      </table>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Cadastro de Serie/Ano</h4>
      </div>
      <div class="modal-body">
        <form class="form-horizontal" method="POST" action="serie/add" id="add">
          <div class="form-group">
            <label for="serie" class="col-sm-2 control-label">Serie/Ano</label>
            <div class="col-sm-10">
              <input type="number" name="serie_ano" class="form-control" id="serie" placeholder="Série/Ano" required autofocus>
            </div>
          </div>
          <div class="form-group">
            <label for="turma" class="col-sm-2 control-label">Turma</label>
            <div class="col-sm-10">
              <input type="text" name="serie_turma" class="form-control" id="turma" placeholder="Turma" required>
            </div>
          </div>
          <div class="form-group">
            <label for="turno" class="col-sm-2 control-label">Turno</label>
            <div class="col-sm-10">
              <select name="serie_turno" class="form-control turno">
                <option value="M">Manhã</option>
                <option value="T">Tarde</option>
                <option value="N">Noite</option>
              </select>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
            <button type="submit" class="btn btn-primary">Salvar</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" id="modal-delete">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Mensagem</h4>
      </div>
      <div class="modal-body modal-delete-msg"></div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
        <a class="btn btn-danger btn-ok">Confirmar</a>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" id="modal-edite">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Editar Serie/Ano</h4>
      </div>
      <div class="modal-body">
        <form class="form-horizontal" method="POST" action="serie/editar" id="edit">
          <div class="form-group">
            <label for="serie" class="col-sm-2 control-label">Serie/Ano</label>
            <div class="col-sm-10">
              <input type="number" name="serie_ano" class="form-control serie_ano" id="serie" placeholder="Série/Ano" required autofocus>
            </div>
          </div>
          <div class="form-group">
            <label for="turma" class="col-sm-2 control-label">Turma</label>
            <div class="col-sm-10">
              <input type="text" name="serie_turma" class="form-control serie_turma" id="turma" placeholder="Turma" required>
            </div>
          </div>
          <div class="form-group">
            <label for="turno" class="col-sm-2 control-label">Turno</label>
            <div class="col-sm-10">
              <select name="serie_turno" class="form-control serie_turno">
                <option value="M">Manhã</option>
                <option value="T">Tarde</option>
                <option value="N">Noite</option>
              </select>
            </div>
          </div>
          <div class="modal-footer">
            <input type="hidden" name="serie_id" class="serie_id">
            <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
            <button type="submit" class="btn btn-primary">Salvar</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<div class="modal fade modal-msg" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" id="modal-msg">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Mensagem</h4>
      </div>
      <div class="modal-body modal-msg-txt"></div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript" src="assets/js/serie.js"></script>
<?php include 'template/footer.php'; ?>