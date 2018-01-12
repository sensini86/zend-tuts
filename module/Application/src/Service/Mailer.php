<?php
namespace Application\Service;


class Mailer
{
    public function sendMail($message)
    {
        if (!mail($message->getRecipient(), $message->getSubject(), $message->getText()))
        {
            // error sending message
            return false;
        }

        return true;
    }
}