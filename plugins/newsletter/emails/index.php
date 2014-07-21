<?php
require_once NEWSLETTER_INCLUDES_DIR . '/controls.php';
$controls = new NewsletterControls();
$module = NewsletterEmails::instance();

if ($controls->is_action('convert')) {
    $module->convert_old_emails();
    $controls->messages = 'Converted!';
}

if ($controls->is_action('unconvert')) {
    $wpdb->query("update wp_newsletter_emails set type='email' where type='message'");
    $controls->messages = 'Unconverted!';
}

if ($controls->is_action('send')) {
    $newsletter->hook_newsletter();
    $controls->messages .= 'Delivery engine triggered.';
}


if ($controls->is_action('delete')) {
    Newsletter::instance()->delete_email($_POST['btn']);
    $controls->messages .= 'Message deleted';
}

if ($controls->is_action('delete_selected')) {
    $r = Newsletter::instance()->delete_email($_POST['ids']);
    $controls->messages .= $r . ' message(s) deleted';
}

$emails = Newsletter::instance()->get_emails('message');
?>

<div class="wrap">

    <?php $help_url = 'http://www.sogojo.com'; ?>
    <?php include NEWSLETTER_DIR . '/header.php'; ?> 

    <h2>Emails List</h2>
    
    <?php $controls->show(); ?>

    <form method="post" action="">
        <?php $controls->init(); ?>

        <?php if ($module->has_old_emails()) { ?>
            <div class="newsletter-message">
                <p>
                    Your Newsletter installation has emails still in old format. To get them listed, you should convert them in
                    a new format. Would you to convert them now?
                </p>
                <p>
                    <?php $controls->button('convert', 'Convert now'); ?>
                    <?php //$controls->button('unconvert', 'Unconvert (DEBUG)'); ?>
                </p>
            </div>
        <?php } ?>

        <p>
            <a href="<?php echo $module->get_admin_page_url('theme'); ?>" class="button">New email</a>
            <?php $controls->button_confirm('delete_selected', 'Delete selected emails', 'Proceed?'); ?>
            <?php $controls->button('send', 'Trigger the delivery emails'); ?>
        </p>
        <table class="widefat" style="width: auto">
            <thead>
                <tr>
                    <th>&nbsp;</th>
                    <th>Id</th>
                    <th>Subject</th>
                    
                    <th>Status</th>
                    <th>Progress<sup>*</sup></th>
                    <th>Date</th>
                    <th>&nbsp;</th>
                    <th>&nbsp;</th>
                    <th>&nbsp;</th>
                    <th>&nbsp;</th>
                </tr>
            </thead>

            <tbody>
                <?php foreach ($emails as &$email) { ?>
                    <tr>
                        <td><input type="checkbox" name="ids[]" value="<?php echo $email->id; ?>"/></td>
                        <td><?php echo $email->id; ?></td>
                        <td><?php echo htmlspecialchars($email->subject); ?></td>
                        
                        <td>
                            <?php
                            if ($email->status == 'sending') {
                                if ($email->send_on > time()) {
                                    echo 'planned';
                                }
                                else {
                                    echo 'sending';
                                }
                            } else  {
                                echo $email->status;
                            }
                            ?>
                        </td>
                        <td><?php if ($email->status == 'sent' || $email->status == 'sending')echo $email->sent . ' of ' . $email->total; ?></td>
                        <td><?php if ($email->status == 'sent' || $email->status == 'sending') echo $module->format_date($email->send_on); ?></td>
                        <td><a class="button" href="<?php echo $module->get_admin_page_url('edit'); ?>&amp;id=<?php echo $email->id; ?>">Edit</a></td>
                        <td>
                            <a class="button" href="<?php echo NewsletterStatistics::instance()->get_statistics_url($email->id); ?>">Statistics</a>
                        </td>
                        <td><?php $controls->button_confirm('delete', 'Delete', 'Proceed?', $email->id); ?></td>
                    </tr>
<?php } ?>
            </tbody>
        </table>
    </form>
</div>
