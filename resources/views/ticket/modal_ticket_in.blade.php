<div id="modal_ticket_in" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Ingreso de vehiculo</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body" style="min-height: 130px;" >
                <form class="row" method="POST" action="{{ route('register') }}">
                    {{ csrf_field() }}
                    <div class="form-group col-md-12">
                        <label for="">Fecha y hora</label>
                        <input id="fecha" type="text" class="form-control" disabled>
                    </div>
                    <div class="form-group col-md-12{{ $errors->has('email') ? ' has-error' : '' }}">
                        <label for="plate" class="control-label">PLACA</label>

                        <div>
                            <input id="plate" type="plate" class="form-control" name="plate" value="{{ old('plate') }}" required autofocus>

                            @if ($errors->has('email'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="">Tipo</label>
                        <select name="type" class="form-control" id="">
                            <option value="1" selected >Carro</option>
                            <option value="2">Moto</option>
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="">Horario</label>
                        <select name="schedule" class="form-control" id="">
                            <option value="1" selected >Hora</option>
                            <option value="2">Dia</option>
                            <option value="3">Mes</option>
                        </select>
                    </div>
                    <div class="form-group col-md-12{{ $errors->has('name') ? ' has-error' : '' }}">
                        <label for="drawer" class="control-label">Casilla</label>
                        <input id="drawer" type="text" class="form-control" name="drawer" value="{{ old('name') }}">
                    </div>
                    <div class="form-group col-md-12 pt-3">
                        <button class="btn btn-primary full-width waves-effect waves-light"><strong>REGISTRAR</strong></button>
                    </div>
                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
