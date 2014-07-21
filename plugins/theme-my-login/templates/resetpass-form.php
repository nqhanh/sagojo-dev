<?php
/*
If you would like to edit this file, copy it to your current theme's directory and edit it there.
Theme My Login will always look in your theme's directory first, before using this default template.
*/
?>
<div class="login" id="theme-my-login<?php $template->the_instance(); ?>">
	<?php $template->the_action_template_message( 'resetpass' ); ?>
	<?php $template->the_errors(); ?>
	<form name="resetpasswordform" id="resetpasswordform<?php $template->the_instance(); ?>" action="<?php $template->the_action_url( 'resetpass' ); ?>" method="post">
		<p>
			<label for="pass1<?php $template->the_instance(); ?>"><?php _e( '[:en]New Password[:vi]Mật khẩu mới[:ja]新規パスワード' ); ?></label>
			<input autocomplete="off" name="pass1" id="pass1<?php $template->the_instance(); ?>" class="input" size="20" value="" type="password" autocomplete="off" />
		</p>

		<p>
			<label for="pass2<?php $template->the_instance(); ?>"><?php _e( '[:en]Confirm new password[:vi]Xác nhận mật khẩu mới[:ja]新規パスワードの再入力' ); ?></label>
			<input autocomplete="off" name="pass2" id="pass2<?php $template->the_instance(); ?>" class="input" size="20" value="" type="password" autocomplete="off" />
		</p>

		<div id="pass-strength-result" class="hide-if-no-js"><?php _e( '[:en]Strength indicator[:vi]Độ mạnh của mật khẩu[:ja]パスワードの強度' ); ?></div>

		<p class="description indicator-hint"><?php _e( '[:en]Hint: The password should be at least eight characters long. To make it stronger, use upper and lower case letters, numbers and symbols like ! \" (? $ % ^ &amp; ).[:vi]Gợi ý: Mật khẩu phải có ít nhất tám ký tự, Mật khẩu mạnh cần sử dụng những ký tự viết hoa, viết thường, ký số và các ký tự đặc biệt (? $ % ^ &amp;).[:ja]ヒント：パスワードは8桁以上、半角英字（大文字と小文字）と半角数字を使用して下さい。パスワードをより強くする為にシンボル ! \" (? $ % ^ & ) を使用する事をおすすめします。' ); ?></p>

		<?php do_action( 'resetpassword_form' ); ?>

		<p class="submit">
			<input type="submit" name="wp-submit" id="wp-submit<?php $template->the_instance(); ?>" value="<?php esc_attr_e( '[:en]Reset Password[:vi]Đặt lại mật khẩu[:ja]パスワードのリセット' ); ?>" />
			<input type="hidden" name="key" value="<?php $template->the_posted_value( 'key' ); ?>" />
			<input type="hidden" name="login" id="user_login" value="<?php $template->the_posted_value( 'login' ); ?>" />
			<input type="hidden" name="instance" value="<?php $template->the_instance(); ?>" />
			<input type="hidden" name="action" value="resetpass" />
		</p>
	</form>
	<?php $template->the_action_links( array( 'lostpassword' => false ) ); ?>
</div>
