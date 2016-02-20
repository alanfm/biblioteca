<?php
include 'template/header.php';
include 'template/menu.php';
?>
<div class="page-header">
  <h1>Livros Cadastrados</h1>
</div>
<div class="row">
  <div class="col-md-6">
    <p><button class="btn btn-primary btn-lg btn-block btn-add" data-toggle="modal" data-target="#myModal">Emprestar Livros</button></p>
    <div class="panel panel-default">
      <div class="panel-heading">Ultimos Emprestimos</div>
      <table class="table table-hover">
        <thead>
          <tr>
            <th>#</th>
            <th>Pessoa</th>
            <th>Livro</th>
            <th>Situação</th>
            <th>Vencido</th>
            <th>Opções</th>
          </tr>
        </thead>
        <tbody class="table-list-emprestimo"></tbody>
      </table>
    </div>
  </div>
  <div class="col-md-6">
    <form action="emprestimo/search" method="POST" id="search-emprestimo">
      <input type="hidden" name="emprestimo_filter" value="emprestimo_id">
      <div class="row">     
        <div class="col-md-12">
          <div class="input-group">
            <input type="text" name="emprestimo_search" class="form-control" placeholder="Digite o ID do emprestimo">
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
            <th>Pessoa</th>
            <th>Livro</th>
            <th>Situação</th>
            <th>Vencido</th>
            <th>Opções</th>
          </tr>
        </thead>
        <tbody class="table-search-emprestimo"></tbody>
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
        <h4 class="modal-title" id="myModalLabel">Emprestimo de Livros</h4>
      </div>
      <div class="modal-body emprestimo_add">
        <form class="form-horizontal" method="POST" action="pessoa/search" id="search-pessoa">
          <div class="row">
            <div class="col-md-3">
              <select class="form-control" name='pessoa_filter'>
                <option value="pessoa_nome">Nome</option>
                <option value="pessoa_id">Id</option>
              </select>
            </div>         
            <div class="col-md-9">
              <div class="input-group">
                <input type="text" name="pessoa_search" class="form-control" placeholder="Digite a sua pesquisa...">
                <span class="input-group-btn">
                  <input class="btn btn-default" type="submit" value="Buscar">
                </span>
              </div><!-- /input-group -->
            </div>
          </div>
        </form>        
        <table class="table table-hover">
          <thead>
            <tr>
              <th>#</th>
              <th>Nome</th>
              <th>Opções</th>
            </tr>
          </thead>
          <tbody class="table-search-pessoa"></tbody>
        </table>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" id="modal-add" >
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Emprestimo de Livros</h4>
      </div>
      <div class="modal-body emprestimo_add">
        <form class="form-horizontal" method="POST" action="emprestimo/emprestimo_add" id="emprestimo_add">
          <div class="form-group">
            <label for="init" class="col-sm-2 control-label">Data de Início</label>
            <div class="col-sm-10">
              <input type="date" name="emprestimo_data_inicio" value="<?php echo $date_init;?>" class="form-control emprestimo_data_inicio" equired>
            </div>
          </div>
          <div class="form-group">
            <label for="end" class="col-sm-2 control-label">Data de Entrega</label>
            <div class="col-sm-10">
              <input type="date" name="emprestimo_data_fim" value="<?php echo $date_end;?>"class="form-control emprestimo_data_fim" required autofocus>
            </div>
          </div>
          <div class="modal-footer">
            <input type="hidden" name="pessoa_id" class="pessoa_id" value="">
            <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
            <button type="submit" class="btn btn-primary">Salvar</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>


<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" id="modal-add-livro" >
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Adicionar Livros</h4>
      </div>
      <div class="modal-body emprestimo_add">
        <form class="form-horizontal" method="POST" action="livro/search" id="search-livro">
          <div class="row">
            <div class="col-md-3">
              <select class="form-control" name='livro_filter'>
                <option value="livro_codigo">Código</option>
                <option value="livro_titulo">Titulo</option>
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
        <h3>Resultado da Busca</h3>      
        <table class="table table-hover">
          <thead>
            <tr>
              <th>Código</th>
              <th>Título</th>
              <th>Opções</th>
            </tr>
          </thead>
          <tbody class="table-search-livro"></tbody>
        </table>
        <h3>Livros Adicionados</h3>
        <table class="table table-hover">
          <thead>
            <tr>
              <th>Código</th>
              <th>Título</th>
              <th>Opções</th>
            </tr>
          </thead>
          <tbody class="table-livro-add"></tbody>
        </table>
        <div class="modal-footer">
          <button type="button" class="btn btn-default btn-report">Avançar</button>
        </div>
      </div>
    </div>
  </div>
</div>


<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" id="modal-report">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Mensagem</h4>
      </div>
      <div class="modal-body"></div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
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
<script type="text/javascript" src="assets/js/emprestimo.js"></script>
<?php include 'template/footer.php'; ?>