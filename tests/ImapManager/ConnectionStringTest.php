<?php

namespace ImapManager\Tests;

use ImapManager\ConnectionString;
use ImapManager\Exception;

class ConnectionStringTest extends \PHPUnit_Framework_TestCase
{
    private $connectionString;
    
    public function setUp()
    {
        $this->connectionString = new ConnectionString("imap.gmail.com");
    }

    public function testDefaultConstructorPortShouldBe993()
    {
        $this->assertEquals(993, $this->connectionString->getPort());
    }

    public function testDefaultConstructorMailboxNameShouldBeInbox()
    {
        $this->assertEquals("INBOX", $this->connectionString->getMailboxName());
    }

    public function testConnectionsFlagsStringShouldBeWellFormed()
    {
        $this->connectionString->setSsl();
        $this->connectionString->setTls();
        $this->connectionString->setValidateCert();

        $this->assertEquals("/ssl/tls/validate-cert", $this->connectionString->getConnectionFlagsString());
    }

    public function testConnectionsFlagsServicesShouldOverwriteExistentFlagServices()
    {
        $this->connectionString->setServicePop3();
        $this->assertEquals("/pop3", $this->connectionString->getConnectionFlagsString());

        $this->connectionString->setServiceNntp();
        $this->assertEquals("/nntp", $this->connectionString->getConnectionFlagsString());

        $this->connectionString->setServiceImap();
        $this->assertEquals("/imap", $this->connectionString->getConnectionFlagsString());

        $this->connectionString->setServiceImap2();
        $this->assertEquals("/imap2", $this->connectionString->getConnectionFlagsString());

        $this->connectionString->setServiceImap2bis();
        $this->assertEquals("/imap2bis", $this->connectionString->getConnectionFlagsString());

        $this->connectionString->setServiceImap4();
        $this->assertEquals("/imap4", $this->connectionString->getConnectionFlagsString());

        $this->connectionString->setServiceImap4rev1();
        $this->assertEquals("/imap4rev1", $this->connectionString->getConnectionFlagsString());
    }

}