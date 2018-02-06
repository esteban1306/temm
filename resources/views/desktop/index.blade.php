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
            <p class="height_10"></p>
            <h2 class="title_a">Estado actual</h2>
            <!---->
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
            </div>

            <!---->
            <p class="height_10"></p>
            <h2 class="title_a">Título opción</h2>
            <!---->

            <div class="row">
                <div class="col-12">
                    <table class="table table-bordered" id="tickets-table">
                        <thead>
                        <tr>
                            <th>Id</th>
                            <th>Placa</th>
                            <th>Tipo</th>
                            <th>Estado</th>
                            <th>Precio</th>
                            <th>Locker</th>
                            <th>Atendió</th>
                            <th>acciones</th>
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
            $.extend(true, $.fn.dataTable.defaults, {
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
                    { data: 'Id', name: 'Id', orderable  : false, searchable : false },
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