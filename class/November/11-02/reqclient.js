priorities = [4, 3, 7, 2, 1, 9, 8, 6];
methods = ["GET", "POST", "POST", "GET", "POST", "GET", "GET", "POST"];
urls = ["get.php", "post.php", "post.php", "get.php","post.php", "get.php","get.php", "post.php"];

outer = 0;
while(outer < 7)
{
	for(var i = 0; i < 8; i++)
	{
		RequestManager.sendToPendingQueue(
			{
				url : urls[i],
				method : methods[i],
				priority : priorities[i],
				data : null,
				age : 0,
				xhr : null
			}
		);
	}
	outer++;
}
