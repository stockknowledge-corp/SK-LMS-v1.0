<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

class Mailer {
    public $sender;
    public $senderName;

    public $host;
    public $username;
    public $password;
    public $port;

    function Send($recipient, $subject, $bodyHtml, $bodyText){

        $sender = $this->sender;
        $senderName = $this->senderName;
        $host = $this->host;
        $username = $this->username;
        $password = $this->password;
        $port = $this->port;

        $mail = new PHPMailer(true);

        try {                    
            $mail->isSMTP();         
            $mail->setFrom($sender, $senderName);                                   
            $mail->Host       = $host;
            $mail->SMTPAuth   = true;    
            $mail->Username   = $username;
            $mail->Password   = $password;         
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;       
            $mail->Port       = $port;            

            $mail->addAddress($recipient);

            $mail->isHTML(true);
            $mail->Subject    = $subject;
            $mail->Body       =  $bodyHtml;
            $mail->AltBody    =  $bodyText;
            $mail->Send();
        } catch (phpmailerException $e) {
            echo "An error occurred. {$e->errorMessage()}", PHP_EOL;
        } catch (Exception $e) {
            echo "Email not sent. {$mail->ErrorInfo}", PHP_EOL; 
        }


    }

}