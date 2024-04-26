<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Http\Request;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class oldMail extends Mailable
{
    use Queueable, SerializesModels;
    public $input;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($input)
    {
        //
        $this->input = $input;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build(Request $request)
    {
        return $this->view('demo')
            ->from('teamAmato@gmail.com', 'hrhblmedia')
            ->subject('[code] thư xác nhận tài khoản')
            ->with($this->input);
    }
}
