<?php

namespace ImapManager;

use ImapManager\Mailbox;
use ImapManager\ConnectionString;
use ImapManager\Exception;

class ImapManager
{

    private $imapStream;
    private $connectionString;
    private $mailbox;
    private $user;
    private $password;
 
    public function __construct($connectionString, $user, $password)
    {
        $this->connectionString = $connectionString;
        $this->user = $user;
        $this->password = $password;

        $this->connect();
    }

    public function getImapStream()
    {
        return $this->imapStream;
    }

    public function getConnectionString()
    {
        return $this->connectionString->getConnectionString();
    }

    public function getMailBox()
    {
        return $this->mailbox;
    }

    public function connect()
    {
        $this->imapStream = @imap_open(
            $this->connectionString->getConnectionString(), 
            $this->user, 
            $this->password
        );

        if(false === $this->imapStream) {
            throw new Exception\ConnectionException(imap_last_error());          
        }

        $this->mailbox = new MailBox($this->imapStream);
    }

    public function listAvailableMailboxes()
    {
        return imap_list($this->imapStream, $this->connectionString->getConnectionString(), '*');
    }

    
    
}