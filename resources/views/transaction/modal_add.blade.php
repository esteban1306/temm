<div id="modal_add_transaction" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Nuevo Gasto</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body" style="min-height: 130px;" >
                <div class="row">
                    <div class="form-group col-md-12">
                        <label for="fechas" class="control-label">Descripción</label>
                        <input id="descriptionGt" type="text" class="form-control">
                    </div>
                    <div class="form-group col-md-12">
                        <label for="nombre" class="control-label">precio</label>
                        <input id="precioGt" type="number" class="form-control validate[required]">
                    </div>
                    <div class="form-group col-md-12">
                        <label for="nombre" class="control-label">Tipo</label>
                        <select id="tipoGt" name="type" class="form-control">
                            <option value="3">Gasto</option>
                            <option value="2">Surtido</option>
                        </select>
                    </div>
                    <div class="form-group col-md-12 pt-3">
                        <button id="new_customer" class="btn btn-primary full-width waves-effect waves-light" onclick="crearGasto()"><strong>REGISTRAR</strong></button>
                    </div>
                </div>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
