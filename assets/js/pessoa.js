$(document).ready(function(){
  get_content_pessoa();

  $('.btn-add').on('click', function() {    
    get_estado();
    get_vinculo();
    get_serie();
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
      get_content_pessoa();
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
        item.push('<tr><td>' + v.pessoa_id + '</td><td>' + v.pessoa_nome + '</td><td>' + (parseInt(v.pessoa_status) == 0? 'Em dias': 'Devendo') + '</td><td>' +
            '<a href="#" data-href="pessoa/get_pessoa/' + v.pessoa_id + '" data-toggle="modal" data-target="#modal-edite" class="btn btn-warning btn-xs" id="editar">Editar</a> ' +
            '<a href="#" data-href="pessoa/delete/' + v.pessoa_id + '" data-toggle="modal" data-target="#modal-delete" data-msg="Deseja realmente apagar esseregistro?" class="btn btn-danger btn-xs">Apagar</a>');
      });

      $('.pessoa-table-search').html(item.join(""));
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
      get_content_pessoa();
    });
  });

  $('#modal-edite').on('show.bs.modal', function(e) {
    $.getJSON($(e.relatedTarget).data('href'), function(data) {
      $('#edit').find('.pessoa_nome').attr({'value':data.pessoa_nome});
      $('#edit').find('.pessoa_pai').attr({'value':data.pessoa_pai});
      $('#edit').find('.pessoa_mae').attr({'value':data.pessoa_mae});
      $('#edit').find('.pessoa_data').attr({'value':data.pessoa_data});
      $('#edit').find('.pessoa_rg').attr({'value':data.pessoa_rg});
      $('#edit').find('.pessoa_cpf').attr({'value':data.pessoa_cpf});
      $('#edit').find('.pessoa_telefone').attr({'value':data.pessoa_telefone});
      $('#edit').find('.pessoa_email').attr({'value':data.pessoa_email});
      $('#edit').find('.pessoa_status').html(get_status(data.pessoa_status));
      get_vinculo_edit(data.vinculo_id);
      get_serie_edit(data.serie_id);
      get_estado_edit(data.estado_id);
      get_cidade_edit(data.cidade_id);
      $('#edit').find('.pessoa_logradouro').attr({'value':data.endereco_logradouro});
      $('#edit').find('.pessoa_numero').attr({'value':data.endereco_numero});
      $('#edit').find('.pessoa_complemento').attr({'value':data.endereco_complemento});
      $('#edit').find('.pessoa_cep').attr({'value':data.endereco_cep});
      $('#edit').find('.pessoa_bairro').attr({'value':data.endereco_bairro});
      $('#edit').find('.pessoa_id').attr({'value':data.pessoa_id});
      $('#edit').find('.pessoa_endereco_id').attr({'value':data.endereco_id});
    });
  });

  $('#modal-detalhes').on('show.bs.modal', function(e) {
    $.getJSON($(e.relatedTarget).data('href'), function(data) {
      var dnas = data.pessoa_data.split('-');
      $('.pessoa_nome').html(data.pessoa_nome);
      $('.pessoa_mae').html(data.pessoa_mae);
      $('.pessoa_pai').html(data.pessoa_pai);
      $('.pessoa_data').html(dnas.reverse().join('/'));
      $('.pessoa_rg').html(data.pessoa_rg);
      $('.pessoa_cpf').html(data.pessoa_cpf);
      $('.pessoa_telefone').html(data.pessoa_telefone);
      $('.pessoa_email').html(data.pessoa_email);
      $('.pessoa_status').html((data.pessoa_status == 0? 'Em dias': 'Devendo'));
      $('.pessoa_vinculo').html(data.vinculo_descricao);
      $('.pessoa_serie').html(data.serie_ano + 'º ' + data.serie_turma + ' ' + get_turno(data.serie_turno));
      $('.pessoa_logradouro').html(data.endereco_logradouro);
      $('.pessoa_numero').html(data.endereco_numero);
      $('.pessoa_complemento').html((data.endereco_complemento == ''? '&nbsp; ':data.endereco_complemento));
      $('.pessoa_cep').html(data.endereco_cep);
      $('.pessoa_bairro').html(data.endereco_bairro);
      $('.pessoa_cidade').html(data.cidade_nome);
      $('.pessoa_estado').html(data.estado_nome);
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
      get_content_pessoa();
    })
    .fail(function() {
      $('#modal-edite').modal('hide');
      $('#modal-msg').modal('show').find('.modal-msg-txt').html(data);
      get_content_pessoa();
    });
    
    $(this).trigger("reset");
    get_content_pessoa();
  });

  $('#estado').change(function(){
    get_cidade_by_estado($(this).find('option:selected').val());
  });
  $('.pessoa_estado').change(function(){
    get_cidade_by_estado_edit($(this).find('option:selected').val());
  });
});

