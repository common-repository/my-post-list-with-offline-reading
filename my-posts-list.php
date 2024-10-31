<?php
/*
Plugin Name: My Posts List
Plugin URI: http://www.rioloft.com/rio-guide/wordpress-my-posts-plugin/
Description: Let your users build a list of their favourite posts of your blog to help browsing, and let them optionally share or download as a web app the chose content  for offline reading.
Author: rioloft
Author URI: http://www.rioloft.com/
Version: 2.0
License: GPL version 2 or later - http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
*/



 function mplPrintRootUrl()
 {
	$blog_url=get_bloginfo('url');
 
	$last = $blog_url[strlen($blog_url)-1];
	if ($last=="/") $blog_url= substr_replace($blog_url ,"",-1);
	
	echo $blog_url; //with no slashes
 }
 
 
 
 function mpl_add_jquery_script()
{
	wp_enqueue_script( 'jquery' );
	
	wp_register_script( 'mpl-plugin-js-stuff',  plugins_url('my-post-list-with-offline-reading/plugin-engine.js'));
	wp_enqueue_script( 'mpl-plugin-js-stuff' );
	
	wp_register_style( 'mpl-plugin-style', plugins_url('style.css', __FILE__) );
    wp_enqueue_style( 'mpl-plugin-style' );
		
}
add_action( 'wp_enqueue_scripts', 'mpl_add_jquery_script' );




