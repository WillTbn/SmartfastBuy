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

class SetSignatureCeo extends Mailable
{
    use Queueable, SerializesModels;
    private Account $account;
    private Condominia $condominia;
    /**
     * Create a new message instance.
     */
    public function __construct(
        Account $account,
        Condominia $condominia
    )
    {
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
            view: 'emails.system.contract.signatureCeo',
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
