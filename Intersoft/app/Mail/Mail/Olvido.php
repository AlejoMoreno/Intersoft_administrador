<?php

namespace App\Mail\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

use App\Usuarios;

class Olvido extends Mailable
{
    use Queueable, SerializesModels;

    public $usuario;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Usuarios $usuarios)
    {
        $usuarios->password = "Temporal123";
        $usuarios->save();
        $this->usuario = $usuarios;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mail.olvido');
    }
}
