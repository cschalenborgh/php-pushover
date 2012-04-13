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
$push->setPriority(1);
$push->setTimestamp(time());
$push->setDebug(true);

$go = $push->send();

echo '<pre>';
print_r($go);
echo '</pre>';
?>