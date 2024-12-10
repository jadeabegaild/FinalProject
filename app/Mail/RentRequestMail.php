<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class RentRequestMail extends Mailable
{
    use Queueable, SerializesModels;

    public $customerName;
    public $vehicleName;
    public $rentedDate;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($customerName, $vehicleName, $rentedDate)
    {
        $this->customerName = $customerName;
        $this->vehicleName = $vehicleName;
        $this->rentedDate = $rentedDate;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('customer.emails.rent_request')
                    ->subject('New Borrow Request')
                    ->with([
                        'customerName' => $this->customerName,
                        'vehicleName' => $this->vehicleName,
                        'rentedDate' => $this->rentedDate,
                    ]);
    }
}
