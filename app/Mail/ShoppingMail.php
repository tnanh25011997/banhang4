<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Bill;
use App\BillDetail;


class ShoppingMail extends Mailable
{
    use Queueable, SerializesModels;
    public $bill;
    public $bill_detail  = [];
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Bill $bill,$bill_detail)
    {
        $this->bill = $bill;
        $this->bill_detail = $bill_detail; //một mảng
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mail.shopping');// view mail da tao
    }
}
