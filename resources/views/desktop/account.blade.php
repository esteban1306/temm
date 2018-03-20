<div class="row" v-show="nav == 'account'">
    @php($user = Auth::user())
    <div class="col-sm-4 padding_20">
        <div class="Mods">
            <div class="head">
                <h3>{{ tt('pages/account.account') }}</h3>
            </div>
            <div class="body">
                <hr>
                <p>
                    {{ $user->first_name.' '.$user->last_name }} <br>
                    <strong>{{ tt('pages/account.email') }}:</strong> {{ $user->email }}
                </p>
            </div>
        </div>
    </div>
    <div class="col-sm-8">
        <div class="mi-cuenta">
            <h2>{{ tt('pages/account.update_account') }}</h2>
            <hr>
            <form class="row">
                <div class="form-group col-sm-12">
                    <div class="head">
                        <h5>{{ tt('pages/account.form.change_password') }}</h5>
                    </div>
                </div>
                <div class="form-group col-sm-6">
                    <label for="">{{ tt('pages/account.form.current_password') }}</label>
                    <input type="password" class="form-control validate[required,minSize[6]]" name="currentPassword" id="currentPassword" value="">
                </div>
                <div class="form-group col-sm-6">
                    <label for="">{{ tt('pages/account.form.new_password') }}</label>
                    <input type="password" class="form-control validate[required,minSize[6]]" name="password" id="password" value="">
                </div>
                <div class="form-group col-sm-6">
                    <label for="">{{ tt('pages/account.form.confirm_password') }}</label>
                    <input type="password" class="form-control validate[required,equals[password]]" name="confirm_password" value="">
                </div>

                <div class="form-group col-sm-12">
                    <div class="head">
                        <h5>{{ tt('pages/account.form.personal_information') }}</h5>
                    </div>
                </div>
                <div class="form-group col-sm-6">
                    <label for="">{{ tt('pages/account.form.name') }}</label>
                    <input type="text" class="form-control validate[required]" name="new_name" value="{{ $user->first_name }}">
                </div>
                <div class="form-group col-sm-6">
                    <label for="">{{ tt('pages/account.form.last_name') }}</label>
                    <input type="text" class="form-control validate[required]" name="new_last_name" value="{{ $user->last_name }}">
                </div>
                <div class="form-group col-sm-6">
                    <label for="">{{ tt('pages/account.form.email') }}</label>
                    <input type="text" class="form-control validate[required,custom[email]]" name="new_email" value="{{ $user->email }}">
                </div>
                <div class="col-sm-12">
                    <span class="height_10"></span>
                    <button type="button" onclick="actualizarCuenta()" class="btn btn-success waves-effect waves-light"><i class="mdi mdi-content-save-all"></i> {{ tt('pages/account.form.save_changes') }}</button>
                </div>
                <span class="height_30"></span>
            </form>
        </div>
    </div>
</div>