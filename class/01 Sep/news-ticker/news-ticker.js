function NewsFeedItem(link, title)
{
	this.anchor = document.createElement("a");
	this.anchor.href = link;
	this.anchor.innerHTML = title;
}

function NewsFeed()
{
	othis = this;

	othis.xhr = new XMLHttpRequest();

	othis.scrTimer = null;
	othis.fetchTimer = null;

	othis.div = document.getElementById("ticker");
	othis.div.addEventListener("mouseover", othis.stopScroll, true);
	othis.div.addEventListener("mouseout", othis.scroll, true);

	// To store the headlines
	othis.feeds = new Array();

	othis.getFeeds();
}

NewsFeed.prototype.getFeeds = function() {
	othis.xhr.onreadystatechange = othis.showNews;
	othis.xhr.open("GET", "getnews.php", true);
	othis.xhr.send();

	// Set the timer... we get news once every 30 min
	// (now for testing - every 20s)
	othis.fetchTimer = setTimeout(othis.getFeeds, 2000000);
}

NewsFeed.prototype.showNews = function() {
	// can safely use this
	if(this.readyState == 4 && this.status == 200)
	{
		// var response = this.responseXML;
		// What if the server does not co-operate and sent the result in the form of text
		mydom = '';
		if(this.responseText)
		{
			parser = new DOMParser();
			mydom = parser.parseFromString(this.responseText, "text/xml");
			/*
			alert(mydom);
			// To do the reverse, i.e. reserialize the DOM to a string
			ser = new XMLSerializer();
			alert(ser.serializeToString(mydom));
			*/
		}
		else
		{
			mydom = this.responseXML;
		}
		root = mydom.documentElement;	// this.responseXML.documentElement

		// Let's get the headlines - <item> nodes
		items = root.getElementsByTagName("item");

		othis.div.innerHTML = "";
		othis.feeds = new Array();
		// Loop through the first five only
		for(i = 0; i < 5; ++i)
		{
			var item = items[i];
			var link = item.getElementsByTagName("link")[0];
			var title = item.getElementsByTagName("title")[0];

			// Can't do innerHTML, this is XML
			var newsitem = new NewsFeedItem(link.firstChild.nodeValue, title.firstChild.nodeValue);
			othis.feeds.push(newsitem);
		}
		for(var i = 0; i < othis.feeds.length; ++i)
		{
			othis.div.appendChild(othis.feeds[i].anchor);
			othis.div.innerHTML += "&nbsp;&nbsp;&nbsp;&nbsp;";
		}
	}
}

NewsFeed.prototype.scroll = function() {
	if(othis.div.offsetLeft + othis.div.offsetWidth < 2)
	{
		othis.div.style.left = (window.innerWidth - 5) + "px";
	}
	else
	{
		othis.div.style.left = (othis.div.offsetLeft - 5) + "px";
	}
	othis.scrTimer = setTimeout(othis.scroll, 20);
}

NewsFeed.prototype.stopScroll = function() {
	clearTimeout(othis.scrTimer);
}
