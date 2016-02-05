<?php
include 'template/header.php';
include 'template/menu.php';
?>
<div class="page-header">
  <h1>Tipos Cadastrados</h1>
</div>
<div class="row">
  <div class="col-md-6">
    <p><button class="btn btn-primary btn-lg btn-block" data-toggle="modal" data-target="#myModal">Novo Tipo</button></p>
    <div class="panel panel-default">
      <div class="panel-heading">Ultimos Tipos Cadastrados</div>
      <table class="table table-hover">
        <thead>
          <tr>
            <th>#</th>
            <th>Descrição</th>
            <th>Opções</th>
          </tr>
        </thead>
        <tbody class="tipo-table-list"></tbody>
      </table>
    </div>
  </div>
  <div class="col-md-6">
    <form action="tipo/search" method="POST" id="search">
      <input type="hidden" name="tipo_filter" value="tipo_descricao">
      <div class="row">     
        <div class="col-md-12">
          <div class="input-group">
            <input type="text" name="tipo_search" class="form-control" placeholder="Digite a sua pesquisa...">
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
            <th>Descrição</th>
            <th>Opções</th>
          </tr>
        </thead>
        <tbody class="tipo-table-search"></tbody>
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
        <h4 class="modal-title" id="myModalLabel">Cadastro de Tipos</h4>
      </div>
      <div class="modal-body">
        <form class="form-horizontal" method="POST" action="tipo/add" id="add">
          <div class="form-group">
            <label for="descricao" class="col-sm-2 control-label">Descrição</label>
            <div class="col-sm-10">
              <input type="text" name="tipo_descricao" class="form-control" id="descricao" placeholder="Descrição" required autofocus>
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
        <h4 class="modal-title" id="myModalLabel">Editar Tipo</h4>
      </div>
      <div class="modal-body">
        <form class="form-horizontal" method="POST" action="tipo/edit" id="edit">
          <div class="form-group">
            <label for="descricao" class="col-sm-2 control-label">Descrição</label>
            <div class="col-sm-10">
              <input type="text" name="tipo_descricao" class="form-control tipo_descricao" placeholder="Descrição" required>
            </div>
          </div>
          <div class="modal-footer">
            <input type="hidden" name="tipo_id" class="tipo_id">
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
<script type="text/javascript" src="assets/js/type.js"></script>
<?php include 'template/footer.php'; ?>