=== Plugin Name ===
Contributors: djarzyna
Donate link: http://www.djdesign.de/djd-site-post-plugin-en/
Tags: quick post, frontend, front end, insert post, post, front end post, guest post
Requires at least: 3.3.1
Tested up to: 3.5.2
Stable tag: 0.6
License: GPLv2 or later

Write and edit (in an upcoming release) a post at the front end without leaving your site. Supports guest posts.

== Description ==

Add a (responsive) form to your site to write a post without having to go into the admin section. It allows for 'anonymous' or 'guest' posting (not logged in users). This makes DJD Site Post a perfect plugin for user generated content. 

After installation and activation you can display a form on your site via shortcode.

Right now the plugin's author is working on a release that even enables you to edit existing posts on the site. It will include other new features (e.g. a widget) as well. So make sure you check out the plugin's home page from time to time.

DJD Site Post is translation ready. Languages already included: English and German.

Now the plugin has a widget to include the form in a sidebar. 

Upcoming Features:

* Edit or delete existing posts from front end.
* Some "skins" (css)
* Captcha for guest posts 

== Installation ==

1. Unzip djd-site-post.zip
2. Upload all the files to the `/wp-content/plugins/djd-site-post` directory.
3. Activate the plugin through the 'Plugins' menu in WordPress.
4. Customize the plugin. To do so click `DJD Site Post` in the WordPress `Settings` menu.
5. Include the shortcode [djd-site-post] in the post or page were you want to display the form.

== Frequently Asked Questions ==

No questions asked so far.

== Screenshots ==

1. screenshot-1.jpg DJD Site Post in action (Theme: 'TwentyTwelve'): inserted in an ordinary page using the shortcode.
2. screenshot-1.jpg DJD Site Post Settings Panel in common WordPress style.

== Changelog ==

= 0.6 =

New features and changes

* After posting the user will be redirected to home_url. You can overwrite this default redirect by entering an url in the field 'Redirect To' in the plugin's settings panel. You could also specify the url to redirect to in the shortcode: [djd-site-post success_url='your url']. It might be a good idea to redirect to your blog page so that the user can see his post immediately (provided you permit publishing). Otherwise you could build a success page and redirect to that. Maybe there you should write something like "Thank you for your contribution. We will review your post and publish it if appropriate".
* By selecting Droplist as the method to display categories you will now get child categories below their parent categories.
* Since this question came up a couple of times: The plugin supports featured images for quite a long time now. You just have to find your way in WordPress' standard media uploader ...
* The widget displays an editor similar to WordPress' QuickPress. So you don't get all those fancy buttons of the visual editor there. I had to do it this way because - I admit it - I couldn't get this buttons to work nicely in Chrome. Long term solution might be to switch editors ...
* Extended the max lenght of the fields name (of the guest) and email to 40 characters.
* To do the same as WordPress does the plugin now permits posts without titles. The default still requires the user to enter a title though. If you wish to disable this enforcement just uncheck 'Require a Titel' in the plugin's settings panel.

Bug fixes:

* Long form title breaking container in IE.

= 0.5 =

This release comes with a couple of new features and some important changes.

* Guests get some capabilities similar to the user role of subscriber plus the right to publish (pending) posts. Guests are not allowed to upload media.
* On the plugin's settings page you can specify that the site-post form requires guests to enter their email and name. The information is stored in two custom fields: guest_name and guest_email.  
* On the plugin's settings page you can specify a default category for guest posts or give guests the freedom to select categories themselves.
* Media upload works for logged-in users only. That means users have to register first. I had to do this for security and management reasons.
* The plugin adds the capability to upload media to the user role of contributor. So if you want to grant users the right to upload media you have to assign as minimum the contributor role to them. You can do this during user registration (in WP's Settings->General just set New user Default Role to Contributor).
* Since the media upload works for logged-in users only the plugin (on the plugin's settings page) gives you the ability to hide the WordPress adminbar (now called toolbar).
* On the plugin's settings page you can specify to display a link to WP's login form right inside the site-post form. After login the user will be redirected to the original page again. 

Bug fixes:

Media uploads (attachments) are now assigned to the post they belong to and not to the page were the site-post form resides.

What I didn't come around to yet is implementing a functions to block the loading of the widget and the form on the same page. Both on the same page will not work. So for now be careful not to load the form on pages where the widget exists already (or the other way around).)    

= 0.4 =

A couple of minor bug fixes.

= 0.3 =

New features:

* Included a widget to put the form into the sidebar.

Bug fixes:

* Fixed an issue with a coditional statement that caused an error when running on PHP prior version 5.3.

= 0.2 =

Bug fixes:

* With guest posts the field "author" was left empty. Now it displays the author info out of account you've selected to use with guest posts.
* Fixed an issue with register_uninstall_hook that caused a warning when debug was enabled.

= 0.1 =
The initial release thrown into public.

== Upgrade Notice ==

Nothing yet.