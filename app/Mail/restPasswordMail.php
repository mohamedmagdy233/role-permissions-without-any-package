<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class restPasswordMail extends Mailable
{
    use Queueable, SerializesModels;

    public $code;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct( $code)
    {
        $this->code = $code;


        //
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('no-reply@amomatter.com')
            ->subject('اعاده تعين كلمة المرور')
            ->with('code', $this->code)
            ->view('admin.emails.resetPassword');
    }
}
