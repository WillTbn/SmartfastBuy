<?php

namespace App\Mail\AdmSystem\Responsible;

use App\Models\Condominia;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class UserConfigAsResponsible extends Mailable
{
    use Queueable, SerializesModels;
    // protected $condominia;
    /**
     * Create a new message instance.
     */
    public function __construct(protected  $condominia, protected $user)
    {

        //
        // $this->condominia = $condominia;
        // dd($condominia);
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {

        return new Envelope(
            subject: 'Responsável pelo condominio ',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        // logger('Mail envelope '.$this->condominia.'  -> '.__CLASS__);
        return new Content(
            view: 'emails.system.responsible.configResponsible',
            with:[
                'cond_name'=>$this->condominia,
                'resp_name'=>$this->user->name
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
