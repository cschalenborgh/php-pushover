<?php
include('Pushover.php');

$push = new Pushover();
$push->setApiKeyApp();
$push->setApiKeyUser();

$push->setTitle('Hey Chris');
$push->setMessage('Hello world! ' .time());
$push->setUrl('https://www.pushover.net');
$push->setUrlTitle('click here');

$push->setDevice('iPhone');
$push->setPriority(1);
$push->setTimestamp(time());
$push->setDebug(true);

$go = $push->send();

echo '<pre>';
print_r($go);
echo '</pre>';
?>