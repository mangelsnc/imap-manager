<?php

namespace ImapManager;

use ImapManager\ConnectionFlags;
use ImapManager\Exception;

class Mailbox
{
    private $server;
    private $port;
    private $mailboxName;
    private $flags;

    public function __construct($server, $port = 993, $mailboxName = "INBOX") 
    {
        if(is_null($server)){
            throw new Exception\ServerRequiredException();
        }

        $this->server = $server;
        $this->port = $port;
        $this->mailboxName = $mailboxName;
        $this->flags = array();
    }

    public function getServer()
    {
        return $this->server;
    }

    public function setServer($server)
    {
        $this->server = $server;
    }

    public function getPort()
    {
        return $this->port;
    }

    public function setPort($port)
    {
        $this->port = $port;
    }

    public function getMailboxName()
    {
        return $this->mailboxName;
    }

    public function setMailboxName($mailboxName)
    {
        $this->mailboxName = $mailboxName;
    }

    public function setService($service = "imap")
    {
        $this->flags []= ConnectionFlags::CONNECTION_FLAG_SERVICE . $service;
    }

    public function setUser($user)
    {
        $this->flags []= ConnectionFlags::CONNECTION_FLAG_USER . $user;   
    }

    public function setAuthUser($authUser)
    {
        $this->flags []= ConnectionFlags::CONNECTION_FLAG_AUTHUSER . $authUser;   
    }

    public function setAnonymousUser()
    {
        $this->flags []= ConnectionFlags::CONNECTION_FLAG_ANONYMOUS;
    }

    public function setDebug()
    {
        $this->flags []= ConnectionFlags::CONNECTION_FLAG_DEBUG;
    }

    public function setSecure()
    {
        $this->flags []= ConnectionFlags::CONNECTION_FLAG_SECURE;   
    }

    public function setServiceImap()
    {
        $this->flags ['type']= ConnectionFlags::CONNECTION_FLAG_IMAP;
    }

    public function setServiceImap2()
    {
        $this->flags ['type']= ConnectionFlags::CONNECTION_FLAG_IMAP2;
    }

    public function setServiceImap2bis()
    {
        $this->flags ['type']= ConnectionFlags::CONNECTION_FLAG_IMAP2BIS;
    }

    public function setServiceImap4()
    {
        $this->flags ['type']= ConnectionFlags::CONNECTION_FLAG_IMAP4;
    }

    public function setServiceImap4rev1()
    {
        $this->flags ['type']= ConnectionFlags::CONNECTION_FLAG_IMAP4REV1;
    }

    public function setServicePop3()
    {
        $this->flags ['type']= ConnectionFlags::CONNECTION_FLAG_POP3;
    }

    public function setServiceNntp()
    {
        $this->flags ['type']= ConnectionFlags::CONNECTION_FLAG_NNTP;
    }

    public function setNoRsh()
    {
        $this->flags []= ConnectionFlags::CONNECTION_FLAG_NNTP;
    }

    public function setSsl()
    {
        $this->flags []= ConnectionFlags::CONNECTION_FLAG_SSL;
    }

    public function setValidateCert()
    {
        $this->flags []= ConnectionFlags::CONNECTION_FLAG_VALIDATE_CERT;
    }

    public function setNoValidateCert()
    {
        $this->flags []= ConnectionFlags::CONNECTION_FLAG_NOVALIDATE_CERT;
    }

    public function setTls()
    {
        $this->flags []= ConnectionFlags::CONNECTION_FLAG_TLS;
    }

    public function setNoTls()
    {
        $this->flags []= ConnectionFlags::CONNECTION_FLAG_NOTLS;
    }

    public function setReadOnly()
    {
        $this->flags []= ConnectionFlags::CONNECTION_FLAG_READONLY;
    }

    public function getConnectionFlagsString()
    {
        return implode($this->flags);

    }

    public function getConnectionString()
    {
        return '{'.$this->server.':'.$this->port.$this->getConnectionFlagsString().'}'.$this->mailboxName;
    }
}