<?php

if (isset($_GET['posts']) && $_GET['posts']!="list") {  
	//validate $_GET['posts']
	$post_id_list=explode(",",$_GET['posts']);
	$count_ids=0;
	 
	foreach ($post_id_list as $post_id_to_check):
		$count_ids++;
		if (!is_numeric($post_id_to_check) AND $post_id_to_check!="") die("<h1>Wrong parameters.</h1>");
	endforeach;
	
	
	if ($count_ids>100) die("<h1>A maximum of 100 posts is allowed. Sorry.</h1>");
}

 
if (isset($_GET['posts']) && $_GET['posts']!="list")  $posts_array = get_posts( "post_type=any&orderby=post__in&post_status=publish&include=".$_GET['posts'] ); else $posts_array = get_posts( "post_status=publish&posts_per_page=20" );



?>