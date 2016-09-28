obj =
{
	/*
		The function to monitor the server's file.
		The one that will be updated by the other client.
		This is going to be perpetual. We will use the EventSource() HTML5 feature to do the job
		Remember that EventSource() automatically reconnects if the server shuts down the script.
	*/

	monitorChat	:	function() {
		var e = new EventSource('monitorchat.php');

		// register the handler, event will be called
		e.addEventListener('chatmsg', obj.updateWin);
	},

	updateWin	:	function(event) {
		// We got a new messaeg from the server
		// (The other guy typed and sent something and the server has passed it back to us)
		// Update the chat window
		newdiv = document.createElement("div");
		newdiv.innerHTML = "<strong>Friend:</strong> " + event.data;

		// Append it to the main chat window (which is #innertop)
		document.getElementById("innertop").appendChild(newdiv);
	},

	checkSend	:	function() {
		// This function is called onkeyup inside the message typing area
		// We need to check if the ENTER key was pressed. If so, we have to send
		if(event.keyCode == 13) // For enter key
		{
			// See if the checkbox is ticked
			chk = document.getElementById("enterToSend");
			if(chk.checked && event.shiftKey == false)
			{
				obj.sendToServer();
				event.preventDefault();
			}
		}
	},

	sendToServer:	function()
	{
		var msg = document.getElementById("message");
		if(msg.value != "")
		{
			// Make use of JQUERY
			$.post("savemsg.php", {'msg': msg.value}, obj.updateChat);
		}
	},

	// This function will fire when the server confirms having received the message
	// We will then update the chat window
	updateChat	:	function(status)
	{
		var msg = document.getElementById("message");
		if(status == "success")
		{
			newdiv = document.createElement("div");
			newdiv.innerHTML = "<strong>Me:</strong> " + msg.value;
			msg.value = "";
			// Append it to the main chat window (which is #innertop)
			document.getElementById("innertop").appendChild(newdiv);
		}
	}
};


obj.monitorChat();
