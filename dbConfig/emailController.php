<?php
require_once 'vendor/autoload.php';
require_once 'config/const.php';

// Create the Transport
$transport = (new Swift_SmtpTransport('smtp.gmail.com', 465,'ssl'))
  ->setUsername(EMAIL)
  ->setPassword(PASSWORD);

// Create the Mailer using your created Transport
$mailer = new Swift_Mailer($transport);



 function sendToken($email,$token){
     global $mailer;
     $body ='<div class="card bg-light mt-5">
     <p>Use the token below to login</p>
     <h1 class="text-success text-center">'.$token.'</h1>              
 </div>';
    // Create a message
    $message = (new Swift_Message('Token for Login'))
    ->setFrom(EMAIL)
    ->setTo($email)
    ->setBody($body,'text/html');

    // Send the message
    $result = $mailer->send($message);
}

?>
