<?php
	// This script is a little involved. If this script  
	// is called as a result of an AJAX call from a client,
    // then the results are NOT cached by Firefox and Chrome.
    // This may be very good for most AJAX apps because that is
    // exactly what we want. But there may be instances when
    // we want the response to be cached. In such cases,
	// we should use the "Expires" header. This takes
	// a future date as parameter. The format must be like
	// "Sun, 19 Oct 2014 14:12:12 GMT". 
	// We can achieve this by using the date() function with 
	// formatting information. See $expstrtime and $strtime.
	
	// The browser now keeps the response with it and does not 
	// even come to the server if it realizes that this response
	// expires at a later time. So this is great if you want to 
	// cache data. But there is a catch. 
	// Some browsers will keep the cached response even AFTER the
	// expiry date. So even after expiry date, the browser will
	// continue to use its cached copy. This may be disastrous.
	// The only way to get around this is to force a request 
	// to the server by manipulating the url during the ajax call.
	
	// For instance, we can force a request to the server everytime
	// by using xhr.open("GET","http://server/scr.php?randomstr=timestamp",true);
	// Since the timestamp will be different everytime, the url is effectively
	// changed and so the browser is now forced to make a request.
	
	// The bottom line is, use the cached copy till the cache expires.
	// Once the cache expires, force a call to the server by manipulating
	// the url.
	
	// Alternatively use the http 1.1 header called "Cache-control".
	// Here you can specify the max-age in seconds upto which the browser
	// can cache the data. After that the browser must come to the server.
	// Theoretically, both the "Expires" and the "Cache-control" headers
	// must work similarly. (Expires is an http 1.0 header). But browsers
	// work correctly with the Cache-control header (See above paragraph).
	
	// Please note that POST responses are NOT CACHED inspite of the "Expires"
	// header being set. (Or for that matter the "Cache-control" header)
	// You have to manually cache POST responses (using LocalStorage or something
	// else) if you want to.
	
	date_default_timezone_set('Asia/Calcutta');
	$tim = time();
	$exptime = $tim + 10;
	$strtime = date('D, d M Y H:i:s',$tim);
	$expstrtime = date('D, d M Y H:i:s',$exptime);
	
	//header("Expires:$expstrtime");
	//header("Cache-control: max-age=6");
	echo $strtime;

	//You can test this script, after uncommenting line 51 or 52 too.

?>