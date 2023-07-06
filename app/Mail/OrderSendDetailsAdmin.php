<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrderSendDetailsAdmin extends Mailable
{
    use Queueable, SerializesModels;

    public $data;
    public function __Construct($data)
    {
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from(config('configSite.email_from'), config('configSite.name'))
            ->view('emails.order_details_admin')
            ->subject('Nueva Orden # ' .$this->data['order']['o_number'])
            ->with($this->data);
    }
}
