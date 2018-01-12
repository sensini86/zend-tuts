<?php
namespace Application\ValueObject;

/**
 * The Email message value object
 * Class EmailMessage
 * @package Application\ValueObject
 */
class EmailMessage
{
    private $recipient;
    private $subject;
    private $text;

    public function __construct($recipient, $subject, $text)
    {
        $this->recipient    = $recipient;
        $this->subject      = $subject;
        $this->text         = $text;
    }

    /**
     * @return mixed
     */
    public function getRecipient()
    {
        return $this->recipient;
    }

    /**
     * @return mixed
     */
    public function getSubject()
    {
        return $this->subject;
    }

    /**
     * @return mixed
     */
    public function getText()
    {
        return $this->text;
    }


}