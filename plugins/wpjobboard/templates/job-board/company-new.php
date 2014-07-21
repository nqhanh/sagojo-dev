<div id="employer-jb-company-new">
<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Employer Login Widgets') ) : ?>  
        <?php endif; ?>
		
	<div id="wpjb-widget-lostpass-job-want">
			<a id="lost-pass" href="?page_id=44"><?php _e( 'Lost Password',WPJB_DOMAIN ); ?></a>
    </div>
</div>
<div id="wpjb-main" class="wpjb-page-company-new">

    <?php wpjb_flash() ?>
<div class="formtitle"><?php _e('Not registry? Create new account', WPJB_DOMAIN) ?>
</div>
<?php
if ($_GET['isbig'] == "1") {
       $is_big=1;
    }
    if ($_GET['isbig'] == "0") {
       $is_big=0;
    }
?>
    <form action="" method="post" id="wpjb-resume" class="wpjb-form" enctype="multipart/form-data">
		<?php wpjb_form_render_hidden($form) ?>
        <?php foreach($form->getNonEmptyGroups() as $group): ?>
        <?php /* @var $group stdClass */ ?> 
        <fieldset class="wpjb-fieldset-<?php echo $group->name ?>">
            <legend><?php esc_html_e($group->legend) ?></legend>
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
        </fieldset>
        <?php endforeach; ?>
		<p id="reg_passmail">
		
        <p class="submit">
        <input type="submit" value="<?php _e("Register", WPJB_DOMAIN) ?>" class="button-primary" name="Submit"/>
        </p>

    </form>





</div>