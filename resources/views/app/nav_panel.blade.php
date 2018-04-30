<div id="Bread_top">
    <div class="container-fluid">
        <section class="areaBread auto_margin">
            <div class="row">
                <div class="col-9">
                    <h1>"¿Que, pues, diremos a esto? Si Dios es por nosotros, ¿Quién contra nosotros?" : Romanos 8:31</h1>
                </div>
                <div class="col-3 text-right">
                    <span class="member">Hola, {{ Auth::user()->name }}</span>
                </div>
            </div>
        </section>
    </div>
</div>
<nav class="nav_patner_panel">
    <div class="container-fluid">
        <ul class="auto_margin">
            <li id="nav_inicio" v-bind:class="{ active : nav == 'all' }"><a href="#!" v-on:click="all = true; nav = 'all'; month= false; loadTable()">Inicio</a></li>
            <li v-bind:class="{ active : nav == 'month' }"><a href="#!" v-on:click="all = false; month= true; nav = 'month'; loadTable('month')">Mensualidades</a></li>
            <li v-bind:class="{ active : nav == 'account' }"><a href="#!" v-on:click="all = false; month= false; nav = 'account'">Mi cuenta</a></li>
        </ul>
    </div>
</nav>