<?php

namespace ImapManager\Exception;

/**
 * @codeCoverageIgnore
 */
class MailBoxDeleteException extends \Exception
{

    protected $code;
    protected $message;

    public function __construct($message)
    {
        $this->code = 103;
        $this->message  =  $message;

        parent::__construct($this->message, $this->code);
    }

    public function __toString() 
    {
        return __CLASS__ . ": [{$this->code}]: {$this->message}\n";
    }
}