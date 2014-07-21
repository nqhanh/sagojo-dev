<?php
@include_once NEWSLETTER_INCLUDES_DIR . '/controls.php';

$controls = new NewsletterControls();

if (!$controls->is_action()) {
    $controls->data = get_option('newsletter_main');
} else {
    if ($controls->is_action('remove')) {

        $wpdb->query("delete from " . $wpdb->prefix . "options where option_name like 'newsletter%'");

        $wpdb->query("drop table " . $wpdb->prefix . "newsletter, " . $wpdb->prefix . "newsletter_stats, " .
                $wpdb->prefix . "newsletter_emails, " .
                $wpdb->prefix . "newsletter_work");

        echo 'Newsletter plugin destroyed. Please, deactivate it now.';
        return;
    }

    if ($controls->is_action('save')) {
        $errors = null;

        // Validation
        $controls->data['sender_email'] = $newsletter->normalize_email($controls->data['sender_email']);
        if (!$newsletter->is_email($controls->data['sender_email'])) {
            $controls->errors .= 'The sender email address is not correct.<br />';
        }

        $controls->data['return_path'] = $newsletter->normalize_email($controls->data['return_path']);
        if (!$newsletter->is_email($controls->data['return_path'], true)) {
            $controls->errors .= 'Return path email is not correct.<br />';
        }

        //$controls->data['test_email'] = $newsletter->normalize_email($controls->data['test_email']);
        //if (!$newsletter->is_email($controls->data['test_email'], true)) {
        //    $controls->errors .= 'Test email is not correct.<br />';
        //}

        $controls->data['reply_to'] = $newsletter->normalize_email($controls->data['reply_to']);
        if (!$newsletter->is_email($controls->data['reply_to'], true)) {
            $controls->errors .= 'Reply to email is not correct.<br />';
        }

        if (empty($controls->errors)) {
            update_option('newsletter_main', $controls->data);
        }
    }

    if ($controls->is_action('smtp_test')) {

        require_once ABSPATH . WPINC . '/class-phpmailer.php';
        require_once ABSPATH . WPINC . '/class-smtp.php';
        $mail = new PHPMailer();

        $mail->IsSMTP();
        $mail->SMTPDebug = true;
        $mail->CharSet = 'UTF-8';
        $message = 'This Email is sent by PHPMailer of WordPress';
        $mail->IsHTML(false);
        $mail->Body = $message;
        $mail->From = $controls->data['sender_email'];
        $mail->FromName = $controls->data['sender_name'];
        if (!empty($controls->data['return_path'])) $mail->Sender = $options['return_path'];
        if (!empty($controls->data['reply_to'])) $mail->AddReplyTo($controls->data['reply_to']);

        $mail->Subject = '[' . get_option('blogname') . '] SMTP test';

        $mail->Host = $controls->data['smtp_host'];
        if (!empty($controls->data['smtp_port'])) $mail->Port = (int) $controls->data['smtp_port'];

        $mail->SMTPSecure = $controls->data['smtp_secure'];

        if (!empty($controls->data['smtp_user'])) {
            $mail->SMTPAuth = true;
            $mail->Username = $controls->data['smtp_user'];
            $mail->Password = $controls->data['smtp_pass'];
        }

        $mail->SMTPKeepAlive = true;
        $mail->ClearAddresses();
        $mail->AddAddress($controls->data['smtp_test_email']);
        ob_start();
        $mail->Send();
        $mail->SmtpClose();
        $debug = htmlspecialchars(ob_get_clean());

        if ($mail->IsError()) $controls->errors = $mail->ErrorInfo;
        else $controls->messages = 'Success.';

        $controls->messages .= '<textarea style="width:100%;height:250px;font-size:10px">';
        $controls->messages .= $debug;
        $controls->messages .= '</textarea>';
    }
}
?>

<div class="wrap">

    <?php $help_url = 'http://www.satollo.net/plugins/newsletter/newsletter-configuration'; ?>
    <?php include NEWSLETTER_DIR . '/header.php'; ?>

    <h2>Newsletter Main Configuration</h2>

    <?php $controls->show(); ?>    

    <form method="post" action="">
        <?php $controls->init(); ?>

        <div id="tabs">

            <ul>
                <li><a href="#tabs-1">Basic settings</a></li>
                <li><a href="#tabs-2">Advanced settings</a></li>
            </ul>

            <div id="tabs-1">

                <!-- Main settings -->
                <div class="tab-preamble">
                <p>
                </p>
                </div>

                <table class="form-table">

                    <tr valign="top">
                        <th>Sender email address</th>
                        <td>
                            <?php $controls->text_email('sender_email', 40); ?> (valid email address)

                            <div class="hints">
                                Insert here the email address from which subscribers will se your email coming. Since this setting can
                                affect the reliability of delivery.
                                Generally use an address within your domain name.
                            </div>
                        </td>
                    </tr>
                        <th>Sender name</th>
                        <td>
                            <?php $controls->text('sender_name', 40); ?> (optional)

                            <div class="hints">
                                Insert here the name which subscribers will see as the sender of your email (for example your blog or website's name). Since this setting can affect the reliability of delivery (usually under Windows).                            </div>
                        </td>
                    </tr>
                    <tr valign="top">
                        <th>Max emails per hour</th>
                        <td>
                            <?php $controls->text('scheduler_max', 5); ?>
                            <div class="hints">
                                Newsletter delivery engine respects this limit and it should be set to a value less than the maximum allowed by your provider
                                (Hostgator: 500 per hour, Dreamhost: 100 per hour, Go Daddy: 1000 per day using their SMTP, Gmail: 500 per day).
                            </div>
                        </td>
                    </tr>
                    <tr valign="top">
                        <th>Return path</th>
                        <td>
                            <?php $controls->text_email('return_path', 40); ?> (valid email address, default empty)
                            <div class="hints">
                                Email address where delivery error messages are sent by mailing systems (eg. mailbox full, invalid address, ...).<br>
                                Some providers do not accept this field: they can block emails or force it to a different value affecting the delivery reliability.
                            </div>
                        </td>
                    </tr>
                    <tr valign="top">
                        <th>Reply to</th>
                        <td>
                            <?php $controls->text_email('reply_to', 40); ?> (valid email address)
                            <div class="hints">
                                This is the email address where subscribers will reply (eg. if they want to reply to a newsletter). Leave it blank if
                                you don't want to specify a different address from the sender email above. Since this setting can
                                affect the reliability of delivery.
                            </div>
                        </td>
                    </tr>

                </table>
            </div>

            <div id="tabs-2">

                <!-- General parameters -->

                <table class="form-table">

                    <tr valign="top">
                        <th>Enable access to contributor?</th>
                        <td>
                            <?php $controls->yesno('editor'); ?>
                        </td>
                    </tr>                    

                </table>
            </div>	


        </div> <!-- tabs -->

        <p class="submit">
            <?php $controls->button('save', 'Save'); ?>
            <?php $controls->button_confirm('remove', 'Totally remove this plugin', 'Really sure to totally remove this plugin. All data will be lost!'); ?>
        </p>

    </form>
    <p></p>
</div>
