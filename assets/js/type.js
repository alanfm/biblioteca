$(document).ready(function(){
  getContentTipo();

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
      getContentTipo();
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
      item.push('<tr><td>' + v.tipo_id + '</td><td>' + v.tipo_descricao + '</td><td>' + 
          '<a href="#" data-href="tipo/get_tipo/' + v.tipo_id + '" data-toggle="modal" data-target="#modal-edite" class="btn btn-warning btn-xs" id="editar">Editar</a> ' +
          '<a href="#" data-href="tipo/delete/' + v.tipo_id + '" data-toggle="modal" data-target="#modal-delete" data-msg="Deseja realmente apagar esseregistro?" class="btn btn-danger btn-xs">Apagar</a>');
      });

      $('.tipo-table-search').html(item.join(""));
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
      getContentTipo();
    });
  });

  $('#modal-edite').on('show.bs.modal', function(e) {
    $.getJSON($(e.relatedTarget).data('href'), function(data) {
      $('#edit').find('.tipo_descricao').attr({'value':data.tipo_descricao});
      $('#edit').find('.tipo_id').attr({'value':data.tipo_id});      
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
      getContenttipo();
    })
    .fail(function() {
      $('#modal-edite').modal('hide');
      $('#modal-msg').modal('show').find('.modal-msg-txt').html(data);
      getContentTipo();
    });
    
    $(this).trigger("reset");
    getContentTipo();
  });
});

function getContentTipo(){
  $.getJSON('tipo/get', function(data) {
    var item = [];
    $.each(data, function(k, v){
      item.push('<tr><td>' + v.tipo_id + '</td><td>' + v.tipo_descricao + '</td><td>' + 
          '<a href="#" data-href="tipo/get_tipo/' + v.tipo_id + '" data-toggle="modal" data-target="#modal-edite" class="btn btn-warning btn-xs" id="editar">Editar</a> ' +
          '<a href="#" data-href="tipo/delete/' + v.tipo_id + '" data-toggle="modal" data-target="#modal-delete" data-msg="Deseja realmente apagar esseregistro?" class="btn btn-danger btn-xs">Apagar</a>');
    });

    $('.tipo-table-list').html(item.join(""));
  });
}
