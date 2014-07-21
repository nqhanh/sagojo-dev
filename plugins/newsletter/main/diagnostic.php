<?php
@include_once NEWSLETTER_INCLUDES_DIR . '/controls.php';

$controls = new NewsletterControls();

if ($controls->is_action('save')) {
    update_option('newsletter_log_level', $controls->data['log_level']);
    update_option('newsletter_diagnostic', $controls->data);
    $controls->messages = 'Loggin levels saved.';
}

if ($controls->is_action('trigger')) {
    $newsletter->hook_newsletter();
    $controls->messages = 'Delivery engine triggered.';
}

if ($controls->is_action('undismiss')) {
    update_option('newsletter_dismissed', array());
    $controls->messages = 'Notices restored.';
}

if ($controls->is_action('trigger_followup')) {
    NewsletterFollowup::instance()->send();
    $controls->messages = 'Follow up delivery engine triggered.';
}

if ($controls->is_action('engine_on')) {
    wp_clear_scheduled_hook('newsletter');
    wp_schedule_event(time() + 30, 'newsletter', 'newsletter');
    $controls->messages = 'Delivery engine reactivated.';
}

if ($controls->is_action('upgrade')) {
    // TODO: Compact them in a call to Newsletter which should be able to manage the installed modules
    Newsletter::instance()->upgrade();
    NewsletterUsers::instance()->upgrade();
    NewsletterSubscription::instance()->upgrade();
    NewsletterEmails::instance()->upgrade();
    NewsletterStatistics::instance()->upgrade();
    $controls->messages = 'Upgrade forced!';
}

if ($controls->is_action('delete_transient')) {
    delete_transient($_POST['btn']);
    $controls->messages = 'Deleted.';
}

if ($controls->is_action('test_wp')) {

    if ($controls->data['test_email'] == $newsletter->options['sender_email']) {
        $controls->messages .= 'You are using as test email the same configured as sender email. Test can fail because that.<br />';
    }

    $text = 'This is a simple test email sent directly with the WordPress mailing functionality' . "\r\n" .
            'in the same way WordPress sends notifications of new comment or registered users.' . "\r\n\r\n" .
            'This email is in pure text format and the sender should be wordpress@youdomain.tld (but it can be forced to be different with specific plugins.';

    $r = wp_mail($controls->data['test_email'], 'Newsletter: direct WordPress email test', $text);

    if ($r) {
        $controls->messages .= 'Direct WordPress email sent<br />';
    } else {
        $controls->errors .= 'Direct WordPress email NOT sent: ask your provider if your web space is enabled to send emails.<br />';
    }
}

if ($controls->is_action('send_test')) {

    if ($controls->data['test_email'] == $controls->data['sender_email']) {
        $controls->messages .= 'You are using as test email the same configured as sender email. Test can fail because that.<br />';
    }

    $text = 'This is a pure textual email sent using the sender data set on basic Newsletter settings.' . "\r\n" .
            'You should see it to come from the email address you set on basic Newsletter plugin setting.';
    $r = $newsletter->mail($controls->data['test_email'], 'Newsletter: pure text email', array('text' => $text));


    if ($r) $controls->messages .= 'Newsletter TEXT test email sent.<br />';
    else $controls->errors .= 'Newsletter TEXT test email NOT sent: try to change the sender data, remove the return path and the reply to settings.<br />';

    $text = '<p>This is a <strong>html</strong> email sent using the <i>sender data</i> set on Newsletter main setting.</p>';
    $text .= '<p>You should see some "mark up", like bold and italic characters.</p>';
    $text .= '<p>You should see it to come from the email address you set on basic Newsletter plugin setting.</p>';
    $r = $newsletter->mail($controls->data['test_email'], 'Newsletter: pure html email', $text);
    if ($r) $controls->messages .= 'Newsletter HTML test email sent.<br />';
    else $controls->errors .= 'Newsletter HTML test email NOT sent: try to change the sender data, remove the return path and the reply to settings.<br />';


    $text = array();
    $text['html'] = '<p>This is an <b>HTML</b> test email part sent using the sender data set on Newsletter main setting.</p>';
    $text['text'] = 'This is a textual test email part sent using the sender data set on Newsletter main setting.';
    $r = $newsletter->mail($controls->data['test_email'], 'Newsletter: both textual and html email', $text);
    if ($r) $controls->messages .= 'Newsletter: both textual and html test email sent.<br />';
    else $controls->errors .= 'Newsletter both TEXT and HTML test email NOT sent: try to change the sender data, remove the return path and the reply to settings.<br />';
}

if (empty($controls->data)) $controls->data = get_option('newsletter_diagnostic');
?>
<div class="wrap">
    <?php $help_url = 'http://www.satollo.net/plugins/newsletter/newsletter-diagnostic'; ?>
    <?php include NEWSLETTER_DIR . '/header.php'; ?>

    <h2>Diagnostic</h2>

    <?php $controls->show(); ?>    

    <form method="post" action="">
        <?php $controls->init(); ?>

        <h3>Test</h3>
        Email: <?php $controls->text('test_email'); ?>
        <?php $controls->button('test_wp', 'Send an email with WordPress'); ?>
        <?php $controls->button('send_test', 'Send few emails with SagojoEmail'); ?>

    </form>

</div>
