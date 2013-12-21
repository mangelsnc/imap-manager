<?php

namespace ImapManager;

use ImapManager\Mailbox;

class ImapManager
{

    private $mailbox;
    private $user;
    private $password;
 
    public function __construct(Mailbox $mailbox, $user, $password)
    {
        $this->mailbox = $mailbox;
        $this->user = $user;
        $this->password = $password;
    }

    
}