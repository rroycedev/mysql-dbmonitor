<?php

namespace App\Email;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ServersDefined extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * The order instance.
     *
     * @var Servers
     */

    public $servers;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($servers)
    {
        $this->servers = $servers;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('ronroyce@gmail.com')
            ->markdown('email.servers');
    }

}
