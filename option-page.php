<?php 

add_action('admin_menu', 'mpl_admin_menu');


function mpl_admin_menu()
{
    add_options_page('My Post List', 'My Post List', 'manage_options', 'mpl-optionspage-identifier', 'mpl_options_page_create');
}


function mpl_options_page_create()
{
	  ?>
  <div style='margin:15px;'>
	  <h2>My Posts List - Introduction. Read me!</h2>
	  <p>This plugin allows your users to create a custom post list with their favourite topics from your site.</p>
	  <p>An "Add to your list" link with a star is automatically added at the end of each post and page.</p>
	  <p>Clicking the link will pop-out a the list on the bottom right of the screen.</p>
	  <p>You can find more information on <a target="_blank" href="http://www.rioloft.com/rio-guide/wordpress-my-posts-plugin/">this web page</a>. Thanks for using MyPostList!
	  <?php
	  if (array_key_exists('mpl_enable_facebook_share', $_POST)) {
  
					 //update_option('mpl_enable_pdf_download', $_POST['mpl_enable_pdf_download']);
					 echo $_POST['mpl_enable_email_send'];
					  update_option('mpl_enable_email_send', $_POST['mpl_enable_email_send']);
					 update_option('mpl_enable_facebook_share', $_POST['mpl_enable_facebook_share']);
					 
					 update_option('mpl_enable_mobile', $_POST['mpl_enable_mobile']);
					 update_option('mpl_mobile_about_content', $_POST['mpl_mobile_about_content']);
					 
					 
					 
					 
						}
    ?>
    <form method="post" action="<?php echo str_replace('%7E', '~', $_SERVER['REQUEST_URI']); ?>">
         
        <p>
          
        </p>
		
		 <!--
		 <hr />
		
		 <h2>PDF Download Feature</h2>
		 <p>Let site users download the list they have created in PDF or Google Docs Format with the PDF online service by http://www.web2pdfconvert.com/</p>
		
		
		<p>You can enable this button for logged in, or for all site users.</p> 
	  <p><select name="mpl_enable_pdf_download">
		  <option value="<?php echo get_option('mpl_enable_pdf_download'); ?>">  <?php $mpl_enable_pdf_download = get_option('mpl_enable_pdf_download');
			echo $mpl_enable_pdf_download;
			  ?>
			  </option>
		  <option value="DISABLED">Disable</option>
		  <option value="ONLY-LOGGED-IN">Enable for Logged in users only </option>
		  <option value="ENABLE-ALL-USERS">Enable for All site users</option>
	  </select>
	  </p>
	-->
	
	
	
	 <hr />
		
		 <h2>Share on Facebook the List</h2>
		 <p>Let site users share the list they have created on Facebook</p>
		
		<?php $option_value=get_option('mpl_enable_facebook_share'); ?>
		<p>You can enable this button for logged in, or for all site users.</p> 
	  <p><select name="mpl_enable_facebook_share">
		  <option value="<?php echo $option_value ?>">  <?php   echo $option_value;  ?>
			  </option>
		  <option value="DISABLED">Disable</option>
		  <option value="ONLY-LOGGED-IN">Enable for Logged in users only </option>
		  <option value="ENABLE-ALL-USERS">Enable for All site users</option>
	  </select>
	  </p>
	  
	  
	 <hr />
		
		 <h2>Send to Email</h2>
		 <p>Let site users email a friend with their created list  </p>
		
		<?php $option_value=get_option('mpl_enable_email_send'); ?>
		<p>You can enable this button for logged in, or for all site users.</p> 
	  <p><select name="mpl_enable_email_send">
		  <option value="<?php echo $option_value ?>">  <?php   echo $option_value;  ?>
			  </option>
		  <option value="DISABLED">Disable</option>
		  <option value="ONLY-LOGGED-IN">Enable for Logged in users only </option>
		  <option value="ENABLE-ALL-USERS">Enable for All site users</option>
	  </select>
	  </p>
	  
	

		 <hr />
		 <h2>Offline Web-app generation. Great for making a mini iPhone Web app!</h2>
		 <p>Let site users download a simple web app containing the chosen posts. You can also pick your favourite posts and download one for yourself - the URL
		 you will get can be linked everywhere, so you can supply your users a mobile-ready site for offline reading of your top content.
		 </p>
		 
		 <p><b><i>Before you can use this feature for browsing offline the generated content, you need to edit the .htaccess file in your WordPress root and add the line:</i></b><br />
			

		 <input type ="text" size="100" value="AddType text/cache-manifest .manifest" /><br /><br />
		
		You can learn <a target="_blank" href="http://diveintohtml5.info/offline.html">here</a> why this is needed.</p>
		 
		 <p>
			   
		<p>You can enable this button for logged in, or for all site users.</p> 	   
		<p> <select name="mpl_enable_mobile">
				<option value="<?php echo get_option('mpl_enable_mobile'); ?>">  <?php $mpl_enable_mobile = get_option('mpl_enable_mobile');
				      echo $mpl_enable_mobile;
					?>
					</option>
				<option value="DISABLED">Disable</option>
				<option value="ONLY-LOGGED-IN">Enable for Logged in users only </option>
				<option value="ENABLE-ALL-USERS">Enable for All site users</option>
			</select>
		   </p>
		    
		    
		    
		    <p>
			    You can set here the contents of the app's About tab. HTML tags are allowed. </p>
		    <p>
			    <textarea name="mpl_mobile_about_content" rows="10" cols="50"><?php echo get_option('mpl_mobile_about_content') ?></textarea>
		    </p>
		     
		      <hr />
			      <p><input type="submit" value="<?php _e('Save All Changes') ?>"/></p>
		    
    </form>
</div>
<?
}




 
