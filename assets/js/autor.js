$(document).ready(function(){
  getContentAutor();

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
      getContentAutor();
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
      item.push('<tr><td>' + v.autor_id + '</td><td>' + v.autor_nome + '</td><td>' + 
          '<a href="#" data-href="autor/get_autor/' + v.autor_id + '" data-toggle="modal" data-target="#modal-edite" class="btn btn-warning btn-xs" id="editar">Editar</a> ' +
          '<a href="#" data-href="autor/delete/' + v.autor_id + '" data-toggle="modal" data-target="#modal-delete" data-msg="Deseja realmente apagar esseregistro?" class="btn btn-danger btn-xs">Apagar</a>');
      });

      $('.autor-table-search').html(item.join(""));
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
      getContentAutor();
    });
  });

  $('#modal-edite').on('show.bs.modal', function(e) {
    $.getJSON($(e.relatedTarget).data('href'), function(data) {
      $('#edit').find('.autor_nome').attr({'value':data.autor_nome});
      $('#edit').find('.autor_id').attr({'value':data.autor_id});      
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
      getContentAutor();
    })
    .fail(function() {
      $('#modal-edite').modal('hide');
      $('#modal-msg').modal('show').find('.modal-msg-txt').html(data);
      getContentAutor();
    });
    
    $(this).trigger("reset");
    getContentAutor();
  });
});

function getContentAutor(){
  $.getJSON('autor/get', function(data) {
    var item = [];
    $.each(data, function(k, v){
      item.push('<tr><td>' + v.autor_id + '</td><td>' + v.autor_nome + '</td><td>' + 
          '<a href="#" data-href="autor/get_autor/' + v.autor_id + '" data-toggle="modal" data-target="#modal-edite" class="btn btn-warning btn-xs" id="editar">Editar</a> ' +
          '<a href="#" data-href="autor/delete/' + v.autor_id + '" data-toggle="modal" data-target="#modal-delete" data-msg="Deseja realmente apagar esseregistro?" class="btn btn-danger btn-xs">Apagar</a>');
    });

    $('.autor-table-list').html(item.join(""));
  });
}
