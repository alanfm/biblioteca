$(document).ready(function(){
    get_emprestimo();
    $('#search-pessoa').on('submit', function(event){
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
                item.push('<tr><td>' + v.pessoa_id + '</td><td>' + v.pessoa_nome + '</td><td>' +
                    '<a href="#" data-msg="' + v.pessoa_id + '" data-toggle="modal" data-target="#modal-add" class="btn btn-success btn-xs emprestar">Selecionar</a>');
            });
            $('.table-search-pessoa').html(item.join(""));
        });
    });

    $('#search-livro').on('submit', function(event){
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
                item.push('<tr><td>' + v.livro_codigo + '</td><td>' + v.livro_titulo + '</td><td>' +
                    '<a href="#" data-href="emprestimo/add_livro" data-livro="' + v.livro_id + '" data-emprestimo="' + sessionStorage.getItem('emprestimo_id') + '" class="btn btn-success btn-xs livro-add">Adicionar</a>');
            });
            $('.table-search-livro').html(item.join(""));
        });
    });

    $('#search-emprestimo').on('submit', function(event){
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
                item.push('<tr><td>' + v.emprestimo_id + '</td><td>' + v.pessoa_nome + '</td><td>' + v.livro_titulo + '</td><td>' + (v.emprestimo_status==1?'Aberto':'Entregue') + '</td><td>' + (v.emprestimo_data_fim==1?'Sim':'Não') + '</td><td>' +
                    '<a href="#" data-href="emprestimo/emprestimo_close/' + v.emprestimo_id + '" data-toggle="modal" data-target="#modal-delete" data-msg="Deseja realmente encerrar esse emprestimo?" class="btn btn-success btn-xs' + (v.emprestimo_status==0?' disabled':'') + '">Receber</a> '+
                    '<a href="#" data-href="emprestimo/emprestimo_renew/' + v.emprestimo_id + '" data-toggle="modal" data-target="#modal-delete" data-msg="O emprestimo será renovado por mais 15 dias.<br>Deseja realmente renovar este emprestimo?" class="btn btn-info btn-xs">Renovar</a> ' +
                    '<a href="#" data-href="emprestimo/report/' + v.emprestimo_id + '" data-toggle="modal" data-target="#modal-report"  class="btn btn-default btn-xs">Detalhes</a></td></tr>');
            });

            $('.table-search-emprestimo').html(item.join(""));
        });
    });

    $(document).on('click', '.emprestar', function(event){
        event.preventDefault();

        var url = $(this).attr('data-msg');

        $('#myModal').modal('hide');
        $('#modal-add').modal('show');
        $('#modal-add').find('.pessoa_id').attr({'value': url});
    });

    $(document).on('click', '.livro-add', function(event){
        event.preventDefault();

        var url = $(this).attr('data-href');

        var livro = $(this).attr('data-livro');
        var emprestimo = $(this).attr('data-emprestimo');

        $.ajax({
            method:'POST',
            url:url,
            data: {livro_id:livro, emprestimo_id:emprestimo}
        })
        .done(function(data){
            get_livro_add(sessionStorage.getItem('emprestimo_id'));
        });
    });

    $(document).on('click', '.btn-report', function(event){
        event.preventDefault();
        $('#modal-add-livro').modal('hide');
        $('#modal-report').modal('show');
        $('#modal-report').find('.modal-body').load('emprestimo/report/'+sessionStorage.getItem('emprestimo_id'), function(){
            get_emprestimo();
        });
    });

    $('#emprestimo_add').on('submit', function(event){
        event.preventDefault();
        var url = $(this).attr('action');
        var data = $(this).serialize();

        $.ajax({
            method: 'POST',
            url: url,
            data: data
        })
        .done(function(data){
            sessionStorage.setItem('emprestimo_id', data.emprestimo_id);
            sessionStorage.setItem('msg', data.msg);
            $('#modal-add').modal('hide');
            $('#modal-add-livro').modal('show');
        })
    });

    $('#modal-delete').on('show.bs.modal', function(e) {
        $('.modal-delete-msg').html($(e.relatedTarget).data('msg'));
        $(this).find('.btn-ok').click(function (){
            $('#modal-delete').modal('hide');
            $('#modal-msg').modal('show');
            $('#modal-msg').find('.modal-msg-txt').empty().load($(e.relatedTarget).data('href'), function(){                
                get_livro_add(sessionStorage.getItem('emprestimo_id'));
                $('.table-search-emprestimo').empty();
                get_emprestimo();
            });
        });
    });

    $('#modal-report').on('show.bs.modal', function(e) {
        $(this).find('.modal-body').load($(e.relatedTarget).data('href'));
    });
});

function get_livro_add(id)
{
    $.getJSON('emprestimo/get_livro/' + id, function(data) {
    var item = [];
    $.each(data, function(k, v){
        item.push('<tr><td>' + v.livro_codigo + '</td><td>' + v.livro_titulo + '</td><td>' +
          '<a href="#" data-href="emprestimo/delete_lista_livro/' + v.lista_livro_id + '" data-toggle="modal" data-target="#modal-delete" data-msg="Deseja realmente apagar este registro?" class="btn btn-danger btn-xs">Apagar</a></td></tr>');
    });

    $('.table-livro-add').html(item.join(""));
  });
}

function get_emprestimo()
{
    $.getJSON('emprestimo/get_emprestimos', function(data){
        var item = [];
        $.each(data,function(k, v){
            item.push('<tr><td>' + v.emprestimo_id + '</td><td>' + v.pessoa_nome + '</td><td>' + v.livro_titulo + '</td><td>' + (v.emprestimo_status==1?'Aberto':'Entregue') + '</td><td>' + (v.emprestimo_data_fim==1?'Sim':'Não') + '</td><td>' +
                '<div class="dropdown"><a id="dLabel" data-target="#" href="#" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" class="btn btn-default btn-xs">Opções <span class="caret"></span></a><ul class="dropdown-menu" aria-labelledby="dLabel">' +
                (v.emprestimo_status==0? '':'<li><a href="#" data-href="emprestimo/emprestimo_close/' + v.emprestimo_id + '" data-toggle="modal" data-target="#modal-delete" data-msg="Deseja realmente encerrar esse emprestimo?">Receber</a></li>') +
                (v.emprestimo_data_fim==0?'': '<li><a href="#" data-href="emprestimo/emprestimo_renew/' + v.emprestimo_id + '" data-toggle="modal" data-target="#modal-delete" data-msg="O emprestimo será renovado por mais 15 dias.<br>Deseja realmente renovar este emprestimo?">Renovar</a></li>') +
                '<li><a href="#" data-href="emprestimo/report/' + v.emprestimo_id + '" data-toggle="modal" data-target="#modal-report">Detalhes</a></li>'+
                '<li><a href="#" data-href="emprestimo/delete/' + v.emprestimo_id + '" data-toggle="modal" data-target="#modal-delete" data-msg="Deseja realmente cancelar esse emprestimo?">Cancelar</a></li></ul></div></td></tr>');
        });
        $('.table-list-emprestimo').empty().html(item.join(""));
    });
}

function get_report(url)
{
    $('#modal-report').modal('show');
    $('#modal-report').find('.modal-body').load(url);
}