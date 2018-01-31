@extends('layouts.app')
@section('content')
    @include('app/nav_panel')
    <div class="container-fluid">
        <div class="panelPartner auto_margin">
            <div class="row">
                <div class="col-lg-8">
                    <div class="widget_box">
                        <h3>Enviar Invitaciones</h3>
                        <!-- item-->
                        <div class="row">
                            <div class="col-md-5">
                                <div class="form-group">
                                    <input type="text" class="form-control" name="" placeholder="Nombre y apellidos">
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="form-group">
                                    <input type="text" class="form-control" name="" placeholder="Correo Electrónico">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <bt class="btn btn-primary full-width waves-effect waves-light"><strong>Enviar</strong></bt>
                                </div>
                            </div>
                            <div class="col-12">
                                <a href="">+ Agregar Referido</a>
                            </div>
                        </div>
                        <!-- end item-->
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="widget_box">
                        <h3>Tu URL de referido es:</h3>
                        <p class="5"></p>
                        <span class="code_id">http://www.wasi.co/refer?id5903984</span>
                    </div>
                </div>
            </div>

            <!---->
            <p class="height_10"></p>
            <h2 class="title_a">Título opción</h2>
            <!---->

            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <div class="widget_box_b">
                        <div class="contt">
                            <div class="fl_layer">
                                <figure><img src="images/icon-pat-01.svg" alt=""></figure>
                                <h4 class="title">Referidos</h4>
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
                                <h4 class="title">Activados</h4>
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
                                <h4 class="title">Retirados</h4>
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
                                <h4 class="title">Total Ganado</h4>
                                <span class="line"></span>
                                <span class="data total">$1.250.000</span>
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
                    <div class="table-responsive">
                        <table class="table">
                            <thead class="thead-inverse">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">First</th>
                                <th scope="col">Last</th>
                                <th scope="col">Handle</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <th scope="row">1</th>
                                <td>Mark</td>
                                <td>Otto</td>
                                <td>@mdo</td>
                            </tr>
                            <tr>
                                <th scope="row">2</th>
                                <td>Jacob</td>
                                <td>Thornton</td>
                                <td>@fat</td>
                            </tr>
                            <tr>
                                <th scope="row">3</th>
                                <td>Larry</td>
                                <td>the Bird</td>
                                <td>@twitter</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
@section('scripts')
    <script src="{{ asset('js/app.js') }}"></script>
@endsection