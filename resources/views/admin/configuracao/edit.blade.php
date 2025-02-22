@extends('layouts.app')

@section('titulo', 'Hornet Bier - Configurações')

@section('content')
    <div class="container-fluid">
        <h1 class="h3 mb-2 text-gray-800">Configurações</h1>
        <br>
        <div class="card mb-4">
            <div class="card-body">
                <form action="{{ route('configuracao.update') }}" method="POST">
                    @csrf
                    <div class="form-group row">
                        <div class="col-12">
                            <legend>Envio de Emails</legend><hr>
                        </div>
                        <div class="col-12 col-md-4 mb-3">
                            <label>Mail Mailer:</label>
                            <input type="text" class="form-control form-control-user @error('mail_mailer') is-invalid @enderror" name="mail_mailer" required autocomplete="mail_mailer" maxlength="250" autofocus id="mail_mailer" value="{{env('MAIL_MAILER')}}">
                            @error('mail_mailer')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="col-12 col-md-4 mb-3">
                            <label>Mail Host:</label>
                            <input type="text" class="form-control form-control-user @error('mail_host') is-invalid @enderror" name="mail_host" required autocomplete="mail_host" maxlength="250" autofocus id="mail_host" value="{{env('MAIL_HOST')}}">
                            @error('mail_host')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="col-12 col-md-4 mb-3">
                            <label>Mail Port:</label>
                            <input type="text" class="form-control form-control-user @error('mail_port') is-invalid @enderror" name="mail_port" required autocomplete="mail_port" maxlength="250" autofocus id="mail_port" value="{{env('MAIL_PORT')}}">
                            @error('mail_port')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="col-12 col-md-6 mb-3">
                            <label>Mail Encryption:</label>
                            <input type="text" class="form-control form-control-user @error('mail_encryption') is-invalid @enderror" name="mail_encryption" required autocomplete="mail_encryption" maxlength="250" autofocus id="mail_encryption" value="{{env('MAIL_ENCRYPTION')}}">
                            @error('mail_encryption')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="col-12 col-md-6 mb-3">
                            <label>Mail Username:</label>
                            <input type="text" class="form-control form-control-user @error('mail_username') is-invalid @enderror" name="mail_username" required autocomplete="mail_username" maxlength="250" autofocus id="mail_username" value="{{env('MAIL_USERNAME')}}">
                            @error('mail_username')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="col-12 col-md-6 mb-3">
                            <label>Mail Password:</label>
                            <input type="password" class="form-control form-control-user @error('mail_password') is-invalid @enderror" name="mail_password" required autocomplete="mail_password" maxlength="250" autofocus id="mail_password" value="{{env('MAIL_PASSWORD')}}">
                            @error('mail_password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="col-12 col-md-6 mb-3">
                            <label>Mail From:</label>
                            <input type="text" class="form-control form-control-user @error('mail_from') is-invalid @enderror" name="mail_from" autocomplete="mail_from" maxlength="250" autofocus id="mail_from" value="{{env('MAIL_FROM_ADDRESS')}}">
                            @error('mail_from')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-12">
                            <legend>Sweet Alert</legend><hr>
                        </div>
                        <div class="col-12 mb-3">
                            <label>Texto do Botão de Confirmar no Alerta de Exclusão:</label>
                            <input type="text" class="form-control form-control-user @error('text_confirm_sweet_alert') is-invalid @enderror" name="text_confirm_sweet_alert" autocomplete="text_confirm_sweet_alert" maxlength="250" autofocus id="text_confirm_sweet_alert" value="{{env('SWEET_ALERT_CONFIRM_DELETE_CONFIRM_BUTTON_TEXT')}}">
                            @error('text_confirm_sweet_alert')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="col-12 mb-3">
                            <label>Texto do Botão de Cancelar no Alerta de Exclusão:</label>
                            <input type="text" class="form-control form-control-user @error('text_cancel_sweet_alert') is-invalid @enderror" name="text_cancel_sweet_alert" autocomplete="text_cancel_sweet_alert" maxlength="250" autofocus id="text_cancel_sweet_alert" value="{{env('SWEET_ALERT_CONFIRM_DELETE_CANCEL_BUTTON_TEXT')}}">
                            @error('text_cancel_sweet_alert')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-12">
                            <legend>Pagamento</legend><hr>
                        </div>
                        <div class="col-12 mb-3">
                            <label>APP ID:</label>
                            <input type="text" class="form-control form-control-user @error('app_id') is-invalid @enderror" name="app_id" autocomplete="app_id" maxlength="250" autofocus id="app_id" value="{{env('MP_APP_ID')}}">
                            @error('app_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="col-12 mb-3">
                            <label>APP SECRET:</label>
                            <input type="password" class="form-control form-control-user @error('app_secret') is-invalid @enderror" name="app_secret" autocomplete="app_secret" maxlength="250" autofocus id="app_secret" value="{{env('MP_APP_SECRET')}}">
                            @error('app_secret')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <button class="btn btn-success" type="submit">Atualizar</button>
                </form>
            </div>
        </div>
    </div>
@endsection
