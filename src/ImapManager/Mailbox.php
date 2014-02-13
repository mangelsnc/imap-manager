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

    public function __construct($imapStream)
    {
        $data = imap_check($imapStream);

        $this->imapStream = $imapStream;
        $this->name = $data->Mailbox;
        $this->date = new \DateTime($data->Date);
        $this->driver = $data->Driver;
        $this->messages = $data->Nmsgs;
        $this->recent = $data->Recent;

        $info = imap_status($imapStream, $this->name, SA_UNSEEN);
        $this->unread = $info->unseen;
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

    public static function create($manager, $name)
    {
        $prefix = self::getMailBoxPrefix($manager->getConnectionString());
        $mailboxName = $prefix . imap_utf7_encode($name);
        
        if(@imap_createmailbox($manager->getImapStream(), $mailboxName)) {
            
            return true;
        } else {
            throw new MailBoxException\MailBoxCreateException(imap_last_error());
        }
    }

    private function getMailBoxPrefix($connectionString)
    {
        return substr($connectionString, 0, strrpos($connectionString, '}') + 1);
    }

    public static function delete($manager, $name)
    {
        $prefix = self::getMailBoxPrefix($manager->getConnectionString());
        $mailboxName = $prefix . imap_utf7_encode($name);
        
        if(@imap_deletemailbox($manager->getImapStream(), $mailboxName)) {
            
            return true;
        } else {
            throw new MailBoxException\MailBoxDeleteException(imap_last_error());
        }
    }

    public function rename($manager, $name)
    {
        $prefix = $this->getMailBoxPrefix($manager->getConnectionString());
        $mailboxName = $prefix . imap_utf7_encode($name);

        return @imap_renamemailbox($this->imapStream, $this->getName(), $mailboxName);
    }

    public static function find($manager, $pattern)
    {
        $result = @imap_listscan(
            $manager->getImapStream(), 
            $manager->getConnectionString(),
            '*',
            $pattern
        );

        if(false === $result) {
            throw new MailBoxException\ScanNotValidException(imap_last_error());
        }

        if(count($result) == 0) {
            return false;
        }

        return $result;
    }
}