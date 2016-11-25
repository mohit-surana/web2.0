// The Queue Constructor
function PriorityQueue()
{
	this.items = new Array();
}

// Add more methods. We use prototype to do this
PriorityQueue.prototype =
{
	// To get the first request
	// Get and remove
	get : function()
	{
		return this.items.shift();
	},

	// To add a request to the queue
	put : function(req)
	{
		this.items.push(req);
		this.prioritize();
	},

	size : function()
	{
		return this.items.length;
	},

	prioritize : function()
	{
		this.items.sort(function(req1, req2) {
			return (parseInt(req1.priority) - parseInt(req2.priority));
		})
	},

	peek : function(pos)
	{
		return this.items[pos];
	},

	remove : function(req)
	{
		found = false;
		for(var i = 0; i<this.size(); i++)
		{
			if(this.peek(i) == req)
			{
				this.items.splice(i, 1);
				found = true;
				break;
			}
		}
		return found;
	}
}
