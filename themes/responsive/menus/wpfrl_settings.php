<?php 
$wpfrl_settings = get_option('wpfrl_settings');

if ( wp_verify_nonce($_POST['wpfrl_pf'],'wpfrl_action') )
	{
	echo "<h1>Options stored</h1>";
	$wpfrl_settings['postform_header'] = $_POST['pf']; 
	update_option('wpfrl_settings',$wpfrl_settings);
	}
?>


<div style='margin:30px;padding:20px;border:2px solid #CCC'>
<h1>WP Freelance PRO</h1>
Settings & options
<br/>

	<div style='margin:30px;padding:20px;border:2px solid #CCC'>
	<form method='post'>
	Set a title/subtitle top-left inside the post-box on the index page - or leave blank<br/>
	<textarea name='pf' rows='3' cols='80'><?php echo $wpfrl_settings['postform_header']; ?></textarea>
	<br>Html allowed
	<?php wp_nonce_field('wpfrl_action','wpfrl_pf'); ?>
	<br/>
	<input type='submit' value='submit'>
	</form>
	</div>

</div>