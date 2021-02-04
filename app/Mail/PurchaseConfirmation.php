<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PurchaseConfirmation extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($name, $products, $total)
    {
        $this->name = $name;
        $this->products = $products;
        $this->total = $total;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('amaso@root.com', 'Mailtrap')
        ->subject('Amasó')
        ->view('emails.purchaseConfirmation')
        ->with([
            'name' => $this->name,
            'products' => $this->products,
            'total' =>$this->total,
        ]);
    }
}
