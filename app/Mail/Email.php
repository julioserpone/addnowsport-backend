<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Email extends Mailable {

    use Queueable,
        SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
// Mail::to($emailTosend)->send(new Email($view,$asunto,$data));                         ⁠⁠
//    // ---  Informacion que sera enviada en el email

    protected $view; // Vista de el correo
    protected $dataExtra;  // Informacion que necesitara la vista , utilizando arreglo asociativo.
    protected $asunto;  // Asunto de correo
    protected $name;  // Nombre del correo

    public function __construct($vista, $asunto, $name, $content) {
        $this->view = $vista;
        $this->dataExtra = $content;
        $this->asunto = $asunto;
        $this->name = $name;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build() {
        if (!env('MAIL_USERNAME')){
            dd('The Variable of environment MAIL_USERNAME is not defined');
        }

        return $this->view($this->view)
                        ->from(env('MAIL_USERNAME'), $this->name)
                        ->subject($this->asunto)
                        ->with($this->dataExtra);
    }

}
