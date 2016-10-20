ReqManager = (function()
{
	manager = 
	{
		active: new Array(),
		
		pending: new PriorityQueue(),
		
		MAX_INTERVAL: 500,
		
		MAX_AGE: 5000,
		
		sendToServer: function()
		{
			if(manager.active.length < 2)
			{
				pendreq = manager.pending.get();
				
				if(pendreq)
				{
					pendreq.xhr = new XMLHttpRequest();
					
					pendreq.xhr.onreadystatechange = manager.processResponse;
					
					pendreq.xhr.open(pendreq.method, pendreq.url, true);
					
					pendreq.xhr.send(pendreq.data);
					
					manager.active.push(pendreq);
				
				}
				//else, our queue is full and we wait till we get a response.
			}
		},
		
		sendToPendingQueue(req)
		{
			manager.pending.put(req);
		},
		
		processResponse: function()
		{
			//We know that one of the requests has comeback. We don't know which.
			for(j=0;j< manager.active.length;j++)
			{
				curreq = manager.active[j];
				if(curreq.xhr.readyState == 4)
				{
					if(curreq.xhr.status == 200)
					{
						formatOutput(curreq, "blue");
					}
					else
					{
						//for now we assume something went wrong..
						formatOutput(curreq, "red");
					}
					
					manager.active.splice(j,1);
	
				}
			}
		},
		
		agePromote: function()
		{
			for(k=0;k< manager.pending.size(); k++)
			{
				onereq = manager.pending.peek(k);
				
				if(onereq)
				{
					onereq.age += manager.MAX_INTERVAL;
					if(onereq.age >= manager.MAX_AGE)
					{
						onereq.age = 0;
						onereq.priority--;
						manager.pending.prioritize();
					}
				}
			}
		},
		
		cancelReq: function(request)
		{
		
		
		
		}
	}
	setInterval(manager.agePromote, manager.MAX_INTERVAL);
	setInterval(manager.sendToServer, manager.MAX_INTERVAL);
	
	return manager;
})();

function formatOutput(obj, color)
{
	div = document.createElement("div");
	div.innerHTML = obj.url + "&nbsp;&nbsp;" + obj.method + "&nbsp;&nbsp;" + obj.age + "&nbsp;&nbsp;" + obj.xhr.status + "&nbsp;&nbsp;" + obj.priority;
	
	div.style.color = color;
	div.style.fontSize = "30px";
	
	document.body.appendChild(div);

}