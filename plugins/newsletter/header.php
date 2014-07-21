<?php
$dismissed = get_option('newsletter_dismissed', array());

if (isset($_REQUEST['dismiss']) && check_admin_referer()) {
    $dismissed[$_REQUEST['dismiss']] = 1;
    update_option('newsletter_dismissed', $dismissed);
}

?>
<?php if (NEWSLETTER_HEADER) { ?>
<?php } ?>

<?php if (isset($dismissed['rate']) && $dismissed['rate'] != 1) { ?>
<div class="newsletter-notice">
    I never asked before and I'm curious: <a href="http://wordpress.org/extend/plugins/newsletter/" target="_blank">would you rate this plugin</a>?
    (few seconds required). (account on WordPress.org required, every blog owner should have one...). <strong>Really appreciated, Stefano</strong>.
    <div class="newsletter-dismiss"><a href="<?php echo wp_nonce_url($_SERVER['REQUEST_URI'] . '&dismiss=rate')?>">Dismiss</a></div>
    <div style="clear: both"></div>
</div>
<?php } ?>

<?php if (isset($dismissed['newsletter-page']) && $dismissed['newsletter-page'] != 1 && empty(NewsletterSubscription::instance()->options['url'])) { ?>
<div class="newsletter-notice">
    Create a page with your blog style to show the subscription form and the subscription messages. Go to the
    <a href="?page=newsletter_subscription_options">subscription panel</a> to
    configure it.
    <div class="newsletter-dismiss"><a href="<?php echo wp_nonce_url($_SERVER['REQUEST_URI'] . '&dismiss=newsletter-page')?>">Dismiss</a></div>
    <div style="clear: both"></div>
</div>
<?php } ?>


<?php $newsletter->warnings(); ?>
