bulksms-php
===========

BulkSMS service - php client

Version - 0.01

PHP implementation of BulkSMS Service - Client
Service Provider http://bulksms-service.com

<code>
    <?php
    
    include_once('BulkSMS.php');
    
    $args = array(
        "api_key"  => "abcdegf123",
        "senderId" => "TEST"
    );
    $sms = new BulkSMS( $args );
    
    echo $sms->balance();
    
    ?>
</code>

*Methods Available
** balance()
*** To check the available credits
** send_sms( $mobile_no, $message )
*** To send sms on particular number

