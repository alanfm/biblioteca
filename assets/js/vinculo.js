$(document).ready(function(){
  get_content_vinculo();

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
      get_content_vinculo();
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
      item.push('<tr><td>' + v.vinculo_id + '</td><td>' + v.vinculo_descricao + '</td><td>' + 
          '<a href="#" data-href="vinculo/get_by_id/' + v.vinculo_id + '" data-toggle="modal" data-target="#modal-edite" class="btn btn-warning btn-xs" id="editar">Editar</a> ' +
          '<a href="#" data-href="vinculo/delete/' + v.vinculo_id + '" data-toggle="modal" data-target="#modal-delete" data-msg="Deseja realmente apagar esseregistro?" class="btn btn-danger btn-xs">Apagar</a>');
      });

      $('.usuario-table-search').html(item.join(""));
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
      get_content_vinculo();
    });
  });

  $('#modal-edite').on('show.bs.modal', function(e) {
    $.getJSON($(e.relatedTarget).data('href'), function(data) {
      console.log(data);
      $('#edit').find('.vinculo_descricao').attr({'value':data.vinculo_descricao});
      $('#edit').find('.vinculo_id').attr({'value':data.vinculo_id});      
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
      get_content_vinculo();
    })
    .fail(function() {
      $('#modal-edite').modal('hide');
      $('#modal-msg').modal('show').find('.modal-msg-txt').html(data);
      get_content_vinculo();
    });
    
    $(this).trigger("reset");
    get_content_vinculo();
  });
});

function get_content_vinculo(){
  $.getJSON('vinculo/get', function(data) {
    var item = [];
    $.each(data, function(k, v){
      item.push('<tr><td>' + v.vinculo_id + '</td><td>' + v.vinculo_descricao + '</td><td>' + 
          '<a href="#" data-href="vinculo/get_by_id/' + v.vinculo_id + '" data-toggle="modal" data-target="#modal-edite" class="btn btn-warning btn-xs" id="editar">Editar</a> ' +
          '<a href="#" data-href="vinculo/delete/' + v.vinculo_id + '" data-toggle="modal" data-target="#modal-delete" data-msg="Deseja realmente apagar esseregistro?" class="btn btn-danger btn-xs">Apagar</a>');
    });

    $('.vinculo-table-list').html(item.join(""));
  });
}
