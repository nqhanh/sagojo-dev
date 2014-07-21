<script src="<?php echo plugins_url('jquery-1.7.1.min.js', __FILE__ );?>" type="text/javascript"></script>   
<script src="<?php echo plugins_url('jquery-ui-1.8.18.custom.min.js', __FILE__ );?>" type="text/javascript"></script>
<?php 

/**
 * Job seeker registration page
 * 
 * @author Greg Winiarski
 * @package Templates
 * @subpackage Resumes
 */

 /* @var $form Wpjb_Form_Resumes_Register */

?>
<div id="oWrapper" >
	<div id="facebook-connection">
		<div id="sign-header"></div>
		<div id="sign-body"><a title="Dang nhap de kiem viec lam" id="sign-facebook" href="<?php echo site_url()?>/?page_id=41&loginFacebook=1&redirect=<?php echo site_url()?>/?page_id=100" onclick="window.location = '<?php echo site_url()?>/?page_id=41&loginFacebook=1&redirect=<?php echo site_url()?>/?page_id=100'"><?php _e( 'Sign Up with Facebook',WPJB_DOMAIN ); ?></a></div>
		<div id="sign-footer"></div>
		<div id="clear"></div>
	</div>
	<div id="txtMiddle">
		<span class=" oTxtLarge">
			<strong><?php _e('OR', WPJB_DOMAIN) ?></strong>
		</span>
	</div>
	

<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Jobseeker Login Widgets') ) : ?>  
	
        <?php endif; ?>
	<div id="wpjb-widget-lostpass-job-want">
			<a id="lost-pass" href="?page_id=44"><?php _e('Lost Password',WPJB_DOMAIN ); ?></a>
    </div>
</div>
		
<div id="wpjb-main" class="wpjr-page-register">
    <?php wpjb_flash() ?>
	<div class="formtitle">
		<?php _e('Not registry? Create new account', WPJB_DOMAIN) ?>
	</div>
    <form class="wpjb-form" action="" method="post">
        <?php wpjb_form_render_hidden($form) ?>
        <fieldset class="wpjb-fieldset-x">
        <?php foreach($form->getNonEmptyGroups() as $group): ?>
        <?php /* @var $group stdClass */ ?> 
            <?php foreach($group->element as $name => $field): ?>
            <?php /* @var $field Daq_Form_Element */ ?>
            <div class="<?php wpjb_form_input_features($field) ?>">

                <label class="wpjb-label">
                    <?php esc_html_e($field->getLabel()) ?>
                    <?php if($field->isRequired()): ?><span class="wpjb-required">*</span><?php endif; ?>
                </label>
                
                <div class="wpjb-field">
                    <?php wpjb_form_render_input($form, $field) ?>
                    <?php wpjb_form_input_hint($field) ?>
                    <?php wpjb_form_input_errors($field) ?>
                </div>

            </div>
            <?php endforeach; ?>
        <?php endforeach; ?>


            <div>
                <label class="wpjb-label">&nbsp;</label>
                <input type="submit" name="wpjb_login" id="wpjb_submit" value="<?php _e("[:en]Register account[:vi]Đăng ký tài khoản[:ja]アカウントを作成する", WPJB_DOMAIN) ?>" />
            </div>
        </fieldset>


    </form>


</div>
