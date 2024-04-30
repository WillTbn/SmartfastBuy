<?php

namespace App\Mail\AdmSystem\Contract;

use App\Models\Account;
use App\Models\Condominia;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class SetSignatureResponsible extends Mailable
{
    use Queueable, SerializesModels;
    public Account $account;
    public Condominia $condominia;
    /**
     * Create a new message instance.
     */
    public function __construct(
        Account $account,
        Condominia $condominia
    )
    {
        Log::info('Estou no '.__CLASS__);
        $this->account = $account;
        $this->condominia = $condominia;
    }
    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Você assinou o contrato!',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.system.contract.signatureResponsible',
            with:[
                'condominia_name' => $this->condominia->name
            ]
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
