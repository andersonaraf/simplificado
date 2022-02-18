<?php

namespace App\Jobs;

use App\Models\Formulario;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class Comprovante implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public $tries = 5;
    private $user;
    private $formulario;
    private $comprovante;
    public function __construct(User $user, Formulario $formulario, $comprovante)
    {
        $this->user = $user;
        $this->formulario = $formulario;
        $this->comprovante = $comprovante;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Mail::send(new \App\Mail\Comprovante($this->user, $this->formulario, $this->comprovante));

    }
}