function mpl_add_my_list_to_footer() {



//actions for receiving FB url
if (isset($_GET['k'])):
 
       $array_post_list=explode(',',$_GET['k']);
       ?> <script>
       localStorage.clear();
       </script><?php
       if ($array_post_list) foreach( $array_post_list as $the_post_id ) :
       
		     if (!is_numeric($the_post_id)) continue;
		     ?>
		  <script>
		     
		  
		      
		   	var the_url="<?php echo get_permalink($the_post_id); ?>";
														
														
		     var the_title= "<?php echo get_the_title($the_post_id); ?>";
		     
		      
		     var the_post_id=<?php echo  ($the_post_id); ?>;
		     
		     if(typeof(Storage)!=="undefined")
						     {
						     // Yes! localStorage and sessionStorage support!
						     // Some code.....
						     if (!localStorage.mypostarray)
						     {localObj = {}
						     localObj.localArray = []
						     }
						     else localObj = JSON.parse(localStorage.mypostarray);
						     
						     localObj.localArray.push(the_post_id+'||||'+the_url+'||||'+the_title)
						      
						      
						     localStorage.mypostarray = JSON.stringify(localObj);
						      
						   
						   PopulateTheList();
						   jQuery("#view-your-list").hide();
						     jQuery("#your-posts-list-container").show();
						  

						     }
					       else
						     {
						     alert("Sorry, a HTML5 browser is needed. Get FireFox, Google Chrome, or Safari. Come back soon!");
						     }
  
     
	           </script>
		 
	
		 
	      <?php endforeach; ?>
       <script>
         jQuery(function(){ //DOM Ready
		   jQuery("#view-your-list a").click();
	 })
       </script>
     

<?php endif;
//end fb



//check what we will need to show
//$mpl_enable_pdf_download=get_option('mpl_enable_pdf_download');
//if (
//	( is_user_logged_in() && $mpl_enable_pdf_download=="ONLY-LOGGED-IN") OR
//	($mpl_enable_pdf_download=="ENABLE-ALL-USERS")
 //  ) $show_pdf_button=TRUE; else $show_pdf_button=FALSE;


//check what we will need to show
$mpl_enable_email_send=get_option('mpl_enable_email_send');
if (
	( is_user_logged_in() && $mpl_enable_email_send=="ONLY-LOGGED-IN") OR
	($mpl_enable_email_send=="ENABLE-ALL-USERS")
   ) $show_email_send=TRUE; else $show_email_send=FALSE;

//check what we will need to show
$mpl_enable_facebook_share=get_option('mpl_enable_facebook_share');
if (
	( is_user_logged_in() && $mpl_enable_facebook_share=="ONLY-LOGGED-IN") OR
	($mpl_enable_facebook_share=="ENABLE-ALL-USERS")
   ) $show_fb_share=TRUE; else $show_fb_share=FALSE;





$mpl_enable_mobile = get_option('mpl_enable_mobile');
if (
	( is_user_logged_in() && $mpl_enable_mobile=="ONLY-LOGGED-IN") OR
	($mpl_enable_mobile=="ENABLE-ALL-USERS")
   ) $show_mobile_button=TRUE; else $show_mobile_button=FALSE;

?>
       <div id="view-your-list"><a href="#">View Your List</a></div>
       
      <div id="your-posts-list-container">
				<a href="#" id="close-your-list"></a>
				<h2>Your List</h2>
				<div id="mpl-actions-container">
				      
				   <a href="#" id="empty-your-list">Delete list</a>
				   <a href="#" id="mpl-about-list">About</a> 
				</div>
				
				
				
				<div id="mpl-about-list-div"><p>Store a list of your favourite posts from this site into your browser!  <br />You will conveniently find this list again next time you visit us.</p>
					<p><i>Powered by  HTML5 Storage and  <a href="http://www.rioloft.com/">Rio Loft</a>.</i></p>
					<a href="#" id="mpl-close-about">CLOSE</a>
				</div>
							  
							  
				
				<div id="your-posts-list"> </div>
				
				 
				<?php if ( 0 AND $show_pdf_button) { ?><a class="mpl-list-action-trigger" href="#" id="download-post-list-as-pdf" target="_blank">PDF/Docs</a> &nbsp; <?php } ?>
				
				<?php if ($show_email_send) { ?><a class="mpl-list-action-trigger" href="#" id="download-post-list-as-email" target="_blank">Send via Email... </a><?php } ?> 
			  	<?php if ($show_fb_share) { ?><a class="mpl-list-action-trigger" target="_blank" id="send-post-list-to-facebook"  data-href="http://www.facebook.com/sharer/sharer.php?u=<?php BLOGINFO('url') ?>">Share on Facebook...</a><?php } ?>
			        <?php if ($show_mobile_button) { ?><a class="mpl-list-action-trigger" href="#" id="download-post-list-as-web-app" target="_blank">Mobile App for your iPhone/Android device</a><?php } ?>
      
      </div>
      
       <div id="send-email-list-div-opaque-layer" ></div>
        <div id="send-email-list-div" >
	      <a href="#" id="close-send-email-list-div"></a>
	      <h2 id="mpl-send-h2">Send your list to a friend</h2>
       	      <span class="mpl-send-label"> FROM: (Your email):</span>
	     
	     <input type="text" name="your-email-field" id="your-email-field"> 
	      <span class="mpl-send-label"> TO: (Your friend's email):</span>
	      <input type="text" name="your-friend-email-field" id="your-friend-email-field">  
	       <span class="mpl-send-label">Your message:</span>
	      <textarea  maxlength="70" name="mplist-message-field" id="mplist-message-field">Hi, these are some selected posts that I have picked for you to read.</textarea>
	      <div id="mpl-email-list-action-result" ></div>
	      <a href="#" id="trigger-list-send-to-email">Send</a>
       </div>
<?php
 }    

 add_action('wp_footer', 'mpl_add_my_list_to_footer');
 
 



	
	
	
 
function mpl_add_post_adding_link($content)

{	global $post;
	if (!( ($post->post_type=='post') or ($post->post_type=='page') )) return;
 
	if (!is_single()and !is_page()) return $content;
	global $post; 
	$link_in_html='<a class="add-to-post-list" href="'. get_permalink($post->ID) .'" data-postid="'. ($post->ID) .'" data-posttitle="'.get_the_title() .'">Add to your list</a>';
	return $content.$link_in_html;
}
 
add_filter("the_content","mpl_add_post_adding_link");
 
 
 
 
add_action("wp_loaded","mpl_check_action_to_do");
function mpl_check_action_to_do()
{  
	      

       if (isset($_GET['action'])    && $_GET['action']=='email_post_list'  ):
				include("email_post_list.php");
				die;
	      endif;
	
	 if (isset($_GET['action'])    && $_GET['action']=='filter_with_list'  ):
		      $array_id=explode(',',$_GET['posts']);
		     
		    // print_r ($array_id);die;
		    $args=array(   'post_type' => 'post',
				'post__in' => $array_id,
			     
				);
		    query_posts( $args );
	endif;
	
	
	if (isset($_GET['action'])    && $_GET['action']=='mobile_post_list'  ):
				include("mobile/mobile_post_list.php");
				die;
	      endif;
	
	
	$called_uri_without_querystr=explode("?",$_SERVER['REQUEST_URI']);$called_uri_without_querystr=$called_uri_without_querystr[0];
	//echo $called_uri_without_querystr; die;
	if ( isset($_GET['mpl_action']) && $_GET['mpl_action']=="load_appcache" ):
		///CACHE MANIFEST CREATION
		 header('Content-Type: text/cache-manifest');
		echo "CACHE MANIFEST\n";
		//echo "# v1index.htmlNETWORK:\n*\n";			
			//QUERY POSTS BASED ON THE URL PARAMETERS AND RETURN $posts_array
			require_once ("mobile/query.php"); 
		   if ($posts_array && 1 ):
						echo "CACHE:"."\n";
						
						 foreach($posts_array as $post):
						 
									$feat_image_url = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );
								 
									echo $feat_image_url."\n";
							
							endforeach;
							 
			   endif;
		 
		die; //end manifest
	endif;
	
}











//OPTION PAGE
// create custom plugin settings menu
require_once('option-page.php');




 function mpl_get_the_excerpt($id=false) {
            global $post;

            $old_post = $post;
            if ($id != $post->ID) {
                $post = get_page($id);
            }

            if (!$excerpt = trim($post->post_excerpt)) {
                $excerpt = $post->post_content;
                $excerpt = strip_shortcodes( $excerpt );
                $excerpt = apply_filters('the_content', $excerpt);
                $excerpt = str_replace(']]>', ']]&gt;', $excerpt);
                $excerpt = strip_tags($excerpt);
                $excerpt_length = apply_filters('excerpt_length', 55);
                $excerpt_more = apply_filters('excerpt_more', ' ' . '[...]');

                $words = preg_split("/[\n\r\t ]+/", $excerpt, $excerpt_length + 1, PREG_SPLIT_NO_EMPTY);
                if ( count($words) > $excerpt_length ) {
                    array_pop($words);
                    $excerpt = implode(' ', $words);
                    $excerpt = $excerpt . $excerpt_more;
                } else {
                    $excerpt = implode(' ', $words);
                }
            }

            $post = $old_post;

            return $excerpt;
        }
	
	
	