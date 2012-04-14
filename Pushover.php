<?php
/**
 * php-pushover
 *
 * PHP service wrapper for the pushover.net API: https://pushover.net/api
 * 
 * @author Chris Schalenborgh <chris.s@kryap.com>
 * @version 0.1
 * @package php-pushover	
 * @example test.php
 */ 
 
class Pushover
{
	private $_token;
	private $_user;
	private $_debug = false;
	
	private $_title;
	private $_message;	
	private $_timestamp;
	private $_device;
	private $_priority = 0;
	private $_url;
	private $_url_title;
	
	public function __construct ($token = null, $user = null, $title = null, $message = null) {		
		if(isset($token))	$this->setToken($token);
		if(isset($user)) $this->setuser($user);
		if(isset($title))	$this->setTitle($title);
		if(isset($message))	$this->setMessage($message);
    }

	// getters and setters
    public function setToken ($token) {
        $this->_token = $token;
    }

    public function getToken () {
        return $this->_token;
    }

    public function setUser ($user) {
        $this->_user = $user;
    }

    public function getUser () {
        return $this->_user;
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
		if(!Empty($this->_token) && !Empty($this->_user) && !Empty($this->_message)) {
			if(!isset($this->_timestamp)) $this->setTimestamp(time());
			
			$c = curl_init();
			curl_setopt($c, CURLOPT_URL, 'https://api.pushover.net/1/messages.xml');
			curl_setopt($c, CURLOPT_HEADER, false);
			curl_setopt($c, CURLOPT_SSL_VERIFYPEER, false);
			curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($c, CURLOPT_POSTFIELDS, array(
			  	'token' => $this->getToken(),
			  	'user' => $this->getUser(),
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