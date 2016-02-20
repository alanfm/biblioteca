<div class="list-group">
  <div class="list-group-item active">
    <h4 class="list-group-item-heading">Número do Emprestimo</h4>
    <h1 class="list-group-item-text"><?php echo $emprestimo_id;?></h1>
  </div>
  <div class="list-group-item">
    <h4 class="list-group-item-heading">Data de Inicio</h4>
    <p class="list-group-item-text"><?php echo date('d/m/Y', strtotime($emprestimo_data_inicio));?></p>
  </div>
  <div class="list-group-item">
    <h4 class="list-group-item-heading">Data de Entrega</h4>
    <p class="list-group-item-text"><?php echo date('d/m/Y', strtotime($emprestimo_data_fim));?></p>
  </div>
  <div class="list-group-item">
    <h4 class="list-group-item-heading">Nome da Pessoa</h4>
    <p class="list-group-item-text"><?php echo $pessoa_id,' - ',$pessoa_nome;?></p>
  </div>
  <div class="list-group-item">
    <h4 class="list-group-item-heading">Livros Emprestado</h4>
    <?php foreach($livro as $v):?>
    <p class="list-group-item-text"><?php echo $v['livro_codigo'], ' - ', $v['livro_titulo'];?></p>
    <?php endforeach;?>
  </div>
</div>