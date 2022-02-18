<?php

namespace App\Mail;

use App\Models\Formulario;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Comprovante extends Mailable
{
    use Queueable, SerializesModels;
    private $user;
    private $formulario;
    private $comprovante;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user, Formulario $formulario, $comprovante)
    {
        $this->user = $user;
        $this->formulario = $formulario;
        $this->comprovante = $comprovante;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $this->subject('COMPROVANTE RB SIMPLIFICADO');
        $this->to($this->user->email, $this->user->name);
        return $this->markdown('mail.comprovante', [
            'user' => $this->user,
            'formulario' => $this->formulario,
            'comprovante' => $this->comprovante
        ]);
    }
}
