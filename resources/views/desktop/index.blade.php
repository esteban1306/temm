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
                                <input class="form-control" id="Tiempo" />
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                {!! Form::label('tipo', 'Tipo Vehiculo', ['class' => 'control-label']) !!}
                                <select id="type-car" name="type" class="form-control">
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
    <script src="{{ asset('js/datatable.min.js') }}"></script>
    <script src="{{ asset('js/moment.min.js') }}"></script>
    <script src="{{ asset('js/daterangepicker.js') }}"></script>
    <script src="{{ asset('js/pnotify.custom.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jQuery-Validation-Engine/2.6.4/jquery.validationEngine.min.js" type="text/javascript" charset="utf-8"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jQuery-Validation-Engine/2.6.4/languages/jquery.validationEngine-es.js" type="text/javascript" charset="utf-8"></script>

    <script>
        var app_e = new Vue({
            el: "#modal_ticket_in",
        });
        function openModalIn(){
            $('#modal_ticket_in').modal('show');
            getFecha();
            $("#nameIn").css("display","none");
            $("#rangeIn").css("display","none");
            $("#schedule").val(1);
            $("#typeIn").val(1);
        }
        function mensualidad(){
            var schedule = $("#schedule").val();
            if(schedule == 3){
                $("#nameIn").css("display","block");
                $("#rangeIn").css("display","block");
            }else{
                $("#nameIn").css("display","none");
                $("#rangeIn").css("display","none");
            }
        }
        function openModalOut(){
            $('#modal_ticket_out').modal('show');
            getFecha();
            $('#ticket_id').val('');
        }
        var getFecha = function(){
            var fecha = new Date();
            var fechaActual=fecha.getDate()+"/0"+(fecha.getMonth()+1)+"/"+fecha.getFullYear()
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
                    $('#tickets-table').dataTable()._fnAjaxUpdate();

                },
                error:function () {
                    alert("Error !");
                }
            });
        }

        function crearTicket() {
            var plate = $("#plate").val();
            var type = $("#typeIn").val();
            var schedule = $("#schedule").val();
            var drawer = $("#drawer").val();
            var nameIn = $("#nameIn").val();
            var date = $("#date-range").val();

            if(schedule == 3 && !($("#nameIn").validationEngine('validate')  && $("#date-range").validationEngine('validate') )){
                return;
            }
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: "POST",
                url: "tickets",
                data: {
                    plate:plate,
                    type:type,
                    schedule:schedule,
                    drawer:drawer,
                    name:name,
                    date:date,
                },
                success: function (datos) {
                    $('#modal_ticket_in').modal('hide');
                    new PNotify({
                        title: 'Exito',
                        text: 'Se agregó el ticket con exito'
                    });
                },
                error:function () {
                    alert("Error !");
                }
            });
        }

        $(function() {
            $("#plate").blur(function(){
                type();
            });
            $('input[name="daterange"]').daterangepicker({
                timePicker: true,
                timePickerIncrement: 30,
                locale: {
                    format: 'YYYY/MM/DD h:mm A'
                }
            });
            $('#date-range').daterangepicker({
                "startDate": "<?php  use Carbon\Carbon;$now = Carbon::now(); echo $now->format('m/d/Y')?>",
                "endDate": "<?php   echo $now->addMonth()->format('m/d/Y')?>",
                "opens": "center",
                "drops": "up"
            }, function(start, end, label) {
                console.log('New date range selected: ' + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD') + ' (predefined range: ' + label + ')');
            });
            $('#Tiempo').daterangepicker({
                "startDate": "<?php $now = Carbon::now(); echo $now->format('m/d/Y')?>",
                "endDate": "<?php   echo $now->addDay()->format('m/d/Y')?>",
                "opens": "center",
                "drops": "up"
            }, function(start, end, label) {
                console.log('New date range selected: ' + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD') + ' (predefined range: ' + label + ')');
            });
            var fecha = new Date();
            var hoy=fecha.getFullYear()+"/"+(fecha.getMonth()+1)+"/"+fecha.getDate();
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
            $('#advanced_search').click(function() {
                $("#tickets-table").dataTable().fnDestroy();
                $('#tickets-table').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: {
                        url  : '{!! route('get_tickets') !!}',
                        data : {
                            type_car        : $("#type-car").val(),
                            type            : $("#type").val(),
                        }
                    },
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
        });
        function getOpt() {
            var opt = {
                processing     : true,
                serverSide     : true,
                destroy        : true,
                ajax           : '',
                columns        : [],
                sDom           : 'r<Hlf><"datatable-scroll"t><Fip>',
                pagingType     : "simple_numbers",
                iDisplayLength : 5,

            };
            return opt;
        }
        function validar(e) {
            tecla = (document.all) ? e.keyCode : e.which;
            if (tecla==13){
                type();
            }
        }
        function type() {
            var plate = $("#plate").val();
            if(plate ==""){
                return true;
            }
            if(plate.length == 6 && !isNaN(plate.charAt(plate.length-1))){
                $("#typeIn").val(1);
            }
            else{
                $("#typeIn").val(2);
            }
        }
        function createDataTableStandar(selector, opt) {
            if (typeof opt.scroll === 'undefined')
                opt.scroll = true;
            var myTable = $(selector).DataTable(opt);
            $(".dataTables_filter input[aria-controls='" + selector.substring(1) + "']").unbind().bind("keyup", function(e) {
                //if(this.value.length >= 3 || e.keyCode == 13) {
                if (e.keyCode == 13) {
                    myTable.search(this.value).draw();
                    return;
                }
                if (this.value == "")
                    myTable.search("").draw();
                return;
            });
            if (opt.scroll) {
                myTable.on('page.dt', function() {
                    $('html, body').animate({
                        scrollTop: $(".dataTables_wrapper").offset().top
                    }, 'fast');
                });
            }
            return myTable;
        }
    </script>
@endsection