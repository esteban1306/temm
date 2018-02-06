<div id="Bread_top">
    <div class="container-fluid">
        <section class="areaBread auto_margin">
            <div class="row">
                <div class="col-6">
                    <h1>Que hoy sea un gran dia</h1>
                </div>
                <div class="col-6 text-right">
                    <span class="member">Hola, {{ Auth::user()->name }}{{ Auth::user()->partner_id }}{{ Auth::user()->parking_id }}</span>
                    <figure><img src="images/user-partner.png" class="img-fluid" alt=""></figure>
                </div>
            </div>
        </section>
    </div>
</div>