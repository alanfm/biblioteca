<?php
include 'template/header.php';
include 'template/menu.php';
?>
<div class="page-header">
  <h1>Pessoas Cadastradas</h1>
</div>
<div class="row">
  <div class="col-md-6">
    <p><button class="btn btn-primary btn-lg btn-block btn-add" data-toggle="modal" data-target="#myModal">Nova Pessoa</button></p>
    <div class="panel panel-default">
      <div class="panel-heading">Ultimas Pessoas Cadastradas</div>
      <table class="table table-hover">
        <thead>
          <tr>
            <th>#</th>
            <th>Nome</th>
            <th>Status</th>
            <th>Opções</th>
          </tr>
        </thead>
        <tbody class="pessoa-table-list"></tbody>
      </table>
    </div>
  </div>
  <div class="col-md-6">
    <form action="pessoa/search" method="POST" id="search">
      <input type="hidden" name="pessoa_filter" value="pessoa_nome">
      <div class="row">
        <div class="col-md-3">
          <select class="form-control" name='pessoa_filter'>
            <option value="pessoa_nome">Nome</option>
            <option value="pesspa_pai">Nome do pai</option>
            <option value="pesspa_mae">Nome da mãe</option>
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
    <div class="panel panel-default panel-result">
      <div class="panel-heading">Resultado da busca</div>
      <table class="table table-hover">
        <thead>
          <tr>
            <th>#</th>
            <th>Nome</th>
            <th>Status</th>
            <th>Opções</th>
          </tr>
        </thead>
        <tbody class="pessoa-table-search"></tbody>
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
        <h4 class="modal-title" id="myModalLabel">Cadastro de Pessoas</h4>
      </div>
      <div class="modal-body">
        <form class="form-horizontal" method="POST" action="pessoa/add" id="add">
          <div class="form-group">
            <label for="nome" class="col-sm-2 control-label">Nome</label>
            <div class="col-sm-10">
              <input type="text" name="pessoa_nome" class="form-control" id="nome" placeholder="Nome" required autofocus>
            </div>
          </div>
          <div class="form-group">
            <label for="mae" class="col-sm-2 control-label">Nome da Mãe</label>
            <div class="col-sm-10">
              <input type="text" name="pessoa_mae" class="form-control" id="mae" placeholder="Nome da mae" required>
            </div>
          </div>
          <div class="form-group">
            <label for="pai" class="col-sm-2 control-label">Nome do Pai</label>
            <div class="col-sm-10">
              <input type="text" name="pessoa_pai" class="form-control" id="pai" placeholder="Nome do pai" required>
            </div>
          </div>
          <div class="form-group">
            <label for="data" class="col-sm-2 control-label">Data de Nascimento</label>
            <div class="col-sm-10">
              <input type="date" name="pessoa_data" class="form-control pessoa_data" placeholder="Data de Nascimento" required>
            </div>
          </div>
          <div class="form-group">
            <label for="rg" class="col-sm-2 control-label">R.G.</label>
            <div class="col-sm-10">
              <input type="text" name="pessoa_rg" class="form-control pessoa_rg" placeholder="Número da identidade">
            </div>
          </div>
          <div class="form-group">
            <label for="cpf" class="col-sm-2 control-label">C.P.F.</label>
            <div class="col-sm-10">
              <input type="text" name="pessoa_cpf" class="form-control pessoa_cpf" placeholder="Número do C.P.F.">
            </div>
          </div>
          <div class="form-group">
            <label for="telefone" class="col-sm-2 control-label">Telefone</label>
            <div class="col-sm-10">
              <input type="tel" name="pessoa_telefone" class="form-control pessoa_telefone" placeholder="Telefone de Contato">
            </div>
          </div>
          <div class="form-group">
            <label for="email" class="col-sm-2 control-label">E-mail</label>
            <div class="col-sm-10">
              <input type="email" name="pessoa_email" class="form-control pessoa_email" placeholder="E-mail">
            </div>
          </div>
          <div class="form-group">
            <label for="nome" class="col-sm-2 control-label">Status</label>
            <div class="col-sm-10">
              <select class="form-control" name="pessoa_status">
                <option value="1">Devendo</option>
                <option value="0">Em dias</option>
              </select>
            </div>
          </div>

          <div class="form-group">
            <label for="vinculo" class="col-sm-2 control-label">Vinculo</label>
            <div class="col-sm-10">
              <select class="form-control vinculo" name="vinculo_id">
              </select>
            </div>
          </div>

          <div class="form-group">
            <label for="serie" class="col-sm-2 control-label">Serie/Ano</label>
            <div class="col-sm-10">
              <select class="form-control serie" name="serie_id">
              </select>
            </div>
          </div>

          <div class="form-group">
            <label for="estado" class="col-sm-2 control-label">Estado</label>
            <div class="col-sm-10">
              <select class="form-control" name="estado_id" id="estado">
                <option>Selecione o estado</option>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label for="cidade" class="col-sm-2 control-label">Cidade</label>
            <div class="col-sm-10">
              <select class="form-control" name="cidade_id" id="cidade"></select>
            </div>
          </div>
          <div class="form-group">
            <label for="logradouro" class="col-sm-2 control-label">Logradouro</label>
            <div class="col-sm-10">
              <input type="text" name="endereco_logradouro" class="form-control" id="logradouro" placeholder="Logradouro" required>
            </div>
          </div>
          <div class="form-group">
            <label for="numero" class="col-sm-2 control-label">Número</label>
            <div class="col-sm-10">
              <input type="text" name="endereco_numero" class="form-control" id="numero" placeholder="Número" required>
            </div>
          </div>
          <div class="form-group">
            <label for="complemento" class="col-sm-2 control-label">Complemento</label>
            <div class="col-sm-10">
              <input type="text" name="endereco_complemento" class="form-control" id="complemento" placeholder="Complemento">
            </div>
          </div>
          <div class="form-group">
            <label for="cep" class="col-sm-2 control-label">C.E.P.</label>
            <div class="col-sm-10">
              <input type="text" name="endereco_cep" class="form-control pessoa_cep" placeholder="C. E. P. " required>
            </div>
          </div>
          <div class="form-group">
            <label for="bairro" class="col-sm-2 control-label">Bairro</label>
            <div class="col-sm-10">
              <input type="text" name="endereco_bairro" class="form-control" id="bairro" placeholder="Bairro" required>
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
  <div class="modal-dialog  modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Editar pessoa</h4>
      </div>
      <div class="modal-body">
        <form class="form-horizontal" method="POST" action="pessoa/edit" id="edit">
          <div class="form-group">
            <label for="nome" class="col-sm-2 control-label">Nome</label>
            <div class="col-sm-10">
              <input type="text" name="pessoa_nome" class="form-control pessoa_nome" placeholder="Nome" required autofocus>
            </div>
          </div>
          <div class="form-group">
            <label for="mae" class="col-sm-2 control-label">Nome do Mãe</label>
            <div class="col-sm-10">
              <input type="text" name="pessoa_mae" class="form-control pessoa_mae" placeholder="Nome da mãe" required>
            </div>
          </div>
          <div class="form-group">
            <label for="pai" class="col-sm-2 control-label">Nome do Pai</label>
            <div class="col-sm-10">
              <input type="text" name="pessoa_pai" class="form-control pessoa_pai" placeholder="Nome do pai" required>
            </div>
          </div>
          <div class="form-group">
            <label for="data" class="col-sm-2 control-label">Data de Nascimento</label>
            <div class="col-sm-10">
              <input type="date" name="pessoa_data" class="form-control pessoa_data" placeholder="Data de Nascimento" required>
            </div>
          </div>
          <div class="form-group">
            <label for="rg" class="col-sm-2 control-label">R.G.</label>
            <div class="col-sm-10">
              <input type="text" name="pessoa_rg" class="form-control pessoa_rg" placeholder="Número da identidade">
            </div>
          </div>
          <div class="form-group">
            <label for="cpf" class="col-sm-2 control-label">C.P.F.</label>
            <div class="col-sm-10">
              <input type="text" name="pessoa_cpf" class="form-control pessoa_cpf" placeholder="Número do C.P.F.">
            </div>
          </div>
          <div class="form-group">
            <label for="telefone" class="col-sm-2 control-label">Telefone</label>
            <div class="col-sm-10">
              <input type="tel" name="pessoa_telefone" class="form-control pessoa_telefone" placeholder="Telefone de Contato">
            </div>
          </div>
          <div class="form-group">
            <label for="email" class="col-sm-2 control-label">E-mail</label>
            <div class="col-sm-10">
              <input type="email" name="pessoa_email" class="form-control pessoa_email" placeholder="E-mail">
            </div>
          </div>
          <div class="form-group">
            <label for="status" class="col-sm-2 control-label">Status</label>
            <div class="col-sm-10">
              <select class="form-control pessoa_status" name="pessoa_status">
              </select>
            </div>
          </div>
          <div class="form-group">
            <label for="vinculo" class="col-sm-2 control-label">Vinculo</label>
            <div class="col-sm-10">
              <select class="form-control pessoa_vinculo" name="vinculo_id">
              </select>
            </div>
          </div>
          <div class="form-group">
            <label for="serie" class="col-sm-2 control-label">Serie</label>
            <div class="col-sm-10">
              <select class="form-control pessoa_serie" name="serie_id">
              </select>
            </div>
          </div>
          <div class="form-group">
            <label for="estado" class="col-sm-2 control-label">Estado</label>
            <div class="col-sm-10">
              <select class="form-control pessoa_estado" name="estado_id">
              </select>
            </div>
          </div>
          <div class="form-group">
            <label for="Cidade" class="col-sm-2 control-label">Cidade</label>
            <div class="col-sm-10">
              <select class="form-control pessoa_cidade" name="cidade_id">
              </select>
            </div>
          </div>
          <div class="form-group">
            <label for="logradouro" class="col-sm-2 control-label">Logradouro</label>
            <div class="col-sm-10">
              <input type="text" name="endereco_logradouro" class="form-control pessoa_logradouro" placeholder="Logradouro" required>
            </div>
          </div>
          <div class="form-group">
            <label for="numero" class="col-sm-2 control-label">Número</label>
            <div class="col-sm-10">
              <input type="text" name="endereco_numero" class="form-control pessoa_numero" placeholder="Número" required>
            </div>
          </div>
          <div class="form-group">
            <label for="complemento" class="col-sm-2 control-label">Complemento</label>
            <div class="col-sm-10">
              <input type="text" name="endereco_complemento" class="form-control pessoa_complemento" placeholder="Complemento">
            </div>
          </div>
          <div class="form-group">
            <label for="cep" class="col-sm-2 control-label">C.E.P.</label>
            <div class="col-sm-10">
              <input type="text" name="endereco_cep" class="form-control pessoa_cep" placeholder="C. E. P. " required>
            </div>
          </div>
          <div class="form-group">
            <label for="bairro" class="col-sm-2 control-label">Bairro</label>
            <div class="col-sm-10">
              <input type="text" name="endereco_bairro" class="form-control pessoa_bairro" placeholder="Bairro" required>
            </div>
          </div>
          <input type="hidden" name="endereco_id" class="pessoa_endereco_id">
          <input type="hidden" name="pessoa_id" class="pessoa_id">
          <div class="modal-footer">
            <input type="hidden" name="pessoa_id" class="pessoa_id">
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
        <button type="button" class="btn btn-default" data-dismiss="modal" autofocus>Fechar</button>
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
        <h4>Dados Pessoais</h4>
        <div class="list-group">
          <span class="list-group-item">
            <h4 class="list-group-item-heading">Nome</h4>
            <p class="list-group-item-text pessoa_nome"></p>
          </span>
          <span class="list-group-item">
            <h4 class="list-group-item-heading">Nome da mãe</h4>
            <p class="list-group-item-text pessoa_mae"></p>
          </span>
          <span href="#" class="list-group-item">
            <h4 class="list-group-item-heading">Nome do pai</h4>
            <p class="list-group-item-text pessoa_pai"></p>
          </span>
          <span href="#" class="list-group-item">
            <h4 class="list-group-item-heading">Data de Nascimento</h4>
            <p class="list-group-item-text pessoa_data"></p>
          </span>
          <span href="#" class="list-group-item">
            <h4 class="list-group-item-heading">R.G.</h4>
            <p class="list-group-item-text pessoa_rg"></p>
          </span>
          <span href="#" class="list-group-item">
            <h4 class="list-group-item-heading">C.P.F.</h4>
            <p class="list-group-item-text pessoa_cpf"></p>
          </span>
          <span href="#" class="list-group-item">
            <h4 class="list-group-item-heading">Telefone</h4>
            <p class="list-group-item-text pessoa_telefone"></p>
          </span>
          <span href="#" class="list-group-item">
            <h4 class="list-group-item-heading">E-mail</h4>
            <p class="list-group-item-text pessoa_email"></p>
          </span>
          <span class="list-group-item">
            <h4 class="list-group-item-heading">Status</h4>
            <p class="list-group-item-text pessoa_status"></p>
          </span>
        </div>
        <h4>Vinculo</h4>
        <div class="list-group">
          <span class="list-group-item">
            <h4 class="list-group-item-heading">Vinculo</h4>
            <p class="list-group-item-text pessoa_vinculo"></p>
          </span>
          <span class="list-group-item">
            <h4 class="list-group-item-heading">Serie</h4>
            <p class="list-group-item-text pessoa_serie"></p>
          </span>
        </div>
        <h4>Endereço</h4>
        <div class="list-group">
          <span class="list-group-item">
            <h4 class="list-group-item-heading">Logradouro</h4>
            <p class="list-group-item-text pessoa_logradouro"></p>
          </span>
          <span class="list-group-item">
            <h4 class="list-group-item-heading">Numero</h4>
            <p class="list-group-item-text pessoa_numero"></p>
          </span>
          <span class="list-group-item">
            <h4 class="list-group-item-heading">Complemento</h4>
            <p class="list-group-item-text pessoa_complemento"></p>
          </span>
          <span class="list-group-item">
            <h4 class="list-group-item-heading">C.E.P.</h4>
            <p class="list-group-item-text pessoa_cep"></p>
          </span>
          <span class="list-group-item">
            <h4 class="list-group-item-heading">Bairro</h4>
            <p class="list-group-item-text pessoa_bairro"></p>
          </span>
          <span class="list-group-item">
            <h4 class="list-group-item-heading">Cidade</h4>
            <p class="list-group-item-text pessoa_cidade"></p>
          </span>
          <span class="list-group-item">
            <h4 class="list-group-item-heading">Estado</h4>
            <p class="list-group-item-text pessoa_estado"></p>
          </span>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal" autofocus>Fechar</button>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript" src="assets/js/pessoa.js"></script>
<?php include 'template/footer.php'; ?>