function NewsFeed()
{
	othis = this;

	// For making the periodic refresh
	othis.xhr = new XMLHttpRequest();

	// Two timers - one for scroll and one for the periodic refresh
	othis.scrTimer = null;
	othis.fetchTimer = null;

	othis.div = document.getElementById("ticker");
	othis.div.addEventListener("mouseover", othis.stopScroll, true);
	othis.div.addEventListener("mouseout", othis.scroll, true);

	/* //To push this outside
	othis.scroll = function() {
		othis.div.style.left = "500px";
	}
	*/
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
