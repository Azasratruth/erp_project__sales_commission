<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SalesCommissionConfirmation extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($sender_name, $sender_email, $receiver, $commission_amount)
    {
        $this->sender_name          =   $sender_name;
        $this->sender_email         =   $sender_email;
        $this->receiver             =   $receiver;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $subject = "Sales Commission added to account.";

        return $this->from($this->sender_email, $this->sender_name)
            ->subject($subject)
            ->markdown('emails.sales_commission_confirmation');
    }
}
