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
	<?php responsive_footer_top(); ?>
    <div id="footer-wrapper">
        <div id="khung-menu-footer">         
                <div id="flag-footer">                       
                   <a href="#"> <img src="<?php echo bloginfo('template_directory');?>/images/footer-flag.png" alt="<?php _e('Tìm việc làm,tuyển dụng, việc làm hcm, tim viec lam, tuyen dung');?>"/></a>
                </div>                
                 <div id="flag-footer">
                    <a id="conten-down-flag" href="#top" title="<?php _e('Tìm việc làm,tuyển dụng, việc làm hcm, tim viec lam, tuyen dung');?>"> <?php _e('Developed and operated by a team of Vietnamese and Japanese');?></a>
                </div>                
                <!--Menu bottom-->
        		 <div class="menu-footer-menu-footer">
                		<?php if (has_nav_menu('footer-menu', 'responsive')) { ?>
                	        <?php wp_nav_menu(array(
                				    'container'       => '',
                					'fallback_cb'	  =>  false,
                					'menu_class'      => 'footer-menu',
                					'theme_location'  => 'footer-menu')
                					); 
                				?>
                         <?php } ?>
                 </div><!-- end of col-540 -->
                <!--Menu bottom-->
                <?php get_sidebar('colophon'); ?>
                <div id="share-menu" >
                         <div id="creativsocial">                		
                                 <ul class="social-icons">
                                    <div class="addthis_toolbox addthis_default_style addthis_32x32_style">
										<li>
											<a  rel="nofollow" class="lineit_button">
											<script type="text/javascript" src="http://media.line.naver.jp/js/line-button.js?v=20130508" ></script>
											<script type="text/javascript">
											new jp.naver.line.media.LineButton({"pc":false,"lang":"en","type":"d"});
											</script>
											</a>
										</li>
                                        <li ><a rel="nofollow" class="addthis_button_facebook"></a></li>
                                        <li ><a rel="nofollow" class="addthis_button_twitter"></a></li>
                                        <li><a rel="nofollow" class="addthis_button_google_plusone_share"></a></li>
                                        <li><a rel="nofollow" class="addthis_button_blogger"></a></li>
                                        <li><a rel="nofollow" class="addthis_button_email"></a></li>
                                        <li><a rel="nofollow" class="addthis_button_gmail"></a></li>
                                        <li><a rel="nofollow" class="addthis_button_yahoomail"></a></li>
                                        <li><a rel="nofollow" class="addthis_button_google"></a></li>
                                        <li><a rel="nofollow" class="addthis_button_zingme"></a></li>
                                        <li><a rel="nofollow" class="addthis_button_compact"></a></li>
                                        </div>
                                    <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=undefined"></script>
<!-- AddThis Button END -->
                                </ul><!-- end of .social-icons -->
                         </div><!-- end of col-380 fit creativsocial -->
                         <div id="clear"></div>
                 </div><!-- end share-menu -->
                 
        		 <div id="clear">
                 </div>      
       </div><!---Khung Bao menu footer --->
		<div class="grid col-540"></div>		
       <div class="grid col-300 scroll-top hide"><a href="#scroll-top" title="<?php  esc_attr_e( 'scroll to top', 'responsive' ); ?>"><?php //_e('Top &nbsp;','responsive');?><img src="<?php echo bloginfo('template_directory');?>/images/top-arrow.png"/> <?php/* _e( '&uarr; &copy;', 'responsive' );*/ ?></a></div> 
        <div id="clear"></div>
    </div><!-- end #footer-wrapper -->  
	<?php responsive_footer_bottom(); ?>
</div><!-- end #footer -->
<?php responsive_footer_after(); ?>
<?php wp_footer(); ?>
</div>
</body>
</html>