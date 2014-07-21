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
<div class="nav">
	<ul>
		<li><a href="<?php echo site_url()?>/freelance-page/"><?php _e('Opening Projects','responsive');?></a></li>
		<li><a href="<?php echo site_url()?>/closed-projects/"><?php _e('Closed Projects','responsive');?></a></li>
		<li><a href="<?php echo site_url()?>/freelance-archives/"><?php _e('Categories','responsive');?></a></li>
		<li class="current"><a href="#"><?php _e('User&rsquo;s Info','responsive');?></a></li>
		<li class="like_this_button"><a href="<?php echo site_url()?>/jobs/"><?php _e('<strong>Post a Project</strong> - It&rsquo;s FREE!',  'responsive' ) ;?></a></li>
	</ul>
</div>
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
 <script src="<?php echo site_url()?>/wp-content/themes/responsive/js/jquery.responsiveTabs.js" type="text/javascript"></script>
<!-- jsProgressBarHandler prerequisites : prototype.js -->
<script type="text/javascript" src="<?php echo site_url()?>/wp-content/themes/responsive/js/prototype/prototype.js"></script>
<!-- jsProgressBarHandler core -->
<script type="text/javascript" src="<?php echo site_url()?>/wp-content/themes/responsive/js/bramus/jsProgressBarHandler.js"></script>
<script type="text/javascript">
	var j = jQuery.noConflict();
</script>
<div id="content" class="grid col-620 ">
<h1><?php echo $auth->display_name;?></h1>
		<div class='freelance-single'>				
			<?php if ($current_user->user_login === $auth->user_login)  include('personal.php'); 
			//include('personal.php');
			?>
			
			<?php include('authorinfo.php'); ?>
						
		</div>
</div> <!-- end #content -->
<!--Begin widget-->
<?php if ($the_query->have_posts()) {?>
<style>
.span2 ~ .bidder,
.span3 ~ .bidder{
	display: none;
	border: 1px solid #ccc;
	margin-top: 3px;
	padding: 5px;
}
.span2 ~ .lister,
.span3 ~ .lister{
	display: block;
	border: 1px solid #ccc;
	margin-top: 3px;
	padding: 5px;
}
</style>
<?php } ?>
<?php if ($comments) {?>
<style>
.span2 ~ .bidder,
.span3 ~ .bidder{
	display: block;
	border: 1px solid #ccc;
	margin-top: 3px;
	padding: 5px;
}
.span2 ~ .lister,
.span3 ~ .lister{
	display: none;
	border: 1px solid #ccc;
	margin-top: 3px;
	padding: 5px;
}

</style>
<?php } ?>
       
        <div id="widgets" class="grid-right col-300 fit">
		<div class="widget-wrapper-freelance">
            
                <div class="widget-title"><?php /*_e('Author', 'responsive');*/ ?></div>
					<ul class="author-profile">
						<li id="author-profile-avatar">
							<al class="gallery">
							<li style="margin: 0;position: relative;width: 287px;height: 100%;">
								<em style="background: #fff;color: #000;font-style: normal;padding: 0px 10px;display: block;position: absolute;top: 10px;left: -11px;border: 1px solid #cccccc;border-left-color: #fff;">
								<?php echo is_online($auth->ID); ?></em>	
								<?php echo get_avatar( $auth->ID, 300  ); ?>
							</li>
							</al>	
						</li>
						<li id="author-profile-name-display"><?php echo $auth->display_name;?></li>	
										
						<?php if ($comments) {?>
						<span class="span3" tabindex="0"><?php _e('Freelancer', 'responsive');?></span>
						<?php } ?>
						<?php if ($the_query->have_posts()) {?>
						<span class="span2" tabindex="0" href="#"><?php _e('Employer', 'responsive');?></span>
						<?php } ?>
						<div class="bidder" >
													
							<li><?php $profilescore = get_user_meta( $auth->id, 'profilescore', TRUE );if (empty($profilescore)) $profilescore = 0;?>
								<?php printf(__('Profilescore: %1$d', 'responsive') , $profilescore , ('responsive')) ; ?>%
								 <progress class="css3" value="<?php echo $profilescore;?>" max="100">
								      <div class="progress-bar">
								        <span style="width:<?php echo $profilescore;?>%;"></span>
								      </div>
							</progress>									
							</li>							
							<li>
							<?php 
							if ($count==0) $count=1;
							printf(__('Winning percentage: %1$d', 'responsive') , $win*100/$count , ('responsive')) ; ?>%
							<progress class="css3" value="<?php echo $win;?>" max="<?php echo $count;?>">
								      <div class="progress-bar">
								        <span style="width:<?php echo $win*100/$count;?>%;"></span>
								      </div>
							</progress>
							</li>
							<li>
							<?php printf(__('Complete percentage: %1$d', 'responsive') , $complete*100/$count , ('responsive')) ; ?>%
							<progress class="css3" value="<?php echo $complete;?>" max="<?php echo $count;?>">
								      <div class="progress-bar">
								        <span style="width:<?php echo $complete*100/$count;?>%;"></span>
								      </div>
							</progress>
							</li>
							<?php /*<li id="author-profile-star"><?php echo allRating($auth->ID,true,false,true,'novote');?></li>*/?>
							<li>
							<?php $text .= __('Rated','responsive').' <span id="outOfFive_'.$auth->ID.'" class="out5Class">'.outOfFive($auth->ID).'</span>/5 ('.getVotes($auth->ID).')';
							echo $text;?>
							<progress class="css3" value="<?php echo outOfFive($auth->ID)?>" max="5">
								      <div class="progress-bar">
								        <span style="width:<?php echo outOfFive($auth->ID)/5;?>;"></span>
								      </div>
							</progress>
							<?php //outOfFive($comment->user_id)?></li>							
						</div>
						<div class="lister" >
													
							<li><?php $profilescore = get_user_meta( $auth->id, 'profilescore', TRUE );if (empty($profilescore)) $profilescore = 0;?>
								<?php printf(__('Profilescore: %1$d', 'responsive') , $profilescore , ('responsive')) ; ?>%
								<progress class="css3" value="<?php echo $profilescore;?>" max="100">
								      <div class="progress-bar">
								        <span style="width:<?php echo $profilescore;?>%;"><?php echo $profilescore;?>%</span>
								      </div>
								 </progress>								
							</li>
							<li><?php printf(__('My project count: %1$d', 'responsive') , $user_post_count , ('responsive')) ; ?>	</li>
							<li id="autho-profile-mycore">
								<?php
								$score = get_user_meta($auth->ID ,'score',TRUE );
								if ($score < 1) $score = "?";
								printf(__('My score: %1$d', 'responsive') , $score , ('responsive')) ;								
								?>
							</li>
							<li id="autho-profile-mycore">
								<?php 		
									$rate = get_user_meta( get_the_author_meta('ID'), 'rating', TRUE ); 
									if (empty($rate) || !is_numeric($rate)) $rate = "-?-";
												_e('Author rating: ', 'responsive' );
										$stars = (int)$rate / 20; if ($stars > 5) $stars = 5;
										for ($q=0;$q < $stars; $q++)
											{
												echo "<img src='" . get_bloginfo('stylesheet_directory') .'/library/images/rating_star.gif' . "' style='margin:0px' >";
											}
										echo "<strong>($rate)</strong>";									
								?>
							</li>
																				
						</div>
												
					</ul>
	
        </div><!-- end of .widget-wrapper -->
