Note:

This implementation differs from what the question asks.
I have implemented using a single js, single php and chat-history file as it seems more intuitive.

All messages sent have a username along with the actual message.
This makes handling of the SSE very simple.

Send message:
	Clear the text box on success
Receive message:
	username;message
	Split and display

:)
