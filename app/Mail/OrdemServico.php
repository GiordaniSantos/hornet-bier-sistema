<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class OrdemServico extends Mailable
{
    use Queueable, SerializesModels;
    private $ordemServico;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(\App\Models\OrdemServico $ordemServico)
    {
        $this->ordemServico = $ordemServico;
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        return new Envelope(
            subject: '[Hornet Bier] Relatório de Atendimento Técnico',
            to: [$this->ordemServico->cliente->email],
            replyTo: [
                //'giordani.santos.silveira@gmail.com',
            ],
        );
    }

    /**
     * Get the message content definition.
     *
     * @return \Illuminate\Mail\Mailables\Content
     */
    public function content()
    {
        return new Content(
            view: 'emails.ordemServico',
            with: [
                'ordemServico' => $this->ordemServico
            ],
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array
     */
    public function attachments()
    {
        return [];
    }
}
