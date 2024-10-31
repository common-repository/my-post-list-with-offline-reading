<?php
 
function mpl_clean_the_content($content,$post)

{   $content= trim( preg_replace('/\[.*?\]/', '', $content)); //this removes any call to shortcodes||
	
	
	$content=strip_tags($content,"<b>,<strong>,<em>,<i>,<p>,<br>,<h2>,<h3>,<h4>,<h5>,<h1>,<li>,<ul>,<ol>");
	// 
	$content=  preg_replace ("/\[(\S+)\]/e", "", $content); //this removes any call to shortcodes
	//$content= preg_replace ("/\[[^)]+\]/","",$content); // 'ABC 

	$content=nl2br ($content);

	if (function_exists("mpl_custom_content_filter")) $content=mpl_custom_content_filter($content,$post);
	$content=preg_replace('/(<br[^>]*>\s*){2,}/', '<br/>', $content);
 	return $content;
	 
	
}


//QUERY POSTS BASED ON THE URL PARAMETERS AND RETURN $posts_array
require_once ("query.php");
 
//INIT important for linear navigation
$post_counter=0;


remove_shortcode('gallery');

?>
<!DOCTYPE HTML>
<html   <?php if (!isset($_GET['pdf'])) {?> manifest = "<?php mplPrintRootUrl(); ?>/manifest.appcache?mpl_action=load_appcache&posts=<?php echo wp_kses($_GET['posts'],array(),array()) ?>&rnd=<?php echo rand (0,10000) ?>"><?php }Ê?>
<head>
  
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
  
	<link rel="apple-touch-icon" href="<?php echo plugins_url('my-post-list-with-offline-reading/mobile/images/touch-icon-iphone.png') ?>">
  <meta name="apple-mobile-web-app-title" content="<?php BLOGINFO('name') ?> ">
  <title><?php BLOGINFO('name') ?></title>
  <meta name="robots" content="noindex">
  <meta name="apple-mobile-web-app-capable" content="yes"/>
  <meta name="apple-mobile-web-app-status-bar-style" content="black">
  <meta charset = "UTF-8" />  
  <style>
	<?php include("style.css"); ?>
  </style> 
</head>
<body class="<?php if (isset($_GET['pdf'])) {?>pdf <?php } ?>" >
	<a name="page-top"></a><a name="linear-index-<?php echo $post_counter; ?>"></a>
  <header>
			<h1><a href="#skip-intro"><?php BLOGINFO('name') ?></a></h1>
			<h2><a href="#skip-intro"><?php BLOGINFO('description') ?></a></h2>
  </header>
  
  <?php if (isset($_GET['pdf'])) {?>
						<div id="pdf-dl">
						  <a  href="http://www.web2pdfconvert.com/convert">
									<img src="<?php echo plugins_url('my-post-list-with-offline-reading/img/loading-bar.gif') ?>" /><br />
									Please wait, file is being converted...
								</a>
						 </div>
							<script type="text/javascript">
					  <!--
					  setTimeout('window.location.href="http://www.web2pdfconvert.com/convert"', 2000) /* 5 seconds */
				 
					  //-->
					  </script>
					 
  <?php } ?>
  
  <a name="skip-intro"></a> <!-- skip intro: a tribute to useless flash splashes we all were fighting against! -->
  <div class="post-index">
			<ul>
			  <?php if ($posts_array) foreach($posts_array as $post): ?>
			   <li> <a href="#post-<?php   echo $post->ID ?>">
						<?php if (get_post_thumbnail_id($post->ID)) { ?>
							<img width="80" height="60" src="<?php echo   wp_get_attachment_url( get_post_thumbnail_id($post->ID) ) ?>" />
							<?php } ?>
					</a>
					<a class="ltsp" href="#post-<?php   echo $post->ID ?>"><?php    echo $post->post_title  ?></a>
				   <br clear="all"/>
				   </li>
			   <?php endforeach; ?>
			</ul>
  </div>
	
	
	  
  <div id="post-allcontent">	
	  <?php
		$posts_array_copy=$posts_array;  
	  if ($posts_array) foreach($posts_array as $post): $post_counter++; ?>
	  
				  <?php if (isset($_GET['pdf'])) {?> <div class="pdf-prepost"><p>&nbsp; .   <br /></p><p>&nbsp;    <br /></p><p>&nbsp;    <br /></p><p>&nbsp;    <br /></p><p>&nbsp;    <br /></p>
													</div>
												<?php } ?> 
				  <a name="linear-index-<?php echo $post_counter; ?>"></a>
				  <a  name="post-<?php    echo $post->ID  ?>"></a>
				   <div id="link-nav-linear">
									 <a class="navlink" <?php if ($post_counter<=1) echo " style='visibility:hidden'"; ?> href="#linear-index-<?php echo ($post_counter-1);?>"> < </a>
									 <h2><a href="#linear-index-<?php echo ($post_counter) ?>"><?php   echo $post->post_title?></a></h2>
									<?php if ($posts_array_copy[$post_counter]) {	?>
									 <a class="navlink" href="#linear-index-<?php echo ($post_counter+1);?>"> > </a> <?php }Ê?>
											   
						  </div>
					  
				 <div class="post">
					
					 <?php if (get_post_thumbnail_id($post->ID)) { ?>
					 <img class="featimage" src="<?php echo   wp_get_attachment_url( get_post_thumbnail_id($post->ID) ) ?>" />
					 <?php } ?>
					  <div class="post-content"><?php echo mpl_clean_the_content( $post->post_content,$post) ?></div>
				</div>
		 <?php endforeach; ?>
  </div>
	
	
  <!-- about -->
  	   <a  name="about-anchor">
	<div id="link-nav-linear">
					 
					 <h2 style="width:100%"><a href="#about-anchor">About</a></h2>
			 
							   
		  </div>
  <a name="linear-index-<?php echo $post_counter+1; ?>"></a>	
  
  <div id="about">
	<?php echo get_option('mpl_mobile_about_content') ?>
	<p></p>
  </div>
		
<div id="bottom-area">
	
	<div class="bottom-button-area"><a href="#page-top">Home</a>
	</div>
	<div class="bottom-button-area"><a href="#skip-intro">Index</a>
	</div>
	<div class="bottom-button-area"><a href="#about-anchor">About</a>
	</div>
</div>


</body>

<script>
	 
	  <?php if (!isset($_GET['pdf']))  include ('scripts.js'); //matspin cubiq.org add to homescreen for iphone
    ?>
</script>
<!-- this mobile ready page has been created with My Posts List WordPress Plugin - http://www.rioloft.com/rio-guide/wordpress-my-posts-plugin/   -->
</html>