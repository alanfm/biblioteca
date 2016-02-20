<?php
include 'template/header.php';
include 'template/menu.php';
?>
<div class="page-header">
  <h1>Livros Cadastrados</h1>
</div>
<div class="row">
  <div class="col-md-6">
    <p><button class="btn btn-primary btn-lg btn-block btn-add" data-toggle="modal" data-target="#myModal">Novo Livro</button></p>
    <div class="panel panel-default">
      <div class="panel-heading">Ultimos Livros Cadastrados</div>
      <table class="table table-hover">
        <thead>
          <tr>
            <th>#</th>
            <th>Titulo</th>
            <th>Emprestado</th>
            <th>Opções</th>
          </tr>
        </thead>
        <tbody class="livro-table-list"></tbody>
      </table>
    </div>
  </div>
  <div class="col-md-6">
    <form action="livro/search" method="POST" id="search">
      <div class="row">
        <div class="col-md-3">
          <select class="form-control" name='livro_filter'>
            <option value="livro_titulo">Titulo</option>
            <option value="livro_codigo">Código</option>
          </select>
        </div>         
        <div class="col-md-9">
          <div class="input-group">
            <input type="text" name="livro_search" class="form-control" placeholder="Digite a sua pesquisa...">
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
            <th>Titulo</th>
            <th>Emprestado</th>
            <th>Opções</th>
          </tr>
        </thead>
        <tbody class="livro-table-search"></tbody>
      </table>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Cadastro de Livros</h4>
      </div>
      <div class="modal-body">
        <form class="form-horizontal" method="POST" action="livro/add" id="add">
          <div class="form-group">
            <label for="codigo" class="col-sm-2 control-label">Código</label>
            <div class="col-sm-10">
              <input type="text" name="livro_codigo" class="form-control" id="codigo" placeholder="Código" required autofocus>
            </div>
          </div>
          <div class="form-group">
            <label for="titulo" class="col-sm-2 control-label">Titulo</label>
            <div class="col-sm-10">
              <input type="text" name="livro_titulo" class="form-control" id="titulo" placeholder="Título" required autofocus>
            </div>
          </div>
          <div class="form-group">
            <label for="edicao" class="col-sm-2 control-label">Edição</label>
            <div class="col-sm-10">
              <input type="number" name="livro_edicao" class="form-control" id="edicao" placeholder="Número da edição" required>
            </div>
          </div>
          <div class="form-group">
            <label for="resumo" class="col-sm-2 control-label">Resumo</label>
            <div class="col-sm-10">
              <textarea name="livro_resumo" placeholder="Resumo" class="form-control" id="resumo" required></textarea>
            </div>
          </div>
          <div class="form-group">
            <label for="publicacao" class="col-sm-2 control-label">Ano de Publição</label>
            <div class="col-sm-10">
              <input type="number" name="livro_publicacao" class="form-control" id="publicacao" placeholder="Ano de publicação" required>
            </div>
          </div>
          <div class="form-group">
            <label for="status" class="col-sm-2 control-label">Emprestado</label>
            <div class="col-sm-10">
              <select name="livro_status" class="form-control">
                <option value="1">Sim</option>
                <option value="0" selected>Não</option>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label for="categoria" class="col-sm-2 control-label">Categoria</label>
            <div class="col-sm-10">
              <select name="categoria_id" class="form-control livro_categoria"></select>
            </div>
          </div>
          <div class="form-group">
            <label for="tipo" class="col-sm-2 control-label">Tipo</label>
            <div class="col-sm-10">
              <select name="tipo_id" class="form-control livro_tipo"></select>
            </div>
          </div>
          <div class="form-group">
            <label for="editora" class="col-sm-2 control-label">Editora</label>
            <div class="col-sm-10">
              <select name="editora_id" class="form-control livro_editora"></select>
            </div>
          </div>
          <div class="form-group">
            <label for="autor" class="col-sm-2 control-label">Autor</label>
            <div class="col-sm-10">
              <select name="autor_id" class="form-control livro_autor"></select>
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
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Editar Livro</h4>
      </div>
      <div class="modal-body">
        <form class="form-horizontal" method="POST" action="livro/edit" id="edit">
          <div class="form-group">
            <label for="codigo" class="col-sm-2 control-label">Código</label>
            <div class="col-sm-10">
              <input type="text" name="livro_codigo" class="form-control livro_codigo" placeholder="Código" required>
            </div>
          </div>
          <div class="form-group">
            <label for="titulo" class="col-sm-2 control-label">Titulo</label>
            <div class="col-sm-10">
              <input type="text" name="livro_titulo" class="form-control livro_titulo" placeholder="Título" required>
            </div>
          </div>
          <div class="form-group">
            <label for="edicao" class="col-sm-2 control-label">Edição</label>
            <div class="col-sm-10">
              <input type="number" name="livro_edicao" class="form-control livro_edicao" placeholder="Número da edição" required>
            </div>
          </div>
          <div class="form-group">
            <label for="resumo" class="col-sm-2 control-label">Resumo</label>
            <div class="col-sm-10">
              <textarea name="livro_resumo" placeholder="Resumo" class="form-control livro_resumo" required></textarea>
            </div>
          </div>
          <div class="form-group">
            <label for="publicacao" class="col-sm-2 control-label">Ano de Publição</label>
            <div class="col-sm-10">
              <input type="number" name="livro_publicacao" class="form-control livro_publicacao" placeholder="Ano de publicação" required>
            </div>
          </div>
          <div class="form-group">
            <label for="status" class="col-sm-2 control-label">Emprestado</label>
            <div class="col-sm-10">
              <select name="livro_status" class="form-control livro_status">
              </select>
            </div>
          </div>
          <div class="form-group">
            <label for="categoria" class="col-sm-2 control-label">Categoria</label>
            <div class="col-sm-10">
              <select name="categoria_id" class="form-control livro_categoria_editar"></select>
            </div>
          </div>
          <div class="form-group">
            <label for="tipo" class="col-sm-2 control-label">Tipo</label>
            <div class="col-sm-10">
              <select name="tipo_id" class="form-control livro_tipo_editar"></select>
            </div>
          </div>
          <div class="form-group">
            <label for="editora" class="col-sm-2 control-label">Editora</label>
            <div class="col-sm-10">
              <select name="editora_id" class="form-control livro_editora_editar"></select>
            </div>
          </div>
          <div class="form-group">
            <label for="autor" class="col-sm-2 control-label">Autor</label>
            <div class="col-sm-10">
              <select name="autor_id" class="form-control livro_autor_editar"></select>
            </div>
          </div>
          <div class="modal-footer">
            <input type="hidden" name="livro_id" class="livro_id">
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


