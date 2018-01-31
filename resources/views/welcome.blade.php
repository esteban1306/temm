@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="areaPartner">
            <section id="registro" class="headIntro auto_margin">
                <div class="row">
                    <div class="col-lg-8 col-lg-8">
                        <div class="text-center">
                            <!--<figure><img src="images/wasi-partner.svg" class="img-fluid" alt=""></figure>-->
                            <h2>GANA <strong>CON</strong> TEEM</h2>
                            <img src="images/box-shadow.png" width="220" alt="">
                            <!--<p>Integer fringilla enim eget accumsan tempus. Vivamus nec odio eget sapien convallis condimentum Etiam ac eros quis purus egestas ornare
                                ut eu augue.</p>-->
                        </div>
                    </div>
                    <div class="col-lg-4 col-lg-4">
                        <div class="registro">
                            <div class="head-form">
                                <h4>Registro</h4>
                            </div>
                            <div class="body-form">
                                <form class="row" method="POST" action="{{ route('register') }}">
                                    {{ csrf_field() }}
                                    <div class="form-group col-md-12{{ $errors->has('email') ? ' has-error' : '' }}">
                                        <label for="email" class="control-label">Correo Electrónico</label>

                                        <div>
                                            <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                                            @if ($errors->has('email'))
                                                <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group col-md-6{{ $errors->has('name') ? ' has-error' : '' }}">
                                        <label for="name" class="control-label">Nombre</label>
                                            <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>

                                            @if ($errors->has('name'))
                                                <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                            @endif
                                    </div>
                                    <div class="form-group col-md-6{{ $errors->has('last-name') ? ' has-error' : '' }}">
                                        <label for="last_name" class="control-label">Apellidos</label>
                                            <input id="last_name" type="text" class="form-control" name="last_name" value="{{ old('last_name') }}" required autofocus>

                                            @if ($errors->has('last_name'))
                                                <span class="help-block">
                                        <strong>{{ $errors->first('last_name') }}</strong>
                                    </span>
                                            @endif
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label for="">País</label>
                                        <select name="country" class="selectpicker" id="">
                                            <option value="1">Colombia</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-12{{ $errors->has('password') ? ' has-error' : '' }}">
                                        <label for="password" class="control-label">Contraseña</label>

                                        <div>
                                            <input id="password" type="password" class="form-control" name="password" required>

                                            @if ($errors->has('password'))
                                                <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group col-md-12">
                                        <label for="password-confirm" class="control-label">Confirmar contraseña</label>

                                        <div>
                                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                                        </div>
                                    </div>

                                    <div class="form-group col-md-12 pt-3">
                                        <button class="btn btn-primary full-width waves-effect waves-light"><strong>REGISTRARSE</strong></button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </section>


            <section class="partner-beneficios auto_margin">
                <div class="head">
                    <h3>Beneficios</h3>
                </div>

                <div class="list-beneficios">
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="item">
                                <figure><img src="images/ico-partner-01.svg" class="img-fluid" alt=""></figure>
                                <h3>Etiam ac eros quis purus egestas</h3>
                                <p>Integer fringilla enim eget accumsan tempus. Vivamus nec odio eget sapien convallis condimentum. Pellentesque nisi metus, tincidunt vel
                                    feugiat quis, tincidunt in lorem. Etiam ac eros quis purus egestas ornare ut eu augue.</p>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="item">
                                <figure><img src="images/ico-partner-02.svg" class="img-fluid" alt=""></figure>
                                <h3>Etiam ac eros quis purus egestas</h3>
                                <p>Integer fringilla enim eget accumsan tempus. Vivamus nec odio eget sapien convallis condimentum. Pellentesque nisi metus, tincidunt vel
                                    feugiat quis, tincidunt in lorem. Etiam ac eros quis purus egestas ornare ut eu augue.</p>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="item">
                                <figure><img src="images/ico-partner-03.svg" class="img-fluid" alt=""></figure>
                                <h3>Etiam ac eros quis purus egestas</h3>
                                <p>Integer fringilla enim eget accumsan tempus. Vivamus nec odio eget sapien convallis condimentum. Pellentesque nisi metus, tincidunt vel
                                    feugiat quis, tincidunt in lorem. Etiam ac eros quis purus egestas ornare ut eu augue.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>

 <!--   <section id="Parallax">
        <div class="parallax-container mask1">
            <div class="parallax"><img src="images/parallax-empleo.jpg"></div>
            <div class="contenidos mask2 auto_margin">
                <div class="text">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum eget efficitur velit, ac egestas velit.
                </div>
            </div>
        </div>
    </section>

    <div class="areaPartner">
        <section class="content-bottom auto_margin">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-4 hidden-md-down">
                        <img src="images/partner-people.png" class="img-fluid" alt="">
                    </div>
                    <div class="col-lg-8 text-center">
                        <article>
                            <h3>It has survived not only five centuries, but also the leap into electronic typesetting</h3>
                            <p class="height_30"></p>
                            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since
                                the
                                1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries,
                                but
                                also the leap into electronic typesetting, remaining essentially unchanged.</p>

                            <p> It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop
                                publishing
                                software like Aldus PageMaker including versions of Lorem Ipsum.</p>

                            <p class="height_30"></p>
                            <p>
                                <a href="#registro" class="btn btn-primary btn-lg waves-effect waves-light"><strong>REGISTRARSE</strong></a>
                            </p>
                            <p class="height_30 hidden-lg-up"></p>
                        </article>
                    </div>
                </div>
            </div>
        </section>
    </div>-->
    @include('desktop.login.modal_login')
    <!---->
    <p class="height_20"></p>
    <!---->
@endsection
@section('scripts')
    <script src="{{ asset('js/app.js') }}"></script>
    <script>
        var app_e = new Vue({
            el: "#modal_login",
        });

        function openModal(){
            $('#modal_login').modal('show');
        }
    </script>
@endsection
