<?php

/**
 * File for PHP Mail as an Email Manager
 */

namespace Cayman\Manager\EmailManager;

use Cayman\Manager;
use Cayman\Manager\EmailManager;

/**
 * Class for PHP Mail as an Email Manager
 *
 */
class PhpMail extends Manager implements EmailManager
{
    /**
     * Prepare recipients
     * @param array $list
     * @return string
     */
    private function prepareRecipients(array $list)
    {
        /*
        user@example.com
        user@example.com, anotheruser@example.com
        User <user@example.com>
        User <user@example.com>, Another User <anotheruser@example.com> 
        */
        $result = '"'. implode('", "', $list) . '"';
        
        return $result;
    }
    
    /**
     * Send email
     * @param Email $email
     */
    function emailSend(Email $email)
    {
        $nl = "\r\n";
        
        $toList  = $this->prepareRecipients($email->to);
        $message = wordwrap($email->message, 70, $nl);
        
        $headers = [];
        
        // To send HTML mail, the Content-type header must be set
        $headers[] = 'MIME-Version: 1.0';
        $headers[] = 'Content-type: text/html; charset=utf-8';
        if ($email->from) {
            $headers[] = 'From: ' . $this->prepareRecipients([$email->from]);
        }
        if ($email->reply_to) {
            $headers[] = 'Reply-To: ' . $this->prepareRecipients([$email->reply_to]);
        }
        if ($email->cc) {
            $headers[] = 'Cc: ' . $this->prepareRecipients($email->cc);
        }
        if ($email->bcc) {
            $headers[] = 'Bcc: ' . $this->prepareRecipients($email->bcc);
        }
        $headers[] = 'X-Mailer: PHP/' . phpversion();
        $headerLines = implode($nl, $headers);
        
        $result = mail($toList, $email->subject, $message, $headerLines);
        
        return $result;
    }
}
