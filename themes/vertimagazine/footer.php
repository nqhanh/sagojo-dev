<?php
/**
 * The template for displaying the footer.
 *
 *
 * @package vertiMagazine theme
 */
?>

<footer>
		<div id="footer_center">
			<div class="footer_item">
				<div class="footer_logo">
                    <img src="<?php $default_logo = get_template_directory_uri() . "/img/logo-default.png";
                    $tl = ((get_option("logo_sus") != '') ? get_option("logo_sus") : $default_logo ); 
                    echo $tl; ?>" alt="<?php bloginfo('description'); ?>"/>
                </div>
				<div class="footer_contact">
					<div class="call"><span>Call us</span><br /><?php $n = (get_option("phone_number") != '' ? get_option("phone_number") : "+1 234 567 890" ); echo $n; ?></div>
					<div class="email"><span>Email us</span><br /><?php $e = (get_option("email")!= '' ? get_option("email") : "aline@aline.jp" ); echo $e; ?></div>
				</div><!--/footer_contact-->
				<div class="copyright">
                	<?php  $cr = ((get_option("copyright") != '') ? get_option("copyright") : "Copyright © <a href='http://sagojo.com'>A-LINE ltd</a>. and <a href='http://sagojo.com/vi/nam-bat-co-hoi-tu-tim-viec-lam-online/'>A-LINE Vietnam Co., Ltd.</a>" ); echo $cr; ?>
				</div>
			</div><!--/footer_item-->
            <div class="footer_item">
			<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Footer One') ) : ?>
			<?php endif; ?>
            </div>
            <div class="footer_item">
			<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Footer Two') ) : ?>
			<?php endif; ?>
            </div>
		</div>
	</footer>
	<?php wp_footer(); ?>
</body>
</html>