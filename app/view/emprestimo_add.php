<form class="form-horizontal" method="POST" action="emprestimo/emprestimo_add" id="emprestimo_add">
    <div class="form-group">
        <label for="init" class="col-sm-2 control-label">Data de Início</label>
        <div class="col-sm-10">
            <input type="date" name="emprestimo_data_inicio" value="<?php echo $date_init;?>" class="form-control emprestimo_data_inicio" equired>
        </div>
    </div>
    <div class="form-group">
        <label for="end" class="col-sm-2 control-label">Data de Entrega</label>
        <div class="col-sm-10">
            <input type="date" name="emprestimo_data_fim" value="<?php echo $date_end;?>"class="form-control emprestimo_data_fim" required autofocus>
        </div>
    </div>
    <div class="modal-footer">
        <input type="hidden" name="pessoa_id" value="<?php echo $pessoa_id ?>">
        <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
        <button type="submit" class="btn btn-primary">Salvar</button>
    </div>
</form>