<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
    <title><?php esc_html_e($resume->title) ?></title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" href="<?php echo plugins_url() ?>/wpjobboard/templates/style.css" type="text/css" media="screen" />
</head>

<body>
<div id="wpjb-main" class="wpjr-page-resume-min">

    
    <div class="wpjb-resume-headline">
	<img src="<?php echo wpjb_resume_photo() ?>" alt="" class="wpjb-resume-photo" />
        <strong><?php esc_html_e($resume->title) ?></strong>
        <i><?php wpjb_resume_headline() ?></i>
    </div>

    <table class="wpjb-info">
        <tbody>
            <tr>
                <td><?php _e("Last Resume Update", WPJB_DOMAIN) ?></td>
                <td><?php wpjb_resume_last_update_at('d/m/Y', $resume) ?></td>
            </tr>
            
            <?php if($resume->address): ?>
            <tr>
                <td><?php _e("Address", WPJB_DOMAIN) ?></td>
                <td><?php esc_html_e($resume->details) ?></td>
            </tr>
            <?php endif; ?>
            
            <?php if($resume->degree): ?>
            <tr>
                <td><?php _e("Degree", WPJB_DOMAIN) ?></td>
                <td><?php wpjb_resume_degree($resume) ?></td>
            </tr>
            <?php endif; ?>
            
            <?php if($resume->years_experience): ?>
            <tr>
                <td><?php _e("Experience", WPJB_DOMAIN) ?></td>
                <td><?php wpjb_resume_experience($resume) ?></td>
            </tr>
            <?php endif; ?>
            
            <?php if($resume->category_id): ?>
            <tr>
                <td><?php _e("Category", WPJB_DOMAIN) ?></td>
                <td><?php esc_html_e($resume->getCategory(true)->title) ?></td>
            </tr>
            <?php endif; ?>
            
            <?php if($resume->email): ?>
            <tr>
                <td><?php _e("E-mail", WPJB_DOMAIN) ?></td>
                <td><?php echo $resume->email; ?></td>
            </tr>
            <?php endif; ?>
            
            <?php if($resume->phone): ?>
            <tr>
                <td><?php _e("Phone Number", WPJB_DOMAIN) ?></td>
                <td><?php echo $resume->phone ?></td>
            </tr>
            <?php endif; ?>
            
            <?php if($resume->website): ?>
            <tr>
                <td><?php _e("Website", WPJB_DOMAIN) ?></td>
                <td><?php echo $resume->website ?></td>
            </tr>
            <?php endif; ?>
			
			<?php if($resume->salary): if ($resume->sym_currency==0): $sym_currency="USD"; else: $sym_currency="VND"; endif;?>
            <tr>
                <td><?php _e("Salary Preference", WPJB_DOMAIN) ?></td>
                <td><?php echo number_format($resume->salary,0,",",".").$sym_currency; ?>/<?php _e("month", WPJB_DOMAIN) ?></td>
            </tr>
			<?php else : ?>
			<tr>
                <td><?php _e("Salary Preference", WPJB_DOMAIN) ?></td>
                <td><?php _e("Negotiable", WPJB_DOMAIN) ?></td>
            </tr>			
            <?php endif; ?>
            
            <?php foreach($resume->getNonEmptyFields() as $field): ?>
            <?php /* @var $field Wpjb_Model_FieldValue */ ?>
            <tr>
                <td class="wpjb-info-label"><?php esc_html_e($field->getLabel()); ?></td>
                <td><?php wpjb_field_value($field) ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>



    <div class="wpjb-job-content">
        <h3><?php _e("Experience", WPJB_DOMAIN) ?></h3>
        <div class="wpjb-job-text"><?php echo $resume->experience ?></div>
    </div>
    
    <div class="wpjb-job-content">
        <h3><?php _e("Education", WPJB_DOMAIN) ?></h3>
        <div class="wpjb-job-text"><?php echo $resume->education ?></div>
    </div>
	
	<div class="wpjb-job-content">
        <h3><?php _e("Skills", WPJB_DOMAIN) ?></h3>
        <div class="wpjb-job-text"><?php echo $resume->skills ?></div>
    </div>

    <?php foreach($resume->getNonEmptyTextareas() as $field): ?>
    <div class="wpjb-job-content">
        <h3><?php esc_html_e($field->getLabel()) ?></h3>
        <div class="wpjb-job-text"><?php wpjb_field_value($field) ?></div>
    </div>
    <?php endforeach; ?>


</div>
</body>
</html>