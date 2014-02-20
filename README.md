## About
> Pushover is the ideal application for sending (free) push notifications to iOS and Android devices, using this very simple API.

## php-pushover class
> php-pushover class is a PHP wrapper class for using the Pushover (https://pushover.net) REST API. Have a look at their API docs (https://pushover.net/api) for more information about all the parameters.

## Methods

* setToken
> Your app API key.

* setUser
> The user's API key.

* setTitle
> Set title of push notification.

* setMessage
> Set message of push notification.

* setUrl
> Add an url to your notification.

* setUrlTitle
> Set a title if you want to show a text instead of the actual url.

* setDevice
> Leave this empty if you want to send to all user's devices. This can be user specific!

* setPriority
> Default = 0, if 1 the user's quiet hours will be ignored + messages displayed in red. If 2, the same behaviour as 1 applies; but the message will repeat until the user acknowledges it.

* setExpire
> The expire parameter is only used when the Priority is set to 2 (or emergency-priority), and specifies how many seconds your notification will continue to be retried for. (Max Value = 86400)

* setRetry
> The Retry parameter is only used when the Priority is set to 2 (or emergency-priority), and specifies how often (in seconds) the Pushover servers will send the same notification to the user. (Min Value = 30)

* setCallback
> The callback parameter must be a URL (HTTP or HTTPS) that is reachable from the Internet that our servers will call out to as soon as the notification has been acknowledged.

* setTimestamp
> Messages are stored on the Pushover servers with a timestamp of when they were initially received through the API. This timestamp is sent to and shown on client devices, and messages are listed in order of these timestamps. In most cases, this default timestamp is acceptable. This is not for scheduling!

* setDebug
> Enable this to receive detailed input and output info.

* send
> Send the message to the API