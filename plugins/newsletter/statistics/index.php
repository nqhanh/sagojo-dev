<?php
require_once NEWSLETTER_INCLUDES_DIR . '/controls.php';
$module = NewsletterStatistics::instance();
$controls = new NewsletterControls();
$emails = Newsletter::instance()->get_emails();

if ($controls->is_action('save')) {
    $module->save_options($controls->data);
    $controls->messages = 'Saved.';
}
?>

<div class="wrap">
    <?php $help_url = 'http://sagojo.com'; ?>

    <?php include NEWSLETTER_DIR . '/header.php'; ?>
   

    <h2>Configuration and Email List</h2>   
  
    <table class="widefat" style="width: auto">
        <thead>
            <tr>
                <th>Id</th>
                <th>Subject</th>
                <th>Type</th>
                <th>Status</th>
                <th>&nbsp;</th>
                <th>&nbsp;</th>
                <th>&nbsp;</th>
            </tr>
        </thead>

        <tbody>
            <?php foreach ($emails as &$email) { ?>
                <tr>
                    <td><?php echo $email->id; ?></td>
                    <td><?php echo htmlspecialchars($email->subject); ?></td>
                    <td><?php echo $email->type; ?></td>
                    <td>
                        <?php
                        if ($email->status == 'sending') {
                            if ($email->send_on > time()) {
                                echo 'planned';
                            } else {
                                echo 'sending';
                            }
                        } else {
                            echo $email->status;
                        }
                        ?>
                    </td>
                    <td><?php if ($email->status == 'sent' || $email->status == 'sending') echo $email->sent . ' of ' . $email->total; ?></td>
                    <td><?php if ($email->status == 'sent' || $email->status == 'sending') echo $module->format_date($email->send_on); ?></td>
                    <td>
                        <a class="button" href="<?php echo NewsletterStatistics::instance()->get_statistics_url($email->id); ?>">statistics</a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>    
</div>
