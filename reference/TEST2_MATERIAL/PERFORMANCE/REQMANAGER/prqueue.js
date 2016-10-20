function PriorityQueue()
{
	this.items = new Array();
}

PriorityQueue.prototype = 
{
	get: function()
	{
		return this.items.shift();
	},
	
	put: function(req)
	{
		this.items.push(req);
		this.prioritize();
	},
	
	prioritize: function()
	{
		this.items.sort(function(req1, req2)
				{
					return(parseInt(req1.priority) - parseInt(req2.priority));
				});
	},
	
	size: function()
	{
		return this.items.length;
	},
	
	remove: function(req)
	{
		for(i=0;i<this.size(); i++)
		{
			if(req == this.items[i])
			{
				this.items.splice(i,1);
				return true;
			}
		}
		return false;
	},
	
	peek: function(pos)
	{
		return this.items[pos];
	}	
}