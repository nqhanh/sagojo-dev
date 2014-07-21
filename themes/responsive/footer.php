<?php

// Exit if accessed directly
if ( !defined('ABSPATH')) exit;

/**
 * Footer Template
 *
 *
 * @file           footer.php
 * @package        Responsive 
 * @author         Emil Uzelac 
 * @copyright      2003 - 2013 ThemeID
 * @license        license.txt
 * @version        Release: 1.2
 * @filesource     wp-content/themes/responsive/footer.php
 * @link           http://codex.wordpress.org/Theme_Development#Footer_.28footer.php.29
 * @since          available since Release 1.0
 */

/* 
 * Globalize Theme options
 */
global $responsive_options;
$responsive_options = responsive_get_options();
?>
		<?php responsive_wrapper_bottom(); // after wrapper content hook ?>
    </div><!-- end of #wrapper -->
    <?php responsive_wrapper_end(); // after wrapper hook ?>
</div><!-- end of #container -->
<?php responsive_container_end(); // after container hook ?>
</div><!---End wapper_mobile-->
<div id="footer" class="clearfix">
<div class="footer-top">
	<?php responsive_footer_top(); ?>
    <div id="footer-wrapper">
             <div id="footer-id">
                <!--Menu bottom-->
				
        		 <div id="menu_main_footer" class="post_list next_news col-220 ">
				 <div class="widget-title"><?php _e('sagojo&rsquo;s apps', 'responsive'); ?></div>
					<div>
							<!---<a href="https://itunes.apple.com/vn/app/horoscope/id862253396?mt=8&ign-mpt=uo%3D4"><img src="<?php //echo bloginfo('template_directory');?>/images/logo_appstore.png" width="132px"></a>
							<a href="https://play.google.com/store/apps/developer?id=sagojo"><img src="<?php //echo bloginfo('template_directory');?>/images/logo_googleplay.png" width="132px"></a>-->
						<?php 	
							$cat=196;
							  $services_link =new WP_Query('showposts=3&cat='.$cat);
								while($services_link->have_posts()): $services_link->the_post(); 
							?>
							<div id="post-<?php the_ID(); ?>" class="dv-home">
								<h2 id="entry-title"><a href="<?php the_permalink();?>"><?php the_title();?></a></h2>
								<?php if ( has_post_thumbnail() ) : ?>
										<div class="entry-thumbnail">
											<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" >
												<?php the_post_thumbnail( 'thumb-featured' ); ?>
											</a>
										</div>
									<?php endif; ?>
							<?php endwhile; wp_reset_postdata();?>
							</div>
							
					</div>
                 </div><!-- end of col-220 -->
				 <div class="post_list next_news col-220">
				 <div class="widget-title"><?php _e('Menu', 'responsive'); ?></div>
                		<?php if (has_nav_menu('footer-menu', 'responsive')) { ?>
                	        <?php wp_nav_menu(array(
                				    'container'       => '',
                					'fallback_cb'	  =>  false,
                					'menu_class'      => 'footer-menu',
                					'theme_location'  => 'footer-menu')
                					); 
                				?>
                         <?php } ?>
				 
                 </div><!-- end of col-220 -->
				
				 <div class="followus col-460 fit">
				 <div class="widget-title"><?php _e('About sagojo', 'responsive'); ?></div>
					<div class="sagojoapp">
						
						<p style="font-size: 15px;margin:0px;">
						<?php _e('Developed and operated by a team of Vietnamese and Japanese');?>
						<!--<em>sagojo.com</em> là cơ quan <strong>tuyển dụng</strong> được thành lập và phát triển bởi các chuyên gia Việt Nam và Nhật Bản-->
						</p>
						<p><?php _e('Business Description: Staffing service - Consultation for medical field - Home visit nursing service - Smart phone app development - Job matching web site www.sagojo.com', 'responsive');?>
						</p>
						<img src="<?php echo bloginfo('template_directory');?>/images/icon-google.png">
						<a href="https://www.facebook.com/sagojocom"><img src="<?php echo bloginfo('template_directory');?>/images/icon-facebook.png"></a>
						<p>
								<strong class="indam" style="color: #333;"><span><a href="http://sagojo.com">TUYEN DUNG</a>,</span></strong>
								<strong class="indam"><span><a href="http://sagojo.com/viec-lam">TIM VIEC LAM</a>,</span></strong>
								<strong class="indam"><span><a href="http://sagojo.com">VIỆC LÀM</a>,</span></strong>
								<strong class="indam"><span><a href="http://sagojo.com/vi/tim-viec-lam-online/">TIM VIEC ONLINE</a>,</span></strong>
								<strong class="indam"><span><a href="http://sagojo.com">TÌM VIỆC LÀM</a>,</span></strong><br/>
								<strong><span><a href="http://sagojo.com/vi/thong-tin-tuyen-dung-viec-lam-chia-khoa-giup-ban-tim-viec-thanh-cong/">THÔNG TIN TUYỂN DỤNG</a>,</span></strong>
								<strong><span><a href="http://sagojo.com">TUYỂN DỤNG</a>,</span></strong>
								<strong><span><a href="http://sagojo.com/vi/nam-bat-co-hoi-tu-tim-viec-lam-online/">VIEC LAM ONLINE</a></span></strong>
						</p>								
					</div>
				 </div>
                <!--Menu bottom-->
                
                 
        		 <div id="clear">
                 </div>      
       </div><!---Khung Bao menu footer --->
				
       
    </div><!-- end #footer-wrapper -->
	
	<?php responsive_footer_bottom(); ?>
</div>
</div><!-- end #footer -->
<div class="footer-address">
	<div class="footer-block">
		<?php _e('Copyright © A-LINE ltd. and A-LINE Vietnam Co., Ltd.<br/>
		8F, Room 801, Zen Plaza, 54-56 Nguyen Trai, Ben Thanh Ward, District 1, HCM City, Vietnam.', 'responsive');?>
	</div>
</div>
		<!--Neu la nguoi tim viec-->
		<?php //if (!is_front_page()) :?>
		<?php  if(!get_user_meta(wp_get_current_user()->ID, "is_employer")):  ?>
			<?php get_sidebar('left');?>		
		<?php endif;//endif;?>
		<!--End neu la nguoi tim viec-->
<?php responsive_footer_after(); ?>
<?php wp_footer(); ?>
</div>

</body>
</html>