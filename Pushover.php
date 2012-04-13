<?php
// https://pushover.net/api
class Pushover
{
	private $_api_key_app;
	private $_api_key_user;
	private $_debug = false;
	
	private $_title;
	private $_message;	
	private $_timestamp;
	private $_device;
	private $_priority = 0;
	private $_url;
	private $_url_title;
	
	public function __construct ($api_key_app = null, $api_key_user = null, $title = null, $message = null) {		
		if(isset($api_key_app))	$this->setApiKeyApp($api_key_app);
		if(isset($api_key_user)) $this->setApiKeyUser($api_key_user);
		if(isset($title))	$this->setTitle($title);
		if(isset($message))	$this->setMessage($message);
    }

	// getters and setters
    public function setApiKeyApp ($key) {
        $this->_api_key_app = $key;
    }

    public function getApiKeyApp () {
        return $this->_api_key_app;
    }

    public function setApiKeyUser ($key) {
        $this->_api_key_user = $key;
    }

    public function getApiKeyUser () {
        return $this->_api_key_user;
    }

    public function setTitle ($title) {
        $this->_title = $title;
    }

    public function getTitle () {
        return $this->_title;
    }

    public function setMessage ($msg) {
        $this->_message = $msg;
    }

    public function getMessage () {
        return $this->_message;
    }

    public function setDevice ($device) {
        $this->_device = $device;
    }

    public function getDevice () {
        return $this->_device;
    }

    public function setTimestamp ($time) {
        $this->_timestamp = $time;
    }

    public function getTimestamp () {
        return $this->_timestamp;
    }

    public function setPriority ($priority) {
        $this->_priority = $priority;
    }

    public function getPriority () {
        return $this->_priority;
    }

    public function setUrl ($url) {
        $this->_url = $url;
    }

    public function getUrl () {
        return $this->_url;
    }

    public function setUrlTitle ($url_title) {
        $this->_url_title = $url_title;
    }

    public function getUrlTitle () {
        return $this->_url_title;
    }

    public function setDebug ($debug) {
        $this->_debug = $debug;
    }

    public function getDebug () {
        return $this->_debug;
    }
	
	
	public function send() {
		if(!Empty($this->_api_key_app) && !Empty($this->_api_key_user) && !Empty($this->_message)) {
			if(!isset($this->_timestamp)) $this->setTimestamp(time());
			
			$c = curl_init();
			curl_setopt($c, CURLOPT_URL, 'https://api.pushover.net/1/messages.xml');
			curl_setopt($c, CURLOPT_HEADER, false);
			curl_setopt($c, CURLOPT_SSL_VERIFYPEER, false);
			curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($c, CURLOPT_POSTFIELDS, array(
			  	'token' => $this->getApiKeyApp(),
			  	'user' => $this->getApiKeyUser(),
			  	'title' => $this->getTitle(),
			  	'message' => $this->getMessage(),
			  	'device' => $this->getDevice(),
			  	'priority' => $this->getPriority(),
			  	'timestamp' => $this->getTimestamp(),
			  	'url' => $this->getUrl(),
			  	'url_title' => $this->getUrlTitle()
			));
			
			$response = curl_exec($c);
			$xml = simplexml_load_string($response);
			
			if($this->getDebug()) {
				return array('output' => $xml, 'input' => $this);
			}
			else {
				return ($xml->status == 1) ? true : false;
			}
		}
	}
}
?>