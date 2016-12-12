function Suggest()
{
	othis = this;
	// Because "this" would refer to different things within different functions

	this.xhr = new XMLHttpRequest();
	this.timer = null;
	this.searchBox = document.getElementById("searchBox");
	this.searchResults = document.getElementById("searchResults");

	this.cache = {};
	this.getPlayers = function() {
		// If there is a timer already registered, it means that the user has already typed something
		// Register our visit to the server 1 second AFTER the current keystroke
		if(this.timer)
		{
			clearTimeout(this.timer);
		}
		this.timer = setTimeout(this.fetchPlayers, 1000);
		// Set timeout is a window functionality
		// So we can't use "this" within fetchPlayers as it will refer to the window
	}
	this.fetchPlayers = function() {
		// alert('Initiating search!');
		if(othis.searchBox.value == "") // handling blank string
		{
			// Clear suggestions & Don't make another call
			othis.searchResults.innerHTML = "";
			othis.searchResults.style.display = "none";
		}
		else if(localStorage[othis.searchBox.value]) // cached
		{
			var playerList = JSON.parse(localStorage[othis.searchBox.value]);
			othis.populatePlayers(playerList);
		}
		else // new search
		{
			othis.xhr.onreadystatechange = othis.fillPlayers;
			othis.xhr.open("GET", "getSuggestions.php?player=" + searchBox.value, true);
			othis.xhr.send();
		}
	}
	this.fillPlayers = function() {
		if(othis.xhr.readyState == 4 && othis.xhr.status == 200)
		{
			players = JSON.parse(othis.xhr.responseText);
			// JSON.stringify is the opposite of JSON.parse
			if(players.length)
			{
				othis.searchResults.className = "found";
				localStorage[othis.searchBox.value] = JSON.stringify(players);
				othis.populatePlayers(players);
			}
			else
			{
				othis.searchResults.innerHTML = "No players found"
				othis.searchResults.className = "notfound";
			}
			othis.searchResults.style.display = "block";
		}
	}
	this.populatePlayers = function(players)
	{
		othis.searchResults.innerHTML = ""
		for(var i = 0; i<players.length; ++i)
		{
			var newdiv = document.createElement("div");
			newdiv.className = "suggest";
			newdiv.innerHTML = players[i];
			newdiv.onclick = this.setPlayer;
			othis.searchResults.appendChild(newdiv);
		}
	}
	this.setPlayer = function(event) {
		othis.searchBox.value = event.target.innerHTML;
		othis.searchResults.innerHTML = "";
		othis.searchResults.style.display = "none";
	}
}

obj = new Suggest();
