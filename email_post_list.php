<?php ///print_r($_GET);
$form_error=FALSE;



$mpl_enable_email_send=get_option('mpl_enable_email_send');
if (
	( is_user_logged_in() && $mpl_enable_email_send=="ONLY-LOGGED-IN") OR
	($mpl_enable_email_send=="ENABLE-ALL-USERS")
   ) $show_email_send=TRUE; else $show_email_send=FALSE;

   if (!$show_email_send) die ("Disabled from panel.");
   
   
function mpl_set_html_content_type()  {    return 'text/html';  }
    
$the_custom_message=wp_kses($_GET['msg'],array(),array());
$the_custom_message=str_replace(".",' .',$the_custom_message);
$the_custom_message=str_replace("/",' ',$the_custom_message);
$the_custom_message=str_replace("\\",' ',$the_custom_message);
if (strlen($the_custom_message)>70)    {$form_error=TRUE;$error_description="Invalid Message";}
if (!is_email($_GET['to'])) {$form_error=TRUE;$error_description=" Invalid TO Address";}
if (!is_email($_GET['from'])) {$form_error=TRUE;$error_description=" Invalid FROM Address";}
if (strpos($the_custom_message,'http')===false) {} else   {$form_error=TRUE;$error_description="Invalid Message, no URLs allowed";}
if (strpos($the_custom_message,'www')===false) {} else   {$form_error=TRUE;$error_description="Invalid Message, no URLs allowed";}
//add msg validation



if ($form_error)

 { echo $error_description; //stampa errori e fine
			     
    }
 else

   {
    
    //prepare and send email...
    //QUERY POSTS BASED ON THE URL PARAMETERS AND RETURN $posts_array
    
    
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
    

	//lists post for displaying in email		     
        $html_content="";
	$html_content.= "<ul style='list-style-type:none;max-width:500px'>";
			   if ($posts_array) foreach($posts_array as $post): 
			   $html_content.= "<li>";
					$html_content.= ' <h2>'.$post->post_title  ."</h2>";
					
					 
			     if (get_post_thumbnail_id($post->ID)) { $html_content.= ' <img width="80" height="60" align="left" style="margin-right:10px;" src="'. wp_get_attachment_url( get_post_thumbnail_id($post->ID) ) .'" />';
							  }  
				 
					$html_content.= mpl_get_the_excerpt($post->ID);
				  $html_content.= ' <br clear="all"/>';
				   $html_content.= '</li>';
			    endforeach;  
			$html_content.= "</ul>";
			
			//echo "content:".$html_content;
			
			
			
			
	$email_content_html=addslashes($the_custom_message).$html_content;
	add_filter( 'wp_mail_content_type', 'mpl_set_html_content_type' );
	$email_title='A selection of topics from '.GET_BLOGINFO('url');
	$headers[] = 'From: '.GET_BLOGINFO('name').' <'.$_GET['from'].'>';
        $wp_sendmail_action=wp_mail( $_GET['to'], $email_title,$email_content_html,$headers );
	 remove_filter( 'wp_mail_content_type', 'mpl_set_html_content_type' ); // reset content-type to to avoid conflicts -- http://core.trac.wordpress.org/ticket/23578
	if ($wp_sendmail_action) {
				     ?> 
						<script>
						
					                 var sel = jQuery("#mpl-email-list-action-result");
							  sel.html('EMail sent successfully!');
							  setTimeout(function(){
							  sel.html('');
							   jQuery("#close-send-email-list-div").click();
							  },3000);				


 
						</script>	       
				     
				     <?php
			        } 
}
?>