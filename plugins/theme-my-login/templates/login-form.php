<?php
/*
If you would like to edit this file, copy it to your current theme's directory and edit it there.
Theme My Login will always look in your theme's directory first, before using this default template.
*/
?>


<div class="login" id="theme-my-login<?php $template->the_instance(); ?>">
<div id="hinh_login">
<div class="formtitle"><?php _e('[:en]Login form[:vi]Form đăng nhập[:ja]ログインフォーム') ?></div>
	
    <!--<div class="formtitle"><?php //$template->the_action_template_message( 'login' ); ?></div>-->

	<?php //$template->the_action_template_message( 'login' ); ?>
	
	<?php //$template->the_errors(); ?>
	<div id="facebook-login-tml">

		<a href="<?php echo site_url()?>/?page_id=41&loginFacebook=1&redirect=<?php echo site_url()?>/?page_id=100" onclick="window.location = '<?php echo site_url()?>/?page_id=41&loginFacebook=1&redirect=<?php echo site_url()?>/?page_id=100'"><img src="<?php echo bloginfo('template_directory');?>/images/sign-in-with-facebook.png"/></a>
	
	</div>
	<div id="txtMiddle">
		<span class="oTxtLarge">
			<strong>OR</strong>
		</span>
	</div>
	
	
	<form name="loginform" id="loginform<?php $template->the_instance(); ?>" action="<?php $template->the_action_url( 'login' ); ?>" method="post" >
		<?php $template->the_errors(); ?>
		<p class="input_login">
			<!--<label id="lb-user-login" for="user_login<?php //$template->the_instance(); ?>"><?php //_e( 'Username' ); ?></label>-->
			<input type="text" name="log" id="user_login<?php $template->the_instance(); ?>" class="input" value="<?php $template->the_posted_value( 'log' ); ?>" size="30" placeholder=<?php _e('[:en]Username&nbsp;or&nbsp;E-mail[:vi]Username&nbsp;hoặc&nbsp;E-mail[:ja]ユーザ名&nbsp;又は&nbsp;Eメール');?> />
		</p>
		<p class="input_login">
			<!--<label id="lb-pass-login" for="user_pass<?php //$template->the_instance(); ?>"><?php //_e( 'Password' ); ?></label>-->
			<input type="password" name="pwd" id="user_pass<?php $template->the_instance(); ?>" class="input" value="" size="30" placeholder=<?php _e('[:en]Password[:vi]Mật&nbsp;khẩu[:ja]パスワード','theme-my-login' ); ?> />
		</p>

		<?php /*do_action( 'login_form' );*/ ?>

		<p class="forgetmenot">
			<label for="rememberme<?php $template->the_instance(); ?>"><?php _e( '[:en]Remember Me[:vi]Lưu mật khẩu[:ja]ログイン状態を保持' ); ?></label>
			<input name="rememberme" type="checkbox" id="rememberme<?php $template->the_instance(); ?>" value="forever" />			
		</p>
		<p class="submit">
			<input type="submit" name="wp-submit" id="wp-submit<?php $template->the_instance(); ?>" value="<?php _e( '[:en]LogIn[:vi]Đăng nhập[:ja]ログイン' ); ?>" />
			<input type="hidden" name="redirect_to" value="<?php $template->the_redirect_url( 'login' ); ?>" />
			<input type="hidden" name="instance" value="<?php $template->the_instance(); ?>" />
			<input type="hidden" name="action" value="login" />
		</p>
		
		
		
		<?php //$template->the_action_links( array( 'login' => false ) ); ?>
		<div id="tml-template-login">
		<p>
			<a id="tml-template-login-lostpass" class="" href="?page_id=44"><?php _e( '[:en]Lost Password?[:vi]Quên mật khẩu?[:ja]パスワードをお忘れですか？' ); ?></a>
		</p>
		
		
		</div>
	</form>
	
	
	
	<div id="clear"></div>
	</div>
</div>
