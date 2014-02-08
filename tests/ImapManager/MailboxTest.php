<?php

namespace ImapManager\Tests;

require_once __DIR__ . '/../../config/config_test.php';

use ImapManager\ImapManager;
use ImapManager\MailBox;
use ImapManager\ConnectionString;
use ImapManager\Exception;

class MailBoxTest extends \PHPUnit_Framework_TestCase
{
    private $connectionStringMock;
    private $manager;

    public function setUp()
    {
        $this->connectionStringMock = $this->getMock('ConnectionString', array('getConnectionString'));
        $this->connectionStringMock->expects($this->any())
                          ->method('getConnectionString')
                          ->will($this->returnValue('{imap.gmail.com:993/imap/ssl}INBOX'));

        $this->manager = new ImapManager($this->connectionStringMock, USER_EMAIL, USER_PASSWORD);
    }

    public function testCanCreateANewMailbox()
    {
        $this->assertTrue(
                MailBox::create($this->manager, 'TestImapManager'), 
                imap_last_error()
        );
    }

    public function testCanRenameExistentMailbox()
    {
        
    }
}