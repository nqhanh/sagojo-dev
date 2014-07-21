<?php
/**
 * Full Content Template
 *
   Template Name: Freelance Page
 *
 * @file           freelancepage.php
 * @package        Responsive 
 * @author         sagojo.com  
 * @copyright      2003 - 2011 ThemeID
 * @license        license.txt
 * @version        Release: 1.0
 * @filesource     wp-content/themes/responsive/freelancepage.php
 * @link           http://codex.wordpress.org/Theme_Development#Pages_.28page.php.29
 * @since          available since Release 1.0
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
		<li class="current"><a href="<?php echo site_url()?>/freelance-page/"><?php _e('Opening Projects','responsive');?></a></li>
		<li><a href="<?php echo site_url()?>/closed-projects/"><?php _e('Closed Projects','responsive');?></a></li>
		<li><a href="<?php echo site_url()?>/freelance-archives/"><?php _e('Categories','responsive');?></a></li>
		<li class="like_this_button"><a href="<?php echo site_url()?>/jobs/"><?php _e('<strong>Post a Project</strong> - It&rsquo;s FREE!',  'responsive' ) ;?></a></li>
	</ul>
</div>
<div id="content" class="grid col-620 ">
       <div id="freelance-page">
					<div class='index-title'>
						<div class='jobline'>
							<div class='time'><strong><?php _e( 'Posted', 'responsive' ); ?></strong></div>
							<div class='link'><strong><?php _e( 'Job description', 'responsive' ); ?></strong></div>
							
							<div class='budget'>				
								<?PHP /*if ($_GET['budget'] == 'ltoh')
								{ echo "<a href='".$_SERVER["REQUEST_URI"].'/?budget=htol' .  "' title='" . __('Select budget from high to low', 'responsive') . "'>"; }
								else
								{ echo "<a href='".$_SERVER["REQUEST_URI"]. '/?budget=ltoh' . "' title='" . __('Select budget from low to high', 'responsive') . "'>"; }*/
								?>
								<strong><?php _e( 'Budget', 'responsive' ); ?></strong>
								<?PHP echo "</a>"; ?>				
							</div>
							
							<div class='deadline'><strong><?php _e( 'Bids', 'responsive' ); ?></strong></div>
						</div>
					</div> 
					
					<?php 
						// only show freelance_post in the box
						global $wp_query;
						
						$paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;
						$myposts = get_freelance_posts('numberposts=-1&meta_key=estimatechosen');
						//$expiresposts = get_freelance_posts('numberposts=-1&meta_key=is_expires');
						
						$result = array();
						
						foreach($myposts as $mypost) {
							setup_postdata($mypost);
							$result[] = $mypost->ID;
						}
						
						/*foreach($expiresposts as $expirespost) {
							setup_postdata($expirespost);
							$result[] = $expirespost->ID;
						}*/
						
						if ($_GET['budget'] == 'ltoh')
							{
							$args = array(
								'post_type'      => 'freelance_post',
								'paged'  		 => $paged,
								'meta_key'       => 'cf_budget',
								'orderby'        => 'meta_value_num',
								'order'          => 'ASC',					
								);
							}
						if ($_GET['budget'] == 'htol')
							{
							$args = array(
								'post_type'      => 'freelance_post',
								'paged'  		 => $paged,
								'meta_key'       => 'cd_budget',
								'orderby'        => 'meta_value_num',
								'order'          => 'DESC',					
								);
							}	
						else 
							{
							$args = array(
								'post_type'      => 'freelance_post',
								'paged'  		 => $paged,
								//'meta_key'		 => 'estimatechosen',
								'post__not_in' => $result,
								//'author'	 => '4',
								);	
							}
							
						//query_posts($args);
						$the_query = new WP_Query( $args );
						//print_R($the_query);
						if ( $the_query->have_posts() ) : 
						?>

						<?php /* Start the Loop */ ?>
						<?php while ( $the_query->have_posts() ) : $the_query->the_post();?>

							<?php
								/* Include the Post-Format-specific template for the content.
								 * If you want to overload this in a child theme then include a file
								 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
								 */
						 get_template_part( 'content-index', get_post_format() ); ?>
							

						<?php endwhile; 
						// Reset Post Data
						
						?>
						
						<?php if (function_exists("majormedia_pagination")) {
								majormedia_pagination(); 
						} elseif (function_exists("majormedia_content_nav")) { 
									majormedia_content_nav( 'nav-below' );
						wp_reset_postdata();			
						}?>

					<?php
					
					else : ?>

						<div class="no-jobs-yet">
							<h5><?php _e( 'There are no jobs yet.', 'responsive' ); ?></h5>
								<p><?php _e( 'Need some work done? Post a Project Today.', 'responsive' ); ?></p>
								<div class="post_free"><div class="title"><a href="<?php echo site_url()?>/jobs/"><?php _e('Post a Project',  'responsive' ) ;?></div><div class="content"><?php _e('It&rsquo;s free!',  'responsive' ) ;?></div></a></div>
								<?php //get_search_form(); ?>
							</div><!-- .entry-content -->

					<?php endif; ?>
			</div><!------End Freelance-page --->
		</div><!-- #content -->
		
	<?php get_sidebar(); ?>

<?php get_footer(); ?>