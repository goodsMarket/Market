<?php

namespace App\Mail;

use App\Models\EmailVerified;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class EmailVerify extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * The order instance.
     *
     * @var \App\Models\EmailVerified
     */
    public $emailVerified;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(EmailVerified $emailVerified)
    {
        $this->emailVerified = $emailVerified;
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        return new Envelope(
            from: new Address('goods.market.project@gmail.com', 'GoodsMarket'),
            subject: 'GoodsMarket Email Verify',
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
            // view: 'view.name', // 블레이드 템플릿으로 꾸밀 경우
            // text: 'mailreturn' // 텍스트 전용
            view: 'mailreturn'
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
