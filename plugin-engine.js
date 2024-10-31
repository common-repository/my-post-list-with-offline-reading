function getURLParameterByName(name) {
    name = name.replace(/[\[]/, "\\\[").replace(/[\]]/, "\\\]");
    var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),
        results = regex.exec(location.search);
    return results == null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));
}

		
 jQuery(function(){ //DOM Ready
		
										
											
                                                                                        
                                                                                        
											
											if (localStorage.mypostarray) jQuery("#view-your-list").fadeIn(1000);
											
                                                                                        
                                                                                        
                                                                                        var mplposts=getURLParameterByName("mplposts");
                                                                                        if (mplposts) { //query string values are set, I need to populate the list - FB sharing logic USELESS
                                                                                                     
                                                                                                      var mplposts_array = mplposts.split("-");
                                                                                                  //   alert(mplposts_array[0]);
                                                                                        }
                                                                                        
											function PopulateTheList()
											{
												
												jQuery("#your-posts-list").empty();
												jQuery("#your-posts-list-container").show();
												  jQuery("#view-your-list").hide();
												//jQuery("#your-posts-list").html(localStorage.mypostarray);
												if (!localStorage.mypostarray) return;
												localObj = JSON.parse(localStorage.mypostarray);
												var post_ids_csv="";
												jQuery.each(localObj, function(index, obj){
																							
																											//  alert(obj);
																											//obj.reverse();
																											 jQuery.each(obj, function(i, val) {
																														//alert(val)
																														var postDataArray = val.split('||||');
			
																														 
																														jQuery("#your-posts-list").append("<a class='load-post' href='"+postDataArray[1]+"'>"+postDataArray[2]+"</a>");
																														post_ids_csv=post_ids_csv+postDataArray[0]+",";
																													  });
																									  
													 
																						 });
												 
											jQuery("#download-post-list-as-pdf").attr("href","?action=mobile_post_list&pdf=1&posts="+post_ids_csv);
											jQuery("#download-post-list-as-web-app").attr("href","?action=mobile_post_list&posts="+post_ids_csv);
                                                                                        jQuery("#download-post-list-as-email").attr("href","?action=email_post_list&posts="+post_ids_csv);
                                                                                       var old_facebook_url=jQuery("#send-post-list-to-facebook").attr("data-href");
                                                                                        jQuery("#send-post-list-to-facebook").attr("href",old_facebook_url+"?k="+post_ids_csv);
											}
					

										 
                                                                                   
                                                                                   
                                                                                    jQuery("#download-post-list-as-email").live("click",function(e){
													  e.preventDefault();
													  jQuery("#send-email-list-div").fadeIn(1000);
                                                                                                              jQuery("#send-email-list-div-opaque-layer").fadeIn(1500);
										   });
                                                                                    
                                                                                    
                                                                                    
                                                                                    jQuery("#trigger-list-send-to-email").live("click",function(e){
													  e.preventDefault();
                                                                                                          var theUrl=jQuery("#download-post-list-as-email").attr("href");
                                                                                                          var theEmailFrom=jQuery("#your-email-field").val();
                                                                                                          var theEmailTo=jQuery("#your-friend-email-field").val();
                                                                                                          
                                                                                                          var theMsg =jQuery("#mplist-message-field").val();
                                                                                                           var theMsg = encodeURIComponent(theMsg); 
                                                                                                          var theParameters="&from="+theEmailFrom+"&to="+theEmailTo+"&msg="+theMsg;
                                                                                                          //  alert(theMsg);
													  jQuery("#mpl-email-list-action-result").load(theUrl+theParameters); 
										   });
                                                                                    
                                                                                    
                                                                                   jQuery("#your-email-field").live("blur",function(e){
													  
                                                                                                          var theEmailFrom=jQuery("#your-email-field").val();
													  jQuery("#your-friend-email-field").val(theEmailFrom);
													  
										   });
                                                                                    
                                                                                    
                                                                                      jQuery("#close-send-email-list-div").live("click",function(e){
													  e.preventDefault();
                                                                                                        	  jQuery("#send-email-list-div").fadeOut(1000);
                                                                                                                    jQuery("#send-email-list-div-opaque-layer").fadeOut(1500);
													  
										   });
                                                                                    
                                                                                    
                                                                                    
                                                                                    jQuery("#mpl-about-list").live("click",function(e){
                                                                                                           e.preventDefault();                                                                   
													  jQuery("#mpl-about-list-div").show();
													  //
										   });
                                                                                    
                                                                                    
                                                                                    
                                                                                    
                                                                                     jQuery("#mpl-close-about").live("click",function(e){
                                                                                                           e.preventDefault();                                                                   
													  jQuery("#mpl-about-list-div").hide();
													  //
										   });
                                                                                    
                                                                                    
                                                                                   jQuery("#close-your-list").live("click",function(e){
													  e.preventDefault();
													  jQuery("#your-posts-list-container").hide();
													  jQuery("#view-your-list").show();
													  //
										   });
										   
										      jQuery("#view-your-list a").live("click",function(e){
													  e.preventDefault();
													  jQuery("#your-posts-list-container").show();
													  PopulateTheList();
													  jQuery("#view-your-list").hide();
													  //
										   });
											  
											  
											     jQuery("#mpl-read-more").live("click",function(e){
													  e.preventDefault();
													  jQuery("#mpl-help").fadeIn();
													   
													  //
										   });
												   jQuery("#mpl-close-help").live("click",function(e){
													  e.preventDefault();
													  jQuery("#mpl-help").fadeOut();
													   
													  //
										   });
												 
												 
												
												 
											      jQuery("#empty-your-list").live("click",function(e){
													  e.preventDefault();
													 // alert("Erased!");
													localStorage.clear();
													 PopulateTheList();
                                                                                                          //jQuery("#view-your-list").hide();
													   jQuery("#your-posts-list-container").fadeOut(1000);
													   jQuery(".add-to-post-list").fadeIn(1000);
										   });


 

											//article add to list
										  
										  
										   jQuery(".add-to-post-list").live("click",function(e){
														
														e.preventDefault();
														jQuery(this).fadeOut();
														var the_url=jQuery(this).attr("href");
														
														
														var the_title= jQuery(this).attr("data-posttitle");
														
														 
														var the_post_id=jQuery(this).attr("data-postid");
														
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

																		}
																	  else
																		{
																		alert("Sorry, a HTML5 browser is needed. Get FireFox, Google Chrome, or Safari. Come back soon!");
																		}
  
   
													 
													  });
		});
			