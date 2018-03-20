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
            <li v-bind:class="{ active : nav == 'all' }"><a href="#!" v-on:click="all = true; nav = 'all'; loadTable()">{{ tt('pages/navigation.start') }}</a></li>
            <li v-bind:class="{ active : nav == 'referrals' }"><a href="#!" v-on:click="all = false; nav = 'referrals'; loadTable()">{{ tt('pages/navigation.referrals') }}</a></li>
            <li v-bind:class="{ active : nav == 'history' }"><a href="#!" v-on:click="all = false; nav = 'history'; loadTable('history')">{{ tt('pages/navigation.record') }}</a></li>
            <li v-bind:class="{ active : nav == 'retired' }"><a href="#!" v-on:click="all = false; nav = 'retired'; loadTable('retired')">{{ tt('pages/navigation.retired') }} </a><span class="badge badge-danger" v-cloak>@{{ retired }}</span></li>
            <li v-bind:class="{ active : nav == 'account' }"><a href="#!" v-on:click="all = false; nav = 'account'">{{ tt('pages/navigation.account') }}</a></li>
        </ul>
    </div>
</nav>