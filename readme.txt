=== My Posts List with Offline Browsing ===
Contributors: rioloft
Tags: HTML5,pages,posts,list,mobile,offline,pdf,iphone,cart,jquery,javascript,html5,favorite
Requires at least: 3.0.1
Tested up to: 3.5.1
Stable tag: 2.0
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Let users build a list of their favorite posts/pages from the site and share their list on Facebook, via E-Mail, or  download content as a Web-app for offline reading.

== Description ==

Upon plugin activation, an "Add to your list" link with a star is automatically added at the end of each post and page.

Clicking this link will pop-out a list on the bottom right of the screen, and add the current post or page to the list.

This list is saved via HTML5 storage to the browser so it will be available also in the future to the user.

You can allow all users, or only logged users to perform some actions:

1. Sharing of the list via Facebook.
2. One-click iPhone-ready Content download of the selected posts in the user list as a simple Web app,
ready for offline browsing via mobile devices
3. Sharing of the list via email.

You can see a working demo here:
http://www.rioloft.com/rio-guide/

== Installation ==
 

1. Use the 'Plugins' > 'Add New' > 'Upload' WordPress feature from the WordPress admin panel to upload the plugin's ZIP file.
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Open a single post or a page of your site, you should see an "Add to your list" link
4. To enable sharing actions or Mobile site generation, please visit the plugin Settings page ('Settings' > 'My Post List')
 

== Frequently Asked Questions ==

= Will the list available when the user comes back? =

Yes, using HTML5 Storage, every user can create his post list and keep it stored in his browser.

= Does the user need to login to build a list? =

No, but you can specify that only logged users can use the sharing features, or the Web-app generation feature.

  


= My web-app does not allow offline browsing =

Did you edit your .htaccess file adding the line specified in the Plugin's Settings?
Other explanation may be that you need to let it download the whole content after opening the icon.
Delete the icon / clean cache and download again the app.

= I do not see the Email button / Facebook Share button / the Web-app button in my list =

You need to enable this feature in the Settings menu of the panel.

= Can I use this plugin to build a simple mobile version of my site? =

Yes, just follow these steps:

1. Enable the Offline Web-app generation in the Settings panel, remember to edit your .htaccess file as specified.
2. Go to your site. Add all the posts/pages you want to include in your Mobile mini-application using the 'Add to your list' link that is placed after every single post and page.
4. Please note that only the featured image will be used in each post to spice up your post. The more posts you select and add to your list, the heavier the app will be during the first download.
5. Click the "Web App" button inside the list. A new window will be opened.
6. Copy the URL and link it in a page where you can describe your mobile app, or link it from your sidebar. This is the URL of the mobile version.
7. Iphone users, when opening this link, will be able to browse very quickly this content, and will be prompted to add this application to their home
screen with a cool animation courtesy of cubiq.org
8. You can create as many web-apps you want for example with the top posts from each category.
 
== Changelog ==

= 1.0 =
*  First public Release.
= 1.01 =
*  Fixed publishing issues due to new name of plugin.
= 2.0 =
*  Added email sharing, Facebook sharing, redesigned interface. Removed PDF feature whichh didn't perform well.
     