function get_content_pessoa() {
  $.getJSON('pessoa/get', function(data) {
    var item = [];
    $.each(data, function(k, v){
      item.push('<tr><td>' + v.pessoa_id + '</td><td>' + v.pessoa_nome + '</td><td>' + (parseInt(v.pessoa_status) == 0? 'Em dias': 'Devendo') + '</td><td>' +
          '<a href="#" data-href="pessoa/get_pessoa/' + v.pessoa_id + '" data-toggle="modal" data-target="#modal-edite" class="btn btn-warning btn-xs" id="editar">Editar</a> ' +
          '<a href="#" data-href="pessoa/delete/' + v.pessoa_id + '" data-toggle="modal" data-target="#modal-delete" data-msg="Deseja realmente apagar esseregistro?" class="btn btn-danger btn-xs">Apagar</a> ' +
          '<a href="#" data-href="pessoa/detalhes/' + v.pessoa_id + '" data-toggle="modal" data-target="#modal-detalhes" class="btn btn-info btn-xs" id="detalhes">Detalhes</a>');
    });

    $('.pessoa-table-list').html(item.join(""));
  });
}

// Listar cidade por estados
function get_cidade_by_estado(id) {
  $.getJSON('cidade/get_cidade_by_estado/' + id, function(data) {
    var item = [];

    $.each(data,function(k, v) {
      item.push('<option value=' + v.cidade_id + '>' + v.cidade_nome + '</option>');
    });

    $('#cidade').empty().html(item.join(''));
  });
}

// Listar cidade por estados
function get_cidade_by_estado_edit(id) {
  $.getJSON('cidade/get_cidade_by_estado/' + id, function(data) {
    var item = [];

    $.each(data,function(k, v) {
      item.push('<option value=' + v.cidade_id + '>' + v.cidade_nome + '</option>');
    });

    $('.pessoa_cidade').empty().html(item.join(''));
  });
}
// Listar estados
function get_estado() {
  $.getJSON('estado/get_estado', function(data) {
    var item = [];

    $.each(data, function(k, v) {
      item.push('<option value=' + v.estado_id + '>' + v.estado_nome + '</option>');
    });

    $('#estado').html(item.join());
  });
}

// Listar estados
function get_estado_edit(id) {
  $.getJSON('estado/get_estado', function(data) {
    var item = [];

    $.each(data, function(k, v) {
      item.push('<option value="' + v.estado_id + '"' + (v.estado_id == id? ' selected': '') +'>' + v.estado_nome + '</option>');
    });

    $('.pessoa_estado').html(item.join());
  });
}

// Listar Vinculos
function get_vinculo() {
  $.getJSON('vinculo/get', function(data) {
    var item = [];
    $.each(data, function(k, v) {
      item.push('<option value="' + v.vinculo_id + '">' + v.vinculo_descricao + '</option>');
    });
    $('.vinculo').html(item.join());
  });
}

// Listar Vinculos
function get_vinculo_edit(id) {
  $.getJSON('vinculo/get', function(data) {
    itens = [];
    $.each(data, function(k, v) {
      itens.push('<option value="' + v.vinculo_id + '"' + (v.vinculo_id == id? ' selected': '') + '>' + v.vinculo_descricao + '</option>');
    });
    $('.pessoa_vinculo').html(itens.join());
  });
}

// Listar serie
function get_serie() {
  $.getJSON('serie/get', function(data) {
    var item = [];

    $.each(data, function(k, v) {
      item.push('<option value="' + v.serie_id + '">' + v.serie_ano + "º - " + v.serie_turma + " - " + v.serie_turno + '</option>');
    });
    $('.serie').html(item.join());
  });
}

// Listar serie
function get_serie_edit(id) {
  $.getJSON('serie/get', function(data) {
    var item = [];

    $.each(data, function(k, v) {
      item.push('<option value="' + v.serie_id + '"' + (v.serie_id == id? ' selected': '') +  '>' + v.serie_ano + "º - " + v.serie_turma + " - " + v.serie_turno + '</option>');
    });
    $('.pessoa_serie').html(item.join());
  });
}

function get_status(status) {
  var selected = new Array();
  if (status == 0) {
    selected[0] = ' selected';
    selected[1] = '';
  } else {
    selected[1] = ' selected';
    selected[0] = '';
  }

  return '<option value=0'+selected[0]+'>Em dias</option><option value=1'+selected[1]+'>Devendo</option>';
}

function get_endereco(id) {
  $.getJSON('pessoa/get_endereco/' + id, function(data) {
    $('#edit').find('endereco_logradouro').attr({'value': data.endereco_logradouro});
    $('#edit').find('endereco_numero').attr({'value': data.endereco_numero});
    $('#edit').find('endereco_complemento').attr({'value': data.endereco_complemento});
    $('#edit').find('endereco_bairro').attr({'value': data.endereco_bairro});
  });
}

function get_cidade_edit(id) {
  $.getJSON('pessoa/get_cidade', function(data) {
    var item = [];
    $.each(data, function(k, v) {
      item.push('<option value="' + v.cidade_id + '"' + (v.cidade_id == id? ' selected': '') + '>' + v.cidade_nome + '</option>');
    });
    $('.pessoa_cidade').html(item.join());
  });  
}

function get_turno(str) {
  switch(str) {
    case 'm':
      return 'Manhã';
    case 't':
      return 'Tarde';
    case 'n':
      return 'Noite';
  }
}