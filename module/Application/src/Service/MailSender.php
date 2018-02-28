<?php
/**
 * Created by PhpStorm.
 * User: arivasoft2
 * Date: 2/28/2018
 * Time: 10:56 AM
 */

namespace Application\Service;

use Zend\Mail;
use Zend\Mail\Message;
use Zend\Mail\Transport\Sendmail;

class MailSender
{
    // Sends the mail message.
    public function sendMail($sender, $recipient, $subject, $text)
    {
        $result = false;
        try {

            // Create E-mail message
            $mail = new Message();
            $mail->setFrom($sender);
            $mail->addTo($recipient);
            $mail->setSubject($subject);
            $mail->setBody($text);



            // Send E-mail message
            $transport = new Sendmail('-f'.$sender);
            $transport->send($mail);
            $result = true;
        } catch(\Exception $e) {
            $result = false;
        }

//        var_dump($result);
//        die('ww');
        // Return status
        return $result;
    }
}