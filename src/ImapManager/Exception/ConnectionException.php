<?php

namespace ImapManager\Exception;

class ConnectionException extends \Exception
{

    protected $code;
    protected $message;

    public function __construct($message)
    {
        $this->code = 101;
        $this->message  = "Could not connect: " . $message;

        parent::__construct($this->message, $this->code);
    }

    public function __toString() 
    {
        return __CLASS__ . ": [{$this->code}]: {$this->message}\n";
    }
}