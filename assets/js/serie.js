$(document).ready(function(){
  getContentSerie();

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
      getContentSerie();
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
      item.push('<tr><td>' + v.serie_id + '</td><td>' + v.serie_ano + 'º</td><td>' + v.serie_turma + '</td><td>' + v.serie_turno + '</td><td>' +
          '<a href="#" data-href="serie/get_serie/' + v.serie_id + '" data-toggle="modal" data-target="#modal-edite" class="btn btn-warning btn-xs" id="editar">Editar</a> ' +
          '<a href="#" data-href="serie/delete/' + v.serie_id + '" data-toggle="modal" data-target="#modal-delete" data-msg="Deseja realmente apagar esseregistro?" class="btn btn-danger btn-xs">Apagar</a></td></tr>');
      });

      $('.serie-table-search').html(item.join(""));
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
      getContentSerie();
    });
  });

  $('#modal-edite').on('show.bs.modal', function(e) {
    $.getJSON($(e.relatedTarget).data('href'), function(data) {
      $('#edit').find('.serie_ano').attr({'value':data.serie_ano});
      $('#edit').find('.serie_turma').attr({'value':data.serie_turma});
      $('#edit').find('.serie_turno').html(get_turno(data.serie_turno));
      $('#edit').find('.serie_id').attr({'value':data.serie_id});      
    });
  });

  $('#edit').on('submit', function(event) {
    event.preventDefault();
    var url = $(this).attr('action');
    var data = $(this).serialize();
    var type = $(this).attr('method');

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
    getContentSerie();
  });
});

function getContentSerie(){
  $.getJSON('serie/get', function(data) {
    var item = [];
    $.each(data, function(k, v){
      item.push('<tr><td>' + v.serie_id + '</td><td>' + v.serie_ano + 'º</td><td>' + v.serie_turma + '</td><td>' + v.serie_turno + '</td><td>' +
          '<a href="#" data-href="serie/get_serie/' + v.serie_id + '" data-toggle="modal" data-target="#modal-edite" class="btn btn-warning btn-xs" id="editar">Editar</a> ' +
          '<a href="#" data-href="serie/delete/' + v.serie_id + '" data-toggle="modal" data-target="#modal-delete" data-msg="Deseja realmente apagar esseregistro?" class="btn btn-danger btn-xs">Apagar</a></td></tr>');
    });

    $('.serie-table-list').html(item.join(""));
  });
}

function get_turno(str) {
  var s = new Array();

  if (str == 'M') {
    s[0] = ' selected';
    s[1] = s[2] = '';
  } else if (str == 'T') {
    s[1] = ' selected';
    s[0] = s[2] = '';
  } else {
    s[2] = ' selected';
    s[1] = s[0] = '';
  }

    return '<option value="M"'+s[0]+'>Manhã</option><option value="T"'+s[1]+'>Tarde</option><option value="N"'+s[2]+'>Noite</option>';
}
