obj =
{
	monitorchat: function()
	{
		//Create an event source and use it
		var ev = new EventSource("http://localhost/monitor.php");
		
		ev.addEventListener("chatmsg", obj.updateChat);
	
		//Add an event for error also. This will fire
		// when the server force-closes the request
		ev.onerror = obj.reconnect;
	
	},
	
	//Handler to update our window with the message sent by the
	// other party
	updateChat: function(event)
	{
			newdiv = document.createElement("div");
			newdiv.innerHTML = "<strong>Friend:</strong>" + event.data;
			document.getElementById("innertop").appendChild(newdiv);
	},
	
	//Just to get an indication when the eventsource reconnects.
	reconnect: function()
	{
		jstat = $("#recon");
		jstat.css({'display':'block'});
		jstat.fadeOut(2000);
	},
	
	
	checkSend: function(event)
	{
		//Function that is called when the key goes up.
		// We check if it is the ENTER key.
		// If so, we check if we actually need to "SEND ON ENTER".
		// If both cases match, we make an AJAX call to the server
		// and save it. On receiving confirmation, we update our
		// own chat window

		msg = document.getElementById("msg");
		if(event.keyCode == 13)
		{
			//ENTER key was pressed
			//check if the checkbox was selected
			chkbox = document.getElementById("ent");
			if(chkbox.checked)
			{
				//send to server
				obj.sendToServer();
			}
		}
	},
	
	//Function that connects to server to save into datastore
	// That datastore will be monitored by the other client for updates
	sendToServer: function()
	{
		if(msg.value == "")
		{
			return;
		}
		else
		{
			//Use JQUERY to send to server
			msgobj = { msg: msg.value};
			$.post("http://localhost/savetodb.php", msgobj, obj.updateWin);
			
			//The correct call to use is $.ajax() because we can trap
			// errors too. In our case, we more or less sure that
			// we will succeed in saving our message
		}
	},
	
	updateWin: function(stat)
	{
		if(stat != "")
		{
			//Server will send the message back which we will re-use
			// to avoid side-effects if user keeps typing while the
			// AJAX call is onn.
			div = document.createElement("div");
			div.innerHTML = "<strong>Me:</strong>" + stat;
			document.getElementById("innertop").appendChild(div);
			
			//Clear the textbox
			msg.value = "";
		}
	}

}