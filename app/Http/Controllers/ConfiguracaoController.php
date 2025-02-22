<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Jackiedo\DotenvEditor\DotenvEditor;
use Illuminate\Support\Facades\Artisan;

class ConfiguracaoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function edit()
    {
        return view('admin.configuracao.edit');
    }

    public function update(Request $request)
    {
        $dotenvEditor = new DotenvEditor(app(), app('config'), base_path('.env'), base_path());
        $env = $dotenvEditor->load();
        
        $env->setKey('MAIL_MAILER', $request->mail_mailer);
        $env->setKey('MAIL_HOST', $request->mail_host);
        $env->setKey('MAIL_PORT', $request->mail_port);
        $env->setKey('MAIL_USERNAME', $request->mail_username);
        $env->setKey('MAIL_PASSWORD', $request->mail_password);
        $env->setKey('MAIL_ENCRYPTION', $request->mail_encryption);
        $env->setKey('MAIL_FROM_ADDRESS', $request->mail_from);

        $env->setKey('SWEET_ALERT_CONFIRM_DELETE_CONFIRM_BUTTON_TEXT', $request->text_confirm_sweet_alert);
        $env->setKey('SWEET_ALERT_CONFIRM_DELETE_CANCEL_BUTTON_TEXT', $request->text_cancel_sweet_alert);

        $env->setKey('MP_APP_ID', $request->app_id);
        $env->setKey('MP_APP_SECRET', $request->app_secret);

        $env->save();

        Artisan::call('cache:clear');

        alert()->success('Concluído','Configurações alteradas com sucesso.');
        return redirect()->route('home');
    }
}
