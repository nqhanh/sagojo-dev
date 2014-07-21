<?php
/*
Template Name: My Info
*/
get_header(); ?>
<?php $user_id = get_current_user_id();?>
<?php
			 $args = array(
			'author' => get_current_user_id(),
			'user_id' => get_current_user_id() ,
			'post_type' => 'freelance_post',
			);
			$the_query = new WP_Query( $args );
			$comments = get_comments($args);
?>

<?php
// visiting or owning this page ??
global $wp_query;
$auth = $wp_query->get_queried_object();
//echo "<h2>page about</h2>";
//print_R($auth);

$current_user = wp_get_current_user();
$loggedin_id = $current_user->ID;
//echo "<h2>visitor</h2>";
//print_R($current_user);

$um = get_user_meta($auth->ID);
//echo "<h2>user meta</h2>";
//print_R($um);


?>
 <div id="primary" class="content-area">
<div id="content" class="site-content" role="main">
<!--<h1><?php //echo $auth->display_name;?></h1>-->

		<div class='freelance-single'>				
			<?php if ($current_user->user_login === $auth->user_login)  include('personal.php'); 
			//include('personal.php');
			?>
			
			<?php include('authorinfo.php'); ?>
						
		</div>
		

    
</div> <!-- end #content -->
<!--Begin widget-->
 
       
</div>
<?php get_sidebar(); ?>    
<?php get_footer(); ?>