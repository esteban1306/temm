<div id="modal_venta" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Nueva venta</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body" style="min-height: 130px;" >
                <div id="formAddCustomer" class="row">
                    <div class="form-group col-md-6">
                        <label for="nombre" class="control-label">Productos</label>
                        @php($products = App\Product::where('parking_id',Illuminate\Support\Facades\Auth::user()->parking_id)->get())
                        <select class="validate[required] selectpicker2" id="productsList"  data-live-search="true" data-size="10">
                            <option>Seleccionar</option>
                            @foreach($products as $product)
                                {!! '<option data-toggle="tooltip" title="'.$product->description.'"value="'.$product->id_product.'">'.$product->name.(!empty($product->cantidad) && $product->cantidad !='-1'?' ('.$product->cantidad.')':'').'</option>' !!}
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="nombre" class="control-label">Cantidad</label>
                        <input id="fechaPrest" type="number" class="form-control validate[required]">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="nombre" class="control-label">interes %</label>
                        <input id="interestPrest" onchange="calcularCuota()" type="number" class="form-control validate[required]">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="nombre" class="control-label" >Tiempo (Meses)</label>
                        <input id="timePrest" type="number" onchange="calcularCuota()" class="form-control validate[required]">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="nombre" class="control-label">Tipo</label>
                        <select class="form-control" id="typePrest" onchange="calcularCuota()">
                            <option value="1">Mensual</option>
                            <option value="2">Quincenal</option>
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="nombre" class="control-label">Monto</label>
                        <input id="montoPrest" type="number" onchange="calcularCuota()" class="form-control validate[required]">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="nombre" class="control-label">Cuota</label>
                        <input disabled id="CuotaPrest" type="number" class="form-control validate[required]">
                    </div>

                    <div class="form-group col-md-12 pt-3">
                        <button id="new_prestamo" class="btn btn-primary full-width waves-effect waves-light" onclick="crearPrestamo()"><strong>REGISTRAR</strong></button>
                    </div>
                </div>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
