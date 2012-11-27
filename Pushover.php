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
 * @link https://pushover.net/api
 * @license BSD License
 */ 
 
class Pushover
{
	// api url
	const API_URL = 'https://api.pushover.net/1/messages.xml';
	
	/**
	 * Application API token
	 *
	 * @var string
	 */
	private $_token;
	
	/**
	 * User API token
	 *
	 * @var string
	 */
	private $_user;
	
	/**
	 * Turn on/off debug mode
	 *
	 * @var bool
	 */
	private $_debug = false;
	
	/**
	 * Title of the message
	 *
	 * @var string
	 */
	private $_title;
	
	/**
	 * The message itself (up to 512 characters)
	 *
	 * @var string
	 */
	private $_message;	
	
	/**
	 * Timestamp in Unix timestamp format
	 *
	 * @var int
	 */
	private $_timestamp;
	
	/**
	 * User's device (user specific)
	 *
	 * @var string
	 */
	private $_device;
	
	/**
	 * Priority of the message. Can be 0 or 1. High-priority messages override a user's "quiet hours" setting and will always be delivered any time they are received. High priority messages are highlighted in red in the Android and iOS clients.
	 *
	 * @var string
	 */
	private $_priority = 0;
	
	/**
	 * Include a Supplementary URL (up to 200 characters)
	 *
	 * @var string
	 */
	private $_url;
	
	/**
	 * Title of the included URL (up to 50 characters)
	 *
	 * @var string
	 */
	private $_url_title;
	
	
	
	
	/**
	 * Default constructor
	 */
	public function __construct () {		
    }

	/**
	 * Set API token
	 * 
	 * @param string $token Your app API key.
	 *
	 * @return void
	 */
    public function setToken ($token) {
        $this->_token = (string)$token;
    }

	/**
	 * Get API token
	 * 
	 * @return string
	 */
    public function getToken () {
        return $this->_token;
    }

	/**
	 * Set API user
	 * 
	 * @param string $user The user's API key.
	 *
	 * @return void
	 */
    public function setUser ($user) {
        $this->_user = (string)$user;
    }

	/**
	 * Get API user
	 * 
	 * @return string
	 */
    public function getUser () {
        return $this->_user;
    }

	/**
	 * Set message title
	 * 
	 * @param string $title Title of push notification.
	 *
	 * @return void
	 */
    public function setTitle ($title) {
        $this->_title = (string)$title;
    }

	/**
	 * Get message title
	 * 
	 * @return string
	 */
    public function getTitle () {
        return $this->_title;
    }

	/**
	 * Set message
	 * 
	 * @param string $msg Message of push notification.
	 *
	 * @return void
	 */
    public function setMessage ($msg) {
        $this->_message = (string)$msg;
    }

	/**
	 * Get message
	 * 
	 * @return string
	 */
    public function getMessage () {
        return $this->_message;
    }

	/**
	 * Set device
	 * 
	 * @param string $device Leave this empty if you want to send to all user's devices. This can be user specific!
	 *
	 * @return void
	 */
    public function setDevice ($device) {
        $this->_device = (string)$device;
    }

	/**
	 * Get device
	 * 
	 * @return string
	 */
    public function getDevice () {
        return $this->_device;
    }

	/**
	 * Set timestamp
	 *
	 * Messages are stored on the Pushover servers with a timestamp of when they were initially received through the API. This timestamp is sent to and shown on client devices, and messages are listed in order of these timestamps. In most cases, this default timestamp is acceptable. This is not for scheduling!
	 * 
	 * @param int $time dispaly time on device
	 *
	 * @return void
	 */
    public function setTimestamp ($time) {
        $this->_timestamp = (int)$time;
    }

	/**
	 * Get timestamp
	 * 
	 * @return int
	 */
    public function getTimestamp () {
        return $this->_timestamp;
    }

	/**
	 * Set priority (-1, 0 or 1)
	 *
	 * -1 Low priority notifications.
	 * 0  Default.
	 * 1 triggers a high-priority alert that always generates sound and vibration.
	 * 
	 * @param int $priority priority level.
	 *
	 * @return void
	 */
    public function setPriority ($priority) {
        $this->_priority = (int)$priority;
    }

	/**
	 * Get priority
	 * 
	 * @return int
	 */
    public function getPriority () {
        return $this->_priority;
    }

	/**
	 * Set url
	 * 
	 * @param string $url Add an url to your notification.
	 *
	 * @return void
	 */
    public function setUrl ($url) {
        $this->_url = (string)$url;
    }

	/**
	 * Get url
	 * 
	 * @return string
	 */
    public function getUrl () {
        return $this->_url;
    }

	/**
	 * Set url title
	 * 
	 * @param string $url_title A title if you want to show a text instead of the actual url.
	 *
	 * @return void
	 */
    public function setUrlTitle ($url_title) {
        $this->_url_title = (string)$url_title;
    }

	/**
	 * Get url title
	 * 
	 * @return string
	 */
    public function getUrlTitle () {
        return $this->_url_title;
    }

	/**
	 * Set debug mode
	 * 
	 * @param bool $debug Enable this to receive detailed input and output info.
	 *
	 * @return void
	 */
    public function setDebug ($debug) {
        $this->_debug = (boolean)$debug;
    }

	/**
	 * Get debug mode
	 * 
	 * @return bool
	 */
    public function getDebug () {
        return $this->_debug;
    }
	
	/**
	 * Send message to Pushover API
	 * 
	 * @return bool
	 */
	public function send() {
		if(!Empty($this->_token) && !Empty($this->_user) && !Empty($this->_message)) {
			if(!isset($this->_timestamp)) $this->setTimestamp(time());
			
			$c = curl_init();
			curl_setopt($c, CURLOPT_URL, self::API_URL);
			curl_setopt($c, CURLOPT_HEADER, false);
			/*
			if possible, set CURLOPT_SSL_VERIFYPEER to true..
			- http://www.tehuber.com/phps/cabundlegen.phps 
			*/
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