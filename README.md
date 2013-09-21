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

<b>Methods Available</b>
<strong>balance()</strong>
<p>To check the available credits</p>
<strong>send_sms( $mobile_no, $message )</strong>
<p>To send sms on particular number</p>