<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" id="modal-detalhes">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Detalhes</h4>
      </div>
      <div class="modal-body datalhes">
        <h4>Dados</h4>
        <div class="list-group">
          <span class="list-group-item">
            <h4 class="list-group-item-heading">Código</h4>
            <p class="list-group-item-text livro_codigo"></p>
          </span>
          <span class="list-group-item">
            <h4 class="list-group-item-heading">Titulo</h4>
            <p class="list-group-item-text livro_titulo"></p>
          </span>
          <span href="#" class="list-group-item">
            <h4 class="list-group-item-heading">Edição</h4>
            <p class="list-group-item-text livro_edicao"></p>
          </span>
          <span href="#" class="list-group-item">
            <h4 class="list-group-item-heading">Publicação</h4>
            <p class="list-group-item-text livro_publicacao"></p>
          </span>
          <span href="#" class="list-group-item">
            <h4 class="list-group-item-heading">Resumo</h4>
            <p class="list-group-item-text livro_resumo"></p>
          </span>
          <span href="#" class="list-group-item">
            <h4 class="list-group-item-heading">Emprestado</h4>
            <p class="list-group-item-text livro_status"></p>
          </span>
          <span href="#" class="list-group-item">
            <h4 class="list-group-item-heading">Categoria</h4>
            <p class="list-group-item-text livro_categoria"></p>
          </span>
          <span href="#" class="list-group-item">
            <h4 class="list-group-item-heading">Tipo</h4>
            <p class="list-group-item-text livro_tipo"></p>
          </span>
          <span class="list-group-item">
            <h4 class="list-group-item-heading">Editora</h4>
            <p class="list-group-item-text livro_editora"></p>
          </span>
          <span class="list-group-item">
            <h4 class="list-group-item-heading">Autor</h4>
            <p class="list-group-item-text livro_autor"></p>
          </span>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal" autofocus>Fechar</button>
      </div>
    </div>
  </div>
</div>


<script type="text/javascript" src="assets/js/livro.js"></script>
<?php include 'template/footer.php'; ?>