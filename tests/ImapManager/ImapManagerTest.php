<?php

namespace ImapManager\Tests;

require_once __DIR__ . '/../../config/config_test.php';

use ImapManager\ImapManager;
use ImapManager\Exception;

class ImapManagerTest extends \PHPUnit_Framework_TestCase
{
    private $connectionStringMock;

    public function setUp()
    {
        $this->connectionStringMock = $this->getMock('ConnectionString', array('getConnectionString'));
        $this->connectionStringMock->expects($this->any())
                          ->method('getConnectionString')
                          ->will($this->returnValue('{imap.gmail.com:993/imap/ssl}INBOX'));

    }

    public function testWithWrongUserPasswordExecptionShouldBeThrown()
    {
        $this->setExpectedException('ImapManager\Exception\ConnectionException');

        $manager = new ImapManager($this->connectionStringMock, 'mail@gmail.com', 'efgh');

    }

    public function testWithRightUserPasswordNoExceptionShouldBeThrown()
    {

        $manager = new ImapManager($this->connectionStringMock, USER_EMAIL, USER_PASSWORD);
    }

    public function testManagerCanListMailBoxes()
    {
        $manager = new ImapManager($this->connectionStringMock, USER_EMAIL, USER_PASSWORD);

        $mailboxes = $manager->listAvailableMailboxes();

        $this->assertGreaterThan(0, count($mailboxes), 'Manager should have at least one mailbox');
    }
    /*
    public function testCanChangeMailbox()
    {
        $manager = new ImapManager($this->connectionStringMock, USER_EMAIL, USER_PASSWORD);
        
        $connectionStringMock = $this->getMock('ConnectionString', array('getConnectionString'));
        $connectionStringMock->expects($this->any())
                          ->method('getConnectionString')
                          ->will($this->returnValue('{imap.gmail.com:993/imap/ssl}ALL'));

        $manager->changeMailbox($connectionStringMock);
    }
    */
}