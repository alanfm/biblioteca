$(document).ready(function(){
  getContentUsuario();
  $('#cadastro').on('submit', function(event){
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
      $('.modal-msg').modal('show');
      $('.modal-msg-txt').empty().html(msg);
      getContentUsuario();
    });
    $(this).trigger("reset");
  });

  $('#buscar').on('submit', function(event){
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
      item.push('<tr><td>' + v.usuario_id + '</td><td>' + v.usuario_login + '</td><td>' + v.usuario_email + '</td><td>' + 
          '<a href="#" data-href="usuario/get_usuario/' + v.usuario_id + '" data-toggle="modal" data-target="#modal-edite" class="btn btn-warning btn-xs" id="editar">Editar</a> ' +
          '<a href="#" data-href="usuario/excluir/' + v.usuario_id + '" data-toggle="modal" data-target="#modal-delete" data-msg="Deseja realmente apagar esseregistro?" class="btn btn-danger btn-xs">Apagar</a>');
      });

      $('.usuario-table-search').html(item.join(""));
    })
    .fail(function(msg){
      alert(msg);
    })
  });

  $('#modal-delete').on('show.bs.modal', function(e) {
    $('.modal-delete-msg').html($(e.relatedTarget).data('msg'));
    //$(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
    $(this).find('.btn-ok').click(function (){
      $('#modal-delete').modal('hide');
      $('#modal-msg').modal('show');
      $('#modal-msg').find('.modal-msg-txt').empty().load($(e.relatedTarget).data('href'));
      getContentUsuario();
    });
  });

  $('#modal-edite').on('show.bs.modal', function(e) {
    $.getJSON($(e.relatedTarget).data('href'), function(data) {
      $('#edit').find('.usuario_login').attr({'value':data.usuario_login});
      $('#edit').find('.usuario_email').attr({'value':data.usuario_email});
      $('#edit').find('.usuario_id').attr({'value':data.usuario_id});      
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
      getContentUsuario();
    })
    .fail(function() {
      $('#modal-edite').modal('hide');
      $('#modal-msg').modal('show').find('.modal-msg-txt').html(data);
      getContentUsuario();
    });
    
    $(this).trigger("reset");
  });
});

function getContentUsuario(){
  $.getJSON('usuario/listar', function(data) {
    var item = [];
    $.each(data, function(k, v){
      item.push('<tr><td>' + v.usuario_id + '</td><td>' + v.usuario_login + '</td><td>' + v.usuario_email + '</td><td>' + 
          '<a href="#" data-href="usuario/get_usuario/' + v.usuario_id + '" data-toggle="modal" data-target="#modal-edite" class="btn btn-warning btn-xs" id="editar">Editar</a> ' +
          '<a href="#" data-href="usuario/excluir/' + v.usuario_id + '" data-toggle="modal" data-target="#modal-delete" data-msg="Deseja realmente apagar esseregistro?" class="btn btn-danger btn-xs">Apagar</a>');
    });

    $('.usuario-table-list').html(item.join(""));
  });
}