<?php /*Freelance Menu by Hanh*/?>  
<div id="wpjb-freelance-menu-2" class="widget-5 widget-odd widget_function_menu widget-wrapper widget_wpjb-freelance-menu">
<div class="widget-title">
      My sagojo
    </div>
<span class="icon-arrow-down"> </span>
<ul id="wpjb_widget_resumesmenu" class="wpjb_widget">
<!--Neu la nha tuyen dung-->

<!--Begin Freelance Menu-->
	<?php $user_id = get_current_user_id();?>

	<?php if ($user_id > 0):?>
	<li class="wpjb-li wpjb-underline-top wpjb-boxshow-botton">
        <a class="wpjb-ntdhover-link"  href="<?php echo site_url()?>/jobs/"></a>
        <a class="wpjb-ntd-link" href="<?php echo site_url()?>/jobs/">
            <?php _e("Post Project", WPJB_DOMAIN) ?>
        </a>
        <span class="ui-icon ui-icon-arrow-d ui-icon-shadow"> </span>
    </li>
		<?php if ($the_query->have_posts()):?>
	<li class="wpjb-li wpjb-underline-top wpjb-boxshow-botton">
        <a class="wpjb-ntdhover-link"  href="<?php echo site_url()?>/my-project/"></a>
        <a class="wpjb-ntd-link" href="<?php echo site_url()?>/my-project/">
            <?php _e("My Projects", WPJB_DOMAIN) ?>
        </a>
        <span class="ui-icon ui-icon-arrow-d ui-icon-shadow"> </span>
    </li>
		<?php endif;?>
		<?php if ($comments):?>
	<li class="wpjb-li wpjb-underline-top wpjb-boxshow-botton">
        <a class="wpjb-ntdhover-link"  href="<?php echo site_url()?>/my-estimate/"></a>
        <a class="wpjb-ntd-link" href="<?php echo site_url()?>/my-estimate/">
            <?php _e("My Estimates", WPJB_DOMAIN) ?>
        </a>
        <span class="ui-icon ui-icon-arrow-d ui-icon-shadow"> </span>
    </li>
		<?php endif;?>
	<li class="wpjb-li wpjb-underline-top wpjb-boxshow-botton">
        <a class="wpjb-ntdhover-link"  href="<?php echo home_url() . '/blog/author/' . get_the_author_meta( 'user_login', wp_get_current_user()->ID ); ?>"></a>
        <a class="wpjb-ntd-link" href="<?php echo home_url() . '/blog/author/' . get_the_author_meta( 'user_login', wp_get_current_user()->ID ); ?>">
            <?php _e("My Info", WPJB_DOMAIN) ?>
        </a>
        <span class="ui-icon ui-icon-arrow-d ui-icon-shadow"> </span>
    </li>
	<?php endif;?>	
<!--END Freelance Menu-->	
</ul>
</div>          
</div><!-- end of #widgets -->


<?php get_footer(); ?>