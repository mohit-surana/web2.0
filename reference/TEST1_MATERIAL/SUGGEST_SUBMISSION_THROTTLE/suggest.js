//Create a constructor function and put all relevant properties and 
// functions inside it.
function Suggest()
{
	//:( .. Save "this"
	othis = this;
	
	this.xhr = new XMLHttpRequest(); // object to make the AJAX call
	
	//A document.getElementById() NOW will fail. We can do it later
	this.movie = null;
	this.div = null;
	
	//Define a timer for the "Suggest" functionality
	this.timer = null;
	
	//This function will get called when the user "keys" up. 
	// We need to decide whether to go to server at all?? Or fetch 
	// from cache or (do we need to do anything at all????)
	
	this.getMovie = function()
	{
		//If there is a timer already registered, clear that and create a 
		// new one, 1 second from now (our pause is 1 second)
		// Else, just create a timer for 1s ( first time keyup)
		if(this.timer)
		{
			clearTimeout(this.timer);
		}

		//In any case
		this.timer = setTimeout(this.fetchMovie, 1000);
	}
	
	this.fetchMovie = function()
	{
		//Check if the text box (movie) is empty.
		// This can happen if the user has pressed backspace repeatedly
		// and cleared the text field
		
		othis.movie = document.getElementById("movie");
		othis.div = document.getElementById("container");
		if(othis.movie.value == "")
		{
			//There is nothing to do
			othis.div.innerHTML = "";
			othis.div.style.display = "none";
			return;
		}
		
		// Else we have two choices. One, we can check in our cache.
		// If we had previously searched for this moviepart, we will find it
		// in our cache. We load it from there. Else, we have no option 
		// but to go to the server
		else
		{
			urlstr = "http://localhost/getmovies.php?moviepart=" + othis.movie.value;
			if(localStorage[urlstr])
			{
				othis.fillMovies(JSON.parse(localStorage[urlstr]));
			}
			else
			{
				//Now we have to go to the server
				othis.xhr.onreadystatechange = othis.populateMovies;
				
				// Open a GET connection
				othis.xhr.open("GET", "http://localhost/getmovies.php?moviepart=" + othis.movie.value, true);
				
				othis.xhr.send();
	
			}
		}
	}
	
	this.populateMovies = function()
	{
		if(this.readyState == 4 && this.status == 200)
		{
			movies = JSON.parse(this.responseText);
			
			//Maybe there were no suggestions.
			if(movies.length == 0)
			{
				othis.movie.className = "notfound";
				othis.div.style.display = "none";
			}
			else//there are some suggestions
			{
				othis.movie.className = "found";
				
				//Add it to the browser cache. We will use localStorage
				localStorage[this.responseURL] = this.responseText;
				
				othis.fillMovies(movies);
			}
		}
	}
	
	this.fillMovies = function(movies)
	{
		othis.div.innerHTML = "";
		for(i=0;i<movies.length;i++)
		{
			newdiv = document.createElement("div");
			newdiv.innerHTML = movies[i];
			newdiv.className = "suggest";
			othis.div.appendChild(newdiv);
			
			//Now we need to register the event where the div is "Selected"
			// We use "onclick"
			newdiv.onclick = othis.setMovie;
		}
		othis.div.style.display = "block";
	}
	//Function to set the selected value inside the textbox
	// After setting the value, clear the "div" container
	
	this.setMovie = function(event)
	{
		othis.movie.value = event.target.innerHTML;
	
		//Clear the div
		othis.div.innerHTML = "";
		othis.div.style.display = "none";
	}
}

//Create the object using the constructor
obj = new Suggest();