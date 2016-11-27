
<section class="main">
 <form class="search" method="GET" name = "search" 
 action="?var=search_result" >
	 <input type="text" id = "search_text" name="search_text" placeholder="Find friend..." 
	 	 	onkeyup="findMatch();"/>

	 <ul class="results" >
		 <li >
			 <a href="drop_down.php" id = "search_result" ></a>
		 </li>
	 </ul>
 </form>
</section>

