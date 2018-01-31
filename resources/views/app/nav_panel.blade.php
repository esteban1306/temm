<div id="Bread_top">
    <div class="container-fluid">
        <section class="areaBread auto_margin">
            <div class="row">
                <div class="col-6">
                    <h1>Partners</h1>
                </div>
                <div class="col-6 text-right">
                    <span class="member">Hola, {{ Auth::user()->name }}</span>
                    <figure><img src="images/user-partner.png" class="img-fluid" alt=""></figure>
                </div>
            </div>
        </section>
    </div>
</div>
<nav class="nav_patner_panel">
    <div class="container-fluid">
        <ul class="auto_margin">
            <li class="active"><a href="partners-panel.html">Dashboard</a></li>
            <li ><a href="partners-table-list.html">Mis referidos</a></li>
            <li><a href="partners-table-list.html">Historial</a></li>
            <li><a href="partners-table-list.html">Retirados </a><span class="badge badge-danger">6</span></li>
            <li><a href="partners-cuenta.html">Mi Cuenta</a></li>
        </ul>
    </div>
</nav>