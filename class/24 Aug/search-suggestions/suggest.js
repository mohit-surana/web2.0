function Suggest()
{
	othis = this;
	// Because "this" would refer to different things within different functions

	this.timer = null;
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
		alert('Initiating search!');
	}
}

/*
obj =
{
	"xhr"				: new XMLHttpRequest(),
	"getContent"		: function() {
		obj.xhr.onreadystatechange = obj.updateContent;
		obj.xhr.open("GET", "getChunk.php?chunk=" + lastChunk++, true);
		obj.xhr.send();
		window.removeEventListener("scroll", obj.getContent, false);
	},
	"updateContent"		: function() {
		if(this.readyState == 4 && this.status == 200)
		{
			response = this.responseText;
		}
	}
};
*/

obj = new Suggest();
searchBox = document.getElementById("searchBox");
