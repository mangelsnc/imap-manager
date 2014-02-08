<?php

namespace ImapManager;

class MailBox
{
    private $name;
    private $delimiter;
    private $attributes;

    public function __construct($mailbox = null)
    {
        if($mailbox) {
            $this->name = imap_utf7_decode($mailbox->name);
            $this->delimiter = $mailbox->delimiter;
            $this->attributes = $mailbox->attributes;
        }
    }

    public function setName($name)
    {
        $this->name = imap_utf7_encode($name);

        return $this;
    }

    public function getName()
    {
        return imap_utf7_decode($this->name);
    }

    public function setDelimiter($delimiter)
    {
        $this->delimiter = $delimiter;

        return $this;
    }

    public function getDelimiter()
    {
        return $this->delimiter;
    }

    public function setAttributes($attributes)
    {
        $this->attributes = $attributes;

        return $this;
    }

    public function getAttributes()
    {
        return $this->attributes;
    }

    public static function create($manager, $name)
    {
        $connectionString = substr($manager->getConnectionString(), 0, strrpos($manager->getConnectionString(), '}') + 1);
        $mailboxName = $connectionString . imap_utf7_encode($name);
        
        return imap_createmailbox($manager->getImapStream(), $mailboxName);
    }
}