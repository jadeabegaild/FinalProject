<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class RentRequestStatusMail extends Mailable
{
    use Queueable, SerializesModels;

    public $userName;
    public $vehicleName;
    public $rentedDate;
    public $status;

    /**
     * Create a new message instance.
     *
     * @param $userName
     * @param $vehicleName
     * @param $rentedDate
     * @param $status
     */
    public function __construct($userName, $vehicleName, $rentedDate, $status)
    {
        $this->userName = $userName;
        $this->vehicleName = $vehicleName;
        $this->rentedDate = $rentedDate;
        $this->status = $status;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('admin.emails.rent_request_status')
                    ->subject('Borrow Request Status Update')
                    ->with([
                        'userName' => $this->userName,
                        'vehicleName' => $this->vehicleName,
                        'rentedDate' => $this->rentedDate,
                        'status' => $this->status,
                    ]);
    }
}
