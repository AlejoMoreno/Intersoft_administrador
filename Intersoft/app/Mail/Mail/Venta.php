<?php

namespace App\Mail\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

use App\Usuarios;
use App\Empresas;
use App\Facturas;
use App\Kardex;

class Venta extends Mailable
{
    use Queueable, SerializesModels;

    public $facturas;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Facturas $facturas)
    {
        $this->facturas = $facturas;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mail.venta')
                ->from('intersoft@wakusoft.com')
                ->subject('Factura!');
    }
}
