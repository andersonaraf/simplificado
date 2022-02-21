<?php

namespace App\Providers;

use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        ResetPassword::toMailUsing(function($notifiable, $url){
            return (new MailMessage)
                ->subject('Notificação de Reset de Senha')
                ->line('Se você está recebendo este e-mail é porque recebemos um pedido de reset de senha para sua conta.')
                ->action('Resetar Senha', $url)
                ->line('Este link de reset de senha expirará em 60 minutos')
                ->line('Se você não requisitou o reset, ignore esta mensagem');
        });
    }
}
