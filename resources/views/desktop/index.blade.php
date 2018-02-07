@extends('layouts.app')
@section('content')
    @include('app/nav_panel')
    <div class="container-fluid">
        <div class="panelPartner auto_margin">
            <!---->
            <div class="row">
                <div class="col-md-6" style="text-align: center;">
                    <button type="button" onclick="openModalIn()" class="btn btn-primary col-md-10 btn-lg">Ingresar</button>
                </div>
                <div class="col-md-6" style="text-align: center;">
                    <button type="button" onclick="openModalOut()" class="btn btn-default col-md-10 btn-lg">Cobrar</button>
                </div>
            </div>
            <!--<p class="height_10"></p>
            <h2 class="title_a">Estado actual</h2>
            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <div class="widget_box_b">
                        <div class="contt">
                            <div class="fl_layer">
                                <figure><img src="images/icon-pat-01.svg" alt=""></figure>
                                <h4 class="title">Total del dia</h4>
                                <span class="line"></span>
                                <span class="data">125</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="widget_box_b">
                        <div class="contt">
                            <div class="fl_layer">
                                <figure><img src="images/icon-pat-02.svg" alt=""></figure>
                                <h4 class="title">Actualmente</h4>
                                <span class="line"></span>
                                <span class="data">18</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="widget_box_b bdred">
                        <div class="contt">
                            <div class="fl_layer">
                                <figure><img src="images/icon-pat-03.svg" alt=""></figure>
                                <h4 class="title">motos</h4>
                                <span class="line"></span>
                                <span class="data red">6</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="widget_box_b">
                        <div class="contt">
                            <div class="fl_layer">
                                <figure><img src="images/icon-pat-04.svg" alt=""></figure>
                                <h4 class="title">Carros</h4>
                                <span class="line"></span>
                                <span class="data total">12</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>-->

            <!---->
            <p class="height_10"></p>

            <!---->
            <div class="box">
                <div class="box-title">
                    <h3>
                        <i class="fa fa-search"></i>
                        <h2 class="title_a">Opciones de Busqueda</h2>
                    </h3>
                </div>
                <div class="box-content">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                {!! Form::label('fecha', 'Fechas', ['class' => 'control-label']) !!}
                                <input class="form-control" id="Tiempo" type="text" name="daterange" value="01/02/2018 1:30 PM - 01/02/2018 2:00 PM" />
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                {!! Form::label('tipo', 'Tipo Vehiculo', ['class' => 'control-label']) !!}
                                <select id="type" name="type" class="form-control">
                                    <option value="">Todos</option>
                                    <option value="1">Carro</option>
                                    <option value="2">Moto</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                {!! Form::label('tipoT', 'Tipo Tiempo', ['class' => 'control-label']) !!}
                                <select id="type" name="type" class="form-control">
                                    <option value="">Todos</option>
                                    <option value="1">Horas</option>
                                    <option value="2">Dias</option>
                                    <option value="3">Mensualidad</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-2 col-sm-2">
                            <div class="form-group">
                                <label class="control-label">&nbsp;</label>
                                <button class="btn btn-success form-control" id="advanced_search"><i class="fa fa-search"></i> Buscar</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

                <div class="row">
                <div class="col-12">
                    <table class="table responsive" id="tickets-table">
                        <thead>
                        <tr>
                            <th class="all">Placa</th>
                            <th class="min-tablet">Tipo</th>
                            <th class="min-tablet">Estado</th>
                            <th class="min-tablet">Precio</th>
                            <th class="min-tablet">Locker</th>
                            <th class="min-tablet">Atendió</th>
                            <th class="all">acciones</th>
                        </tr>
                        </thead>
                    </table>
                </div>
            </div>

        </div>
    </div>

    @include('ticket.modal_ticket_in')
    @include('ticket.modal_ticket_out')
    @include('ticket.modal_ticket_pay')
@endsection
@section('scripts')
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="//cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="//cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script src="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.js"></script>

    <script>
        var app_e = new Vue({
            el: "#modal_ticket_in",
        });
        function openModalIn(){
            $('#modal_ticket_in').modal('show');
            getFecha();
        }
        function openModalOut(){
            $('#modal_ticket_out').modal('show');
            getFecha();
            $('#ticket_id').val('');
        }
        var getFecha = function(){
            var fecha = new Date();
            var fechaActual=fecha.getDate()+"/"+(fecha.getMonth()+1)+"/"+fecha.getFullYear()
                +"  "+fecha.getHours()+":"+fecha.getMinutes();
            $('#fecha').val(fechaActual);
        };
        function pagar() {
            var ticket_id= $('#ticket_id').val();
            ticket_id = ticket_id.replace(/[^0-9]/g,'');
            $('#ticket_id').val(ticket_id*1);
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: "POST",
                url: "cobrar",
                data: {
                    ticket_id:ticket_id
                },
                success: function (datos) {
                    $('.alert').alert();
                    $('#pagar').html(datos[0]);
                    $('#tiempo').html(datos[1]);
                    $('#modal_ticket_out').modal('hide');
                    $('#modal_ticket_pay').modal('show');

                },
                error:function () {
                    alert("Error !");
                }
            });
        }
        $(function() {
            $('input[name="daterange"]').daterangepicker({
                timePicker: true,
                timePickerIncrement: 30,
                locale: {
                    format: 'YYYY/MM/DD h:mm A'
                }
            });
            var fecha = new Date();
            var hoy=fecha.getFullYear()+"/"+(fecha.getMonth()+1)+"/"+fecha.getDate();
            $('#Tiempo').val(hoy+' 12:00 AM - '+hoy+' 11:59 pm');
            $.extend(true, $.fn .dataTable.defaults, {
                "stateSave": true,
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.10.9/i18n/Spanish.json"
                }
            });
            $('#tickets-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{!! route('get_tickets') !!}',
                columns: [
                    { data: 'plate', name: 'Placa', orderable  : false, searchable : false },
                    { data: 'Tipo', name: 'Tipo', orderable  : false, searchable : false },
                    { data: 'Estado', name: 'Estado', orderable  : false, searchable : false },
                    { data: 'price', name: 'Precio', orderable  : false, searchable : false },
                    { data: 'drawer', name: 'Locker', orderable  : false, searchable : false },
                    { data: 'Atendio', name: 'Atendió', orderable  : false, searchable : false },
                    { data: 'action', name: 'acciones', orderable  : false, searchable : false },
                ],
                lengthMenu: [[ 10, 25, 50, -1], [ 10, 25, 50, "Todos"]]
            });
        });
    </script>
@endsection