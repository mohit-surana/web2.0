obj =
{
	username	:	"Anonymous",
	monitorChat	:	function() {
		var e = new EventSource('monitorchat.php');

		// register the handler, event will be called
		e.addEventListener('chatmsg', obj.updateWin);
	},

	updateWin	:	function(event) {
		var index = event.data.indexOf(";");
		var user = event.data.substring(0, index);
		var message = event.data.substring(index+1);

		newdiv = document.createElement("div");

		newdiv.innerHTML = "<strong>" + user + ":</strong> " + message;
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
			var raw_message = msg.value;
			raw_message = raw_message.split("\n").join("<br/>");
			$.post("savemsg.php", {'username': obj.username, 'msg': raw_message}, obj.updateChat);
		}
	},

	updateChat	:	function(status)
	{
		var msg = document.getElementById("message");
		if(status == "success")
		{
			msg.value = "";
		}
		else
		{
			alert("Sorry but your message could not be delivered!");
		}
	},

	setUser		: 	function()
	{
		obj.username = prompt("Hey! What's your name?");
		if(!obj.username)
		{
			obj.username = "Anonymous";
		}
		document.getElementById("username").innerHTML = "Hi, " + obj.username;
	}
};

obj.monitorChat();
