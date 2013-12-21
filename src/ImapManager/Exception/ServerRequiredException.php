<?php

namespace ImapManager\Exception;

class ServerRequiredException extends \Exception
{

    protected $code;
    protected $message;

    public function __construct()
    {
        $this->code = 100;
        $this->message  = "Server is required";

        parent::__construct($this->message, $this->code);
    }

    public function __toString() 
    {
        return __CLASS__ . ": [{$this->code}]: {$this->message}\n";
    }
}