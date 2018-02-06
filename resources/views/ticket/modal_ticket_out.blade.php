<div id="modal_ticket_out" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Cobrar</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body" style="min-height: 130px;" >
                <div class="form-horizontal">
                    {{ csrf_field() }}

                    <div class="form-group{{ $errors->has('plate') ? ' has-error' : '' }}">
                        <textarea id="ticket_id_2" rows="2" cols="18" autofocus>
                        </textarea>
                    </div>
                    <div class="form-group{{ $errors->has('plate') ? ' has-error' : '' }}">
                        <input id="ticket_id" type="text" placeholder="ticket">
                        <input id="ticket_id_2" type="number" placeholder="ticket" autofocus>
                    </div>
                    <div class="form-group ">
                        <button id="b_pagar" type="button" onclick="pagar()" class="btn btn-primary full-width">
                            cobrar
                        </button>
                    </div>
                </div>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
