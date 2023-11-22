<?php

namespace App\Mail;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class CreateOrdersMail extends Mailable
{
    use Queueable, SerializesModels;


    public $order;
    /**
     * Create a new message instance.
     */
    public function __construct(
        Order $order,
    )
    {
        $this->order = $order;
    }

    /**
     * daily
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            from: new Address('supersait@info.com', 'Jeffrey Way'), // От кого сообщение
            subject: 'Create Orders Mail',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.create_order',
            with: [
                'productName' => $this->order->product->product_name,  // Задаем переменные для сообщения
                'price' => $this->order->product->price,
                'buyer' => $this->order->user->fio,
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
