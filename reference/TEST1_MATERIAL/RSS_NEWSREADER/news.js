//Each news item is an object with innerHTML and href
function NewsFeedItem(href,title)
{
	this.anchor = document.createElement("a");

	this.anchor.href = href;
	this.anchor.innerHTML = title;

}

//The Main Class
function NewsFeed()
{
	//Create an array to hold all headlines
	this.feeds = new Array();
	
	//XHR for AJAX requests
	this.xhr = new XMLHttpRequest();
	
	//Store "this" because setTimeout() will mess with "this".
	othis = this;
	
	//two timers. One for the scroll and one for the periodic refresh
	this.scrTimer = null;
	this.fetchTimer = null;
	
	//Get the inner div. All anchors will be added inside it.
	this.div = document.getElementById("inner");
	
	//Position the div at the right end of the screen. We will scroll 
	// left
	
	this.div.style.left = window.innerWidth - 5 + "px";
	
	//If we move the mouse over the news, it should stop scrolling
	// Once we move the mouse out, the scrolling resumes
	
	this.div.onmouseover = this.stopScroll;
	this.div.onmouseout = this.scroll;
	
	//Start scrolling
	this.scroll();
	
	//Now visit the server for the RSS feed. Every 30 mins...
	this.getFeeds();

}
//Function for the periodic refresh
NewsFeed.prototype.getFeeds = function()
{
	this.xhr.onreadystatechange = this.showNews;
	
	this.xhr.open("GET", "http://localhost/getnews.php", true);

	this.xhr.send();

	//You need to call this function every 30 mins. I am skipping this part
}

NewsFeed.prototype.showNews = function()
{
	if(this.readyState == 4 && this.status == 200)
	{
		//We got the feed. Get the root node (the <rss> node)
		var root = this.responseXML.documentElement;
		
		//We need to get the <item> nodes. Thats where the headlines are present
		items = root.getElementsByTagName("item");
		
		//Clear the "PLEASE STANDBY.." string from the screen
		othis.div.innerHTML = "";
		
		
		//We display only 5 headlines for now
		for(i=0;i<5;i++)
		{
			item = items[i];
			
			//href
			link = item.getElementsByTagName("link")[0];
			
			//innerHTML
			title = item.getElementsByTagName("title")[0];
			
			//Now we have both
			//Create new "Item" objects and add them to our NewsFeed object
			
			newsitem = new NewsFeedItem(link.firstChild.nodeValue,title.firstChild.nodeValue);
			
			//Add it to our main class
			othis.feeds.push(newsitem);
			
			//All done in memory. Now need to actually SHOW it to the user
			othis.div.appendChild(newsitem.anchor);
			
			othis.div.innerHTML += "&nbsp;&nbsp;&nbsp;&nbsp;";
		
		}
	}
}

//Function to scroll the news
// Written outside our constructor
NewsFeed.prototype.scroll = function()
{
	if(othis.div.offsetLeft + othis.div.offsetWidth < 2)
	{
		//Take it to the right end
		othis.div.style.left = window.innerWidth - 5 + "px";
	}
	else
	{	
		//Scroll left a little
		othis.div.style.left = othis.div.offsetLeft - 5 + "px";
	}

	//Start the timer for scrolling
	othis.scrTimer = setTimeout(othis.scroll,50);
	
}

//Function to stop scrolling
NewsFeed.prototype.stopScroll = function()
{
	if(othis.scrTimer)
	{
		clearTimeout(othis.scrTimer);
	}
}

function init()
{
	new NewsFeed();
}