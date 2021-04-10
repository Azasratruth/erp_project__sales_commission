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
    // public function __construct($sender_name, $sender_email, $receiver_name, $receiver_email)
    public function __construct($sender_name, $sender_email, $receiver, $commission_amount)
    {
        $this->sender_name          =   $sender_name;
        $this->sender_email         =   $sender_email;
        $this->receiver             =   $receiver;
        // $this->$commission_amount   =   $commission_amount;
        // dd($this->commission_amount);
        // $this->receiver_name    =   $receiver_name;
        // $this->receiver_email   =   $receiver_email;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        // $subject = "Sales Commission Rs. {$this->commission_amount} added to account.";
        $subject = "Sales Commission added to account.";

        return $this->from($this->sender_email, $this->sender_name)
            ->subject($subject)
            ->markdown('emails.sales_commission_confirmation');
        //     ->with([
        //         'user' => $this->user ?: $this->dummy_user,
        // ]);


        // return $this->view('view.name');
        // return $this->markdown('emails.sales_commission_confirmation');

    }
}
