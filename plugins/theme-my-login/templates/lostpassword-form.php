<?php
/*
If you would like to edit this file, copy it to your current theme's directory and edit it there.
Theme My Login will always look in your theme's directory first, before using this default template.
*/
?>
<div class="tml-lost-pw" id="theme-my-login<?php $template->the_instance(); ?>">
<div class="formtitle"><?php _e('[:en]Lost Password?[:vi]Quên mật khẩu?[:ja]パスワード紛失') ?></div>   
	<?php $template->the_action_template_message( 'lostpassword' ); ?>
	<?php $template->the_errors(); ?>
	<form name="lostpasswordform" id="lostpasswordform<?php $template->the_instance(); ?>" action="<?php $template->the_action_url( 'lostpassword' ); ?>" method="post">
		<p>
			<label id="lb_email" for="user_login<?php $template->the_instance(); ?>"><?php _e( '[:en]E-mail:[:vi]E-mail:[:ja]Eメール:' ); ?></label>
		</p>
		<p>
			<input type="text" name="user_login" id="user_login<?php $template->the_instance(); ?>" class="input" value="<?php $template->the_posted_value( 'user_login' ); ?>" size="20" />
		</p>

		<?php do_action( 'lostpassword_form' ); ?>

		<p class="submit">
			<input type="submit" name="wp-submit" id="wp-submit<?php $template->the_instance(); ?>" value="<?php _e( '[:en]Get New Password[:vi]Nhận mật khẩu mới[:ja]新規パスワード作成','theme-my-login' ); ?>" />
			<input type="hidden" name="redirect_to" value="<?php $template->the_redirect_url( 'lostpassword' ); ?>" />
			<input type="hidden" name="instance" value="<?php $template->the_instance(); ?>" />
			<input type="hidden" name="action" value="lostpassword" />
		</p>
	</form>
	<?php //$template->the_action_links( array( 'lostpassword' => false ) ); ?>
	<div id="">
		<p>
			<a id="" class="" href="?page_id=41"><?php _e( '[:en]Login[:vi]Đăng nhập[:ja]ログイン' ); ?></a>
		</p>
		
		
	</div>
</div>
