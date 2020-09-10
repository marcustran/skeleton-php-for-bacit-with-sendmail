<?php 
    ini_set( 'display_errors', 1 );
    error_reporting( E_ALL );
    $from = "test@gmail.com";
    $to = "uia.community@gmail.com";
    $subject = "PHP Mail Test script";
    $message = "This is a test to check the PHP Mail functionality";
    //$headers = "From:" . $from;
    $headers = 'From:' . $from . "\r\n" .
    'Reply-To: uia.community@gmail.com' . "\r\n" .
    'X-Mailer: PHP/' . phpversion();
    mail($to,$subject,$message, $headers);
    echo "Test email sent with exp headers";
?>
