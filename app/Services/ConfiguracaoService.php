<?php 
namespace App\Services;

use Jackiedo\DotenvEditor\DotenvEditor;
use Illuminate\Support\Facades\Artisan;

class ConfiguracaoService
{
    public function updateDotenv(array $data)
    {
        $dotenvEditor = new DotenvEditor(app(), app('config'), base_path('.env'), base_path());
        $env = $dotenvEditor->load();
        
        $env->setKey('MAIL_MAILER', $data['mail_mailer']);
        $env->setKey('MAIL_HOST', $data['mail_host']);
        $env->setKey('MAIL_PORT', $data['mail_port']);
        $env->setKey('MAIL_USERNAME', $data['mail_username']);
        $env->setKey('MAIL_PASSWORD', $data['mail_password']);
        $env->setKey('MAIL_ENCRYPTION', $data['mail_encryption']);
        $env->setKey('MAIL_FROM_ADDRESS', $data['mail_from']);

        $env->setKey('SWEET_ALERT_CONFIRM_DELETE_CONFIRM_BUTTON_TEXT', $data['text_confirm_sweet_alert']);
        $env->setKey('SWEET_ALERT_CONFIRM_DELETE_CANCEL_BUTTON_TEXT', $data['text_cancel_sweet_alert']);

        $env->setKey('MP_APP_ID', $data['app_id']);
        $env->setKey('MP_APP_SECRET', $data['app_secret']);

        $env->save();

        Artisan::call('cache:clear');
    }
}