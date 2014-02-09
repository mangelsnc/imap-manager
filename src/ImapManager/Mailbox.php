<?php

namespace ImapManager;

use ImapManager\Exception as MailBoxException;

class MailBox
{
    private $imapStream;
    private $name;
    private $date;
    private $driver;
    private $messages;
    private $recent;
    private $unread;
    private $deleted;
    private $size;

    public function __construct($imapStream)
    {
        $data = imap_mailboxmsginfo($imapStream);

        $this->imapStream = $imapStream;
        $this->name = $data->Mailbox;
        $this->date = new \DateTime($data->Date);
        $this->driver = $data->Driver;
        $this->messages = $data->Nmsgs;
        $this->recent = $data->Recent;
        $this->unread = $data->Unread;
        $this->deleted = $data->Deleted;
        $this->size = $data->Size;
    }

    public function getName()
    {
        return imap_utf7_decode($this->name);
    }

    public function getDate()
    {
        return $this->date;
    }

    public function getDriver()
    {
        return $this->driver;
    }

    public function getTotalMessages()
    {
        return $this->messages;
    }

    public function getRecent()
    {
        return $this->recent;
    }

    public function getUnread()
    {
        return $this->unread;
    }

    public function getDeleted()
    {
        return $this->deleted;
    }

    public function getSize()
    {
        return $this->size;
    }

    public static function create($manager, $name)
    {
        $connectionString = substr($manager->getConnectionString(), 0, strrpos($manager->getConnectionString(), '}') + 1);
        $mailboxName = $connectionString . imap_utf7_encode($name);
        
        if(imap_createmailbox($manager->getImapStream(), $mailboxName)) {
            
            return true;
        } else {
            throw new MailBoxException\MailBoxCreateException(imap_last_error());
        }

    }

    public static function delete($manager, $name)
    {
        $connectionString = substr($manager->getConnectionString(), 0, strrpos($manager->getConnectionString(), '}') + 1);
        $mailboxName = $connectionString . imap_utf7_encode($name);
        
        if(imap_deletemailbox($manager->getImapStream(), $mailboxName)) {
            
            return true;
        } else {
            throw new MailBoxException\MailBoxDeleteException(imap_last_error());
        }

    }

    public function rename($name)
    {
        return imap_renamemailbox($this->imapStream, $this->getName(), imap_utf7_encode($name));
    }
}