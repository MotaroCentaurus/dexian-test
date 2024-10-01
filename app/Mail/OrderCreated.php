<?php

namespace App\Mail;

use Illuminate\Mail\Mailable;

class OrderCreated extends Mailable
{
    public $client;
    public $order;

    public function __construct($client, $order)
    {
        $this->client = $client;
        $this->order = $order;
    }

    public function build()
    {
        return $this->from('noreply@yourdomain.com')
                    ->subject('Order Confirmation')
                    ->view('emails.order_created')
                    ->with([
                        'client' => $this->client,
                        'order' => $this->order,
                    ]);
    }
}
