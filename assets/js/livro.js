$(document).ready(function(){
  get_content_livro();

  $('.btn-add').on('click', function() {   
    get_categoria(false, '.livro_categoria');
    get_tipo(false, '.livro_tipo');
    get_editora(false, '.livro_editora');
    get_autor(false, '.livro_autor');
  });

  $('#add').on('submit', function(event){
    event.preventDefault();

    var url = $(this).attr('action');
    var data = $(this).serialize();
    $.ajax({
      method: 'POST',
      url: url,
      data: data
    })
    .done(function(msg){
      $('#myModal').modal('hide');
      $('.modal-msg').modal('show').find('.modal-msg-txt').empty().html(msg);
      get_content_livro();
    });
    $(this).trigger("reset");
  });

  $('#search').on('submit', function(event){
    event.preventDefault();

    var url = $(this).attr('action');
    var data = $(this).serialize();

    $.ajax({
      method: 'POST',
      url: url,
      data: data
    })
    .done(function(data){
      var item = [];
      $.each(data, function(k, v){
      item.push('<tr><td>' + v.livro_codigo + '</td><td>' + v.livro_titulo + '</td><td>' + (v.livro_status == 1? 'Sim': 'Não') + '</td><td>' + 
          '<a href="#" data-href="livro/get_livro/' + v.livro_id + '" data-toggle="modal" data-target="#modal-edite" class="btn btn-warning btn-xs" id="editar">Editar</a> ' +
          '<a href="#" data-href="livro/delete/' + v.livro_id + '" data-toggle="modal" data-target="#modal-delete" data-msg="Deseja realmente apagar esseregistro?" class="btn btn-danger btn-xs">Apagar</a> ' +
          '<a href="#" data-href="livro/detalhes/' + v.livro_id + '" data-toggle="modal" data-target="#modal-detalhes" class="btn btn-info btn-xs" id="detalhes">Detalhes</a>');
      });

      $('.livro-table-search').html(item.join(""));
    })
    .fail(function(msg){
      alert(msg);
    })
  });

  $('#modal-delete').on('show.bs.modal', function(e) {
    $('.modal-delete-msg').html($(e.relatedTarget).data('msg'));
    $(this).find('.btn-ok').click(function (){
      $('#modal-delete').modal('hide');
      $('#modal-msg').modal('show');
      $('#modal-msg').find('.modal-msg-txt').empty().load($(e.relatedTarget).data('href'));
      get_content_livro();
    });
  });

  $('#modal-edite').on('show.bs.modal', function(e) {
    $.getJSON($(e.relatedTarget).data('href'), function(data) {
      $('.livro_id').attr({'value':data.livro_id});
      $('.livro_codigo').attr({'value':data.livro_codigo});
      $('.livro_titulo').attr({'value':data.livro_titulo});
      $('.livro_edicao').attr({'value':data.livro_edicao});
      $('.livro_resumo').html(data.livro_titulo);
      $('.livro_publicacao').attr({'value':data.livro_publicacao});
      $('.livro_status').html(get_status(data.livro_status));
      get_categoria(data.categoria_id, '.livro_categoria_editar');
      get_tipo(data.tipo_id, '.livro_tipo_editar');
      get_editora(data.editora_id, '.livro_editora_editar');
      get_autor(data.autor_id, '.livro_autor_editar');
    });
  });

  $('#modal-detalhes').on('show.bs.modal', function(e) {
    $.getJSON($(e.relatedTarget).data('href'), function(data) {
      $('.livro_codigo').html(data.livro_codigo);
      $('.livro_titulo').html(data.livro_titulo);
      $('.livro_edicao').html(data.livro_edicao);
      $('.livro_publicacao').html(data.livro_publicacao);
      $('.livro_status').html(data.livro_status == 1? 'Sim': 'Não');
      $('.livro_categoria').html(data.categoria_descricao);
      $('.livro_tipo').html(data.tipo_descricao);
      $('.livro_editora').html(data.editora_nome);
      $('.livro_autor').html(data.autor_nome);
    });
  });

  $('#edit').on('submit', function(event) {
    event.preventDefault();
    var url = $(this).attr('action');
    var data = $(this).serialize();

    $.ajax({
      url: url,
      type: 'POST',
      data: data
    })
    .done(function(data) {
      $('#modal-edite').modal('hide');
      $('#modal-msg').modal('show').find('.modal-msg-txt').html(data);
    })
    .fail(function() {
      $('#modal-edite').modal('hide');
      $('#modal-msg').modal('show').find('.modal-msg-txt').html(data);
    });
    
    $(this).trigger("reset");
    get_content_livro();
    $('.livro-table-search').empty();
  });
});

function get_content_livro(){
  $.getJSON('livro/get', function(data) {
    var item = [];
    $.each(data, function(k, v){
      item.push('<tr><td>' + v.livro_codigo + '</td><td>' + v.livro_titulo + '</td><td>' + (v.livro_status == 1? 'Sim': 'Não') + '</td><td>' + 
          '<a href="#" data-href="livro/get_livro/' + v.livro_id + '" data-toggle="modal" data-target="#modal-edite" class="btn btn-warning btn-xs" id="editar">Editar</a> ' +
          '<a href="#" data-href="livro/delete/' + v.livro_id + '" data-toggle="modal" data-target="#modal-delete" data-msg="Deseja realmente apagar esseregistro?" class="btn btn-danger btn-xs">Apagar</a> ' +
          '<a href="#" data-href="livro/detalhes/' + v.livro_id + '" data-toggle="modal" data-target="#modal-detalhes" class="btn btn-info btn-xs" id="detalhes">Detalhes</a>');
    });

    $('.livro-table-list').html(item.join(""));
  });
}

function get_categoria(id, html_class)
{
  $.getJSON('categoria/get', function(data) {
    var item = [];
    $.each(data, function(k,v) {
      item.push('<option value="' + v.categoria_id + '" ' + (id != false? (id == v.categoria_id? ' selected': ''): '') +'>' + v.categoria_descricao + '</option>');
    });
    $(html_class).html(item.join());
  });
}


function get_tipo(id, html_class)
{
  $.getJSON('tipo/get', function(data) {
    var item = [];
    $.each(data, function(k,v) {
      item.push('<option value="' + v.tipo_id + '" ' + (id != false? (id == v.tipo_id? ' selected': ''): '') +'>' + v.tipo_descricao + '</option>');
    });
    $(html_class).html(item.join());
  });
}


function get_editora(id, html_class)
{
  $.getJSON('editora/get', function(data) {
    var item = [];
    $.each(data, function(k,v) {
      item.push('<option value="' + v.editora_id + '" ' + (id != false? (id == v.editora_id? ' selected': ''): '') +'>' + v.editora_nome + '</option>');
    });
    $(html_class).html(item.join());
  });
}


function get_autor(id, html_class)
{
  $.getJSON('autor/get', function(data) {
    var item = [];
    $.each(data, function(k,v) {
      item.push('<option value="' + v.autor_id + '" ' + (id != false? (id == v.autor_id? ' selected': ''): '') +'>' + v.autor_nome + '</option>');
    });
    $(html_class).html(item.join());
  });
}

function get_status(id){
  str = '<option value=0' + (id == 0? ' selected': '') + '>Não</option>' +
        '<option value=1' + (id == 1? ' selected': '') + '>Sim</option>';

  return str;
}
