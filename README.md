## php-pushover class
> PHP service wrapper for the pushover.net API: https://pushover.net/api . Have a look at their well documented API docs for more information about all the parameters.

## About
> php-pushover class is a PHP wrapper class for using this Pushover (https://pushover.net) REST API

## Methods

* setToken
> Your app API key.

* setUser
> The user's API key.

* setTitle
> Set title of push notification.

* setMessage
> Set message of push notification.

# setUrl
> Add an url to your notification.

# setUrlTitle
> Set a title if you want to show a text instead of the actual url.

# setDevice
> Leave this empty if you want to send to all user's devices. This can be user specific!

# setPriority
> Default = 0, if 1 the user's quiet hours will be ignored + messages displayed in red.

# setTimestamp
> Messages are stored on the Pushover servers with a timestamp of when they were initially received through the API. This timestamp is sent to and shown on client devices, and messages are listed in order of these timestamps. In most cases, this default timestamp is acceptable. This is not for scheduling!

# setDebug
> Enable this to receive detailed input and output info.

# send
> Send the message to the API