<?php

namespace ImapManager\Tests;

use ImapManager\Mailbox;
use ImapManager\Exception;

class MailboxTest extends \PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        $this->mailbox = new Mailbox("imap.gmail.com");
    }

    public function testDefaultConstructorPortShouldBe993()
    {
        $this->assertEquals(993, $this->mailbox->getPort());
    }

    public function testDefaultConstructorMailboxNameShouldBeInbox()
    {
        $this->assertEquals("INBOX", $this->mailbox->getMailboxName());
    }

    public function testConnectionsFlagsStringShouldBeWellFormed()
    {
        $this->mailbox->setSsl();
        $this->mailbox->setTls();
        $this->mailbox->setValidateCert();

        $this->assertEquals("/ssl/tls/validate-cert", $this->mailbox->getConnectionFlagsString());
    }

    public function testConnectionsFlagsServicesShouldOverwriteExistentFlagServices()
    {
        $this->mailbox->setServicePop3();
        $this->assertEquals("/pop3", $this->mailbox->getConnectionFlagsString());

        $this->mailbox->setServiceNntp();
        $this->assertEquals("/nntp", $this->mailbox->getConnectionFlagsString());

        $this->mailbox->setServiceImap();
        $this->assertEquals("/imap", $this->mailbox->getConnectionFlagsString());

        $this->mailbox->setServiceImap2();
        $this->assertEquals("/imap2", $this->mailbox->getConnectionFlagsString());

        $this->mailbox->setServiceImap2bis();
        $this->assertEquals("/imap2bis", $this->mailbox->getConnectionFlagsString());

        $this->mailbox->setServiceImap4();
        $this->assertEquals("/imap4", $this->mailbox->getConnectionFlagsString());

        $this->mailbox->setServiceImap4rev1();
        $this->assertEquals("/imap4rev1", $this->mailbox->getConnectionFlagsString());
    }

}