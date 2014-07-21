<?php
session_start();
/* 
 * 
 * Wordpress code to check wheather user is Online or not  - by S V N Labs Softwares (svnlabs@gmail.com) (blog.svnlabs.com)
 * This is not a wordpress plugin, just a simple code to display user online status on blog or site  ;)
 * 
 
** User Online Status check Table   
  
CREATE TABLE `wp_users_online` (
  `user_id` int(11) default NULL,
  `full_name` varchar(64) NOT NULL default '',
  `session_id` varchar(128) NOT NULL default '',
  `ip_address` varchar(15) NOT NULL default '',
  `time_entry` varchar(14) NOT NULL default '',
  `time_last_click` varchar(14) NOT NULL default '',
  `last_page_url` varchar(255) NOT NULL default ''
) ENGINE=MyISAM;

** Uses

STEP 1: Add these 2 lines in header.php of wordpress theme file

include("wordpress_users_online.php");
update_user_online();

STEP 2: Call function is_online() with $user_id for which we have to check online status 
  
is_online($user_id);  
  
*/

define('TABLE_USERS', 'wp_users');
define('TABLE_USER_ONLINE', 'wp_users_online');

  function update_user_online() {
    //global $user_id;
    
    global $current_user;
    get_currentuserinfo();

    if ($current_user->ID && $current_user->user_login) {

      $wo_user_id = $current_user->ID;
      $wo_full_name = $user['user_nicename'];

    } else {
      $wo_user_id = '';
      $wo_full_name = 'Guest';
    }

    $wo_session_id = session_id();
    $wo_ip_address = getenv('REMOTE_ADDR');
    $wo_last_page_url = getenv('REQUEST_URI');

    $current_time = time();
    $xx_mins_ago = ($current_time - 300); 
    
// remove entries that have expired
    mysql_query("delete from " . TABLE_USER_ONLINE . " where time_last_click < '" . $xx_mins_ago . "'");

    $stored_user_query = mysql_query("select count(*) as count from " . TABLE_USER_ONLINE . " where session_id = '" . mysql_escape_string($wo_session_id) . "'");
    $stored_user = mysql_fetch_array($stored_user_query);

    if ($stored_user['count'] > 0) {
      mysql_query("update " . TABLE_USER_ONLINE . " set user_id = '" . (int)$wo_user_id . "', full_name = '" . mysql_escape_string($wo_full_name) . "', ip_address = '" . mysql_escape_string($wo_ip_address) . "', time_last_click = '" . mysql_escape_string($current_time) . "', last_page_url = '" . mysql_escape_string($wo_last_page_url) . "' where session_id = '" . mysql_escape_string($wo_session_id) . "'");
    } else {
      mysql_query("insert into " . TABLE_USER_ONLINE . " (user_id, full_name, session_id, ip_address, time_entry, time_last_click, last_page_url) values ('" . (int)$wo_user_id . "', '" . mysql_escape_string($wo_full_name) . "', '" . mysql_escape_string($wo_session_id) . "', '" . mysql_escape_string($wo_ip_address) . "', '" . mysql_escape_string($current_time) . "', '" . mysql_escape_string($current_time) . "', '" . mysql_escape_string($wo_last_page_url) . "')");
    }
  }
  
  
  function is_online($user_id) {  
  
    $stored_user_query = mysql_query("select user_id from  ".TABLE_USER_ONLINE."  where user_id = '" . mysql_escape_string($user_id) . "'");
    $stored_user = mysql_fetch_array($stored_user_query);
    
    if(isset($stored_user['user_id']))
      $online = '<img src="'.site_url().'/wp-content/themes/responsive/images/online.png" style="width:19px;border:none;" />&nbsp;Online'; 
    else
      $online = '<img src="'.site_url().'/wp-content/themes/responsive/images/offline.png" style="width:19px;border:none;" />&nbsp;Offline';
                     
    
    return $online; 
  
  }
  
?>