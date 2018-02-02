<section id="Header">
    <div class="bg-fixed">
        <div id="topBar">
            <div class="area-bar auto_margin">
                <div class="flat-mega-pais">
                    <ul class="mcollapse changer">
                        <li class="movil-menu hidden-md-up"><a href="#" class="menu ssm-toggle-nav" title="open nav"> <i class="mdi mdi-menu mdi-22px"></i> <span
                                        class="txt">Menu</span> </a></li>
                        <li><a href="#"> <span class="flag-icon flag-icon-co"></span> Colombia ▾ </a>
                            <div class="drop-down two-column hover-fade">
                                <ul>
                                    <li><a href="#" title=""><strong>Disponible en:</strong></a></li>
                                    <li><a href="#" title="" onclick="cambiar_pais('ar','Argentina')"><span class="flag-icon flag-icon-ar"></span> Argentina</a></li>
                                    <li><a href="#" title="" onclick="cambiar_pais('bo','Bolivia')"><span class="flag-icon flag-icon-bo"></span> Bolivia</a></li>
                                    <li><a href="#" title="" onclick="cambiar_pais('ch','Chile')"><span class="flag-icon flag-icon-ch"></span> Chile</a></li>
                                    <li><a href="#" title="" onclick="cambiar_pais('co','Colombia')"><span class="flag-icon flag-icon-co"></span> Colombia</a></li>
                                    <li><a href="#" title="" onclick="cambiar_pais('cr','Costa Rica')"><span class="flag-icon flag-icon-cr"></span> Costa Rica</a></li>
                                    <li><a href="#" title="" onclick="cambiar_pais('ec','Ecuador')"><span class="flag-icon flag-icon-ec"></span> Ecuador</a></li>
                                    <li><a href="#" title="" onclick="cambiar_pais('es','España')"><span class="flag-icon flag-icon-es"></span> España</a></li>
                                    <li><a href="#" title="" onclick="cambiar_pais('gt','Guatemala')"><span class="flag-icon flag-icon-gt"></span> Guatemala</a></li>
                                    <li><a href="#" title="" onclick="cambiar_pais('hn','Honduras')"><span class="flag-icon flag-icon-hn"></span> Honduras</a></li>
                                </ul>
                                <ul>
                                    <li><a href="#" title="" onclick="cambiar_pais('mx','México')"><span class="flag-icon flag-icon-mx"></span> México</a></li>
                                    <li><a href="#" title="" onclick="cambiar_pais('ni','Nicaragua')"><span class="flag-icon flag-icon-ni"></span> Nicaragua</a></li>
                                    <li><a href="#" title="" onclick="cambiar_pais('pa','Panamá')"><span class="flag-icon flag-icon-pa"></span> Panamá</a></li>
                                    <li><a href="#" title="" onclick="cambiar_pais('py','Paraguay')"><span class="flag-icon flag-icon-py"></span> Paraguay</a></li>
                                    <li><a href="#" title="" onclick="cambiar_pais('pe','Perú')"><span class="flag-icon flag-icon-pe"></span> Perú</a></li>
                                    <li><a href="#" title="" onclick="cambiar_pais('pe','Puerto Rico')"><span class="flag-icon flag-icon-pr"></span> Puerto Rico</a>
                                    </li>
                                    <li><a href="#" title="" onclick="cambiar_pais('do','R. Dominicana')"><span class="flag-icon flag-icon-do"></span> R. Dominicana</a>
                                    </li>
                                    <li><a href="#" title="" onclick="cambiar_pais('sv','Salvador')"><span class="flag-icon flag-icon-sv"></span> Salvador</a></li>
                                    <li><a href="#" title="" onclick="cambiar_pais('ur','Uruguay')"><span class="flag-icon flag-icon-ur"></span> Uruguay</a></li>
                                    <li><a href="#" title="" onclick="cambiar_pais('ve','Venezuela')"><span class="flag-icon flag-icon-ve"></span> Venezuela</a></li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <header>
            <div class="container-fluid">
                <div class="area-header auto_margin">
                    <div class="row">
                        <div class="col-lg-3 col-md-1">
                            <div class="logo"><a href=""><img src="images/logo.png" data-2x="images/logo@2x.png" class="img-retina" alt=""></a></div>
                        </div>
                        <div class="col-lg-9 col-md-11">
                            <div class="topMenu">
                                <div class="flat-mega-menu">
                                    <ul class="mcollapse changer">
                                        @guest
                                            <li><a  style="cursor:pointer;" onclick="openModal()" title="Registro gratis" class="cotice">Login Partners</a></li>
                                        @else

                                            <li>     <a href="{{ route('logout') }}"
                                                        onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();" title="Registro gratis" class="cotice">
                                                    Cerrar Sesión
                                                </a>

                                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                                    {{ csrf_field() }}
                                                </form>
                                            </li>
                                        @endguest
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>
    </div>
    <div class="topshadow clearfix"></div>
</section>

<div class="bg-head"></div>

<aside id="leftNav" class="sideNav">
    <h5>Menu</h5>
    <div class="adv-panel"></div>
</aside>
<div class="ssm-overlay ssm-toggle-nav"></div>