<?php

namespace ImapManager;

use ImapManager\Mailbox;
use ImapManager\ConnectionString;
use ImapManager\Exception;

class ImapManager
{

    private $imapStream;
    private $connectionString;
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
    }

    public function changeMailbox($connectionString)
    {
        $this->connectionString = $connectionString;
        $this->connect();
    }

    public function listAvailableMailboxes()
    {
        return imap_list($this->imapStream, $this->connectionString->getConnectionString(), '*');
    }

    /*
    public function getMailBoxes()
    {
        $mailboxes = imap_getmailboxes($this->imapStream, $this->connectionString->getConnectionString(), '*');

        if(is_array($mailboxes)) {
            $mailboxesObj = array();
            
            foreach ($mailboxes as $mailbox) {
                $mailboxObj = new MailBox();
                $mailboxObj->setName($mailbox->name);
                $mailboxObj->setDelimiter($mailbox->delimiter);
                $mailboxObj->setAttributtes($mailbox->attributes);

                $mailboxesObj[]=$mailboxObj;
            }

            return $mailboxesObj;
        }

        return false;
    }
    */
    
}