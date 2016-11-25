RequestManager = function()
{
	manager = {
		active : new Array(),
		pending : new PriorityQueue(),
		MAX_INTERVAL : 200,
		MAX_AGE : 5000,

		sendToPendingQueue : function(req)
		{
			manager.pending.put(req);
		},

		// This is the function that moves a request from the pending queue to the active queue.
		// When a request gets into the active queue, we call the "send()" on it so that it can contact the server.
		// We make sure the active queue is 2 reqs long (or less)
		// Call this every 200ms. We try to move one from Pending to Active Queue
		sendToServer : function()
		{
			if(manager.active.length < 2)
			{
				// Get a request from the pending queue
				curr_req = manager.pending.get();
				if(curr_req)
				{
					manager.active.push(curr_req);

					curr_req.xhr = new XMLHttpRequest();
					curr_req.xhr.onreadystatechange = manager.processResponse;
					curr_req.xhr.open(curr_req.method, curr_req.url, true);
					curr_req.xhr.send(curr_req.data);
				}
			}
		},

		// The callback when a response is received from the server for one of the calls
		// Since all xhrs have registered the same callback, we need some way to find out which request finished.
		// We can accomplish this with an anonymous function callback... or we can do this..
		processResponse : function()
		{
			for(var j = 0; j<2; ++j)
			{
				nextreq = manager.active[j];
				if(nextreq)
				{
					if(nextreq.xhr.readyState == 4)
					{
						if(nextreq.xhr.status == 200)
						{
							formatOutput(nextreq, "blue");
						}
						else
						{
							// We assume something went wrong.
							formatOutput(nextreq, "req");
						}
						manager.active.splice(j, 1);
					}
				}
			}
		},

		// Very basic version of promoting a request based on age
		agePromote : function()
		{
			for(var k = 0; k<manager.pending.size(); ++k)
			{
				req = manager.pending.peek(k);
				if(req)
				{
					req.age += manager.MAX_INTERVAL;
					if(req.age > manager.MAX_AGE)
					{
						if(req.priority > 0)
							req.priority--;
						req.age = 0;
					}
				}
			}
			manager.pending.prioritize();
		}
	};

	setInterval(manager.agePromote, manager.MAX_INTERVAL);
	setInterval(manager.sendToServer, manager.MAX_INTERVAL);

	return manager;
}();

function formatOutput(myreq, color)
{
	div = document.createElement("div");
	div.style.color = color;
	div.style.fontSize = "24px";
	div.innerHTML = myreq.url + "&nbsp;" + myreq.method + "&nbsp;" + myreq.priority + "&nbsp;" + myreq.xhr.status + "&nbsp;" + myreq.age;

	document.body.appendChild(div);
}
