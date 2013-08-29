<?php
/**
 * @author Chris Schalenborgh <chris.s@kryap.com>
 * @version 0.1
 */ 
 
include('Pushover.php');

$push = new Pushover();
$push->setToken('app token goes here');
$push->setUser('user token goes here');

$push->setTitle('Hey Chris');
$push->setMessage('Hello world! ' .time());
$push->setUrl('http://chris.schalenborgh.be/blog/');
$push->setUrlTitle('cool php blog');

$push->setDevice('iPhone');
$push->setPriority(2);
$push->setRetry(60); //Used with Priority = 2; Pushover will resend the notification every 60 seconds until the user accepts.
$push->setExpire(3600); //Used with Priority = 2; Pushover will resend the notification every 60 seconds for 3600 seconds. After that point, it stops sending notifications.
$push->setTimestamp(time());
$push->setDebug(true);

$go = $push->send();

echo '<pre>';
print_r($go);
echo '</pre>';
?>