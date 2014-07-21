<?php
@include_once NEWSLETTER_INCLUDES_DIR . '/controls.php';

$controls = new NewsletterControls();
$module = NewsletterUsers::instance();

$options_profile = get_option('newsletter_profile');

$lists = array();
for ($i = 1; $i <= NEWSLETTER_LIST_MAX; $i++) {
    if (!isset($options_profile['list_' . $i])) $options_profile['list_' . $i] = '';
  $lists['' . $i] = '(' . $i . ') ' . $options_profile['list_' . $i];
}

if ($controls->is_action('remove_unconfirmed')) {
  $r = $wpdb->query("delete from " . NEWSLETTER_USERS_TABLE . " where status='S'");
  $controls->messages = $r . ' not confirmed deleted.';
}

if ($controls->is_action('remove_unsubscribed')) {
  $r = $wpdb->query("delete from " . NEWSLETTER_USERS_TABLE . " where status='U'");
  $controls->messages = $r . ' unsubscribed deleted (profiles associated to WordPress users are never deleted).';
}

if ($controls->is_action('remove_bounced')) {
  $r = $wpdb->query("delete from " . NEWSLETTER_USERS_TABLE . " where status='B'");
  $controls->messages = $r . ' bounced deleted.';
}

if ($controls->is_action('unconfirm_all')) {
  $r = $wpdb->query("update " . NEWSLETTER_USERS_TABLE . " set status='S' where status='C'");
  $controls->messages = $r . ' unconfirmed.';
}

if ($controls->is_action('confirm_all')) {
  $r = $wpdb->query("update " . NEWSLETTER_USERS_TABLE . " set status='C' where status='S'");
  $controls->messages = $r . ' confirmed.';
}

if ($controls->is_action('remove_all')) {
  $r = $wpdb->query("delete from " . NEWSLETTER_USERS_TABLE);
  $controls->messages = $r . ' deleted.';
}

if ($controls->is_action('list_add')) {
  $r = $wpdb->query("update " . NEWSLETTER_USERS_TABLE . " set list_" . $controls->data['list'] . "=1");
  $controls->messages = $r . ' added to list ' . $controls->data['list'];
}

if ($controls->is_action('list_remove')) {
  $r = $wpdb->query("update " . NEWSLETTER_USERS_TABLE . " set list_" . $controls->data['list'] . "=0");
  $controls->messages = $r . ' removed from list ' . $controls->data['list'];
}

if ($controls->is_action('list_delete')) {
  $wpdb->query("delete from " . NEWSLETTER_USERS_TABLE . " where list_" . $controls->data['list'] . "<>0");
}

if ($controls->is_action('feed')) {
  $wpdb->query("update " . NEWSLETTER_USERS_TABLE . " set list_" . $controls->data['list_feed'] . "=1 where feed=1");
}

if ($controls->is_action('list_manage')) {
  if ($controls->data['list_action'] == 'move') {
    $wpdb->query("update " . NEWSLETTER_USERS_TABLE . ' set list_' . $controls->data['list_1'] . '=0, list_' . $controls->data['list_2'] . '=1' .
            ' where list_' . $controls->data['list_1'] . '=1');
  }

  if ($controls->data['list_action'] == 'add') {
    $wpdb->query("update " . NEWSLETTER_USERS_TABLE . ' set list_' . $controls->data['list_2'] . '=1' .
            ' where list_' . $controls->data['list_1'] . '=1');
  }
}

if ($controls->is_action('resend_all')) {
    $list = $wpdb->get_results("select * from " . $wpdb->prefix . "newsletter where status='S'");
    $opts = get_option('newsletter');

    if ($list) {
        $controls->messages = 'Confirmation email sent to: ';
        foreach ($list as &$user) {
            $controls->messages .= $user->email . ' ';
            $newsletter->mail($user->email, $newsletter->replace($opts['confirmation_subject'], $user), $newsletter->replace($opts['confirmation_message'], $user));
        }
    } else {
        $controls->errors = 'No subscribers to which rensend the confirmation email';
    }

}

if ($controls->is_action('align_wp_users')) {

    // TODO: check if the user is already there
    $wp_users = $wpdb->get_results("select id, user_email, user_login from $wpdb->users");
    $count = 0;
	
	//if(get_user_meta(wp_get_current_user()->ID, "is_employer"))
	//{
	
		foreach ($wp_users as &$wp_user) {
			$module->logger->info('Adding a registered WordPress user (' . $wp_user->id . ')');
			$is_employer = get_user_meta( $wp_user->id,'is_employer', true);
			if (!empty($is_employer)) $employer = "e";
			else $employer = "j";
			

			// A subscriber is already there with the same wp_user_id? Do Nothing.
			$nl_user = $module->get_user_by_wp_user_id($wp_user->id);

			if (!empty($nl_user)) {
				$module->logger->info('Subscriber already associated');
				continue;
			}

			$module->logger->info('WP user email: ', $wp_user->user_email);

			// A subscriber has the same email? Align them if not already associated to another wordpress user
			$nl_user = $module->get_user($module->normalize_email($wp_user->user_email));
			if (!empty($nl_user)) {
				$module->logger->info('Subscriber already present with that email');
				if (empty($nl_user->wp_user_id)) {
					$module->logger->info('Linked');
					$module->set_user_wp_user_id($nl_user->id, $wp_user->id);
					continue;
				}
			}

			$module->logger->info('New subscriber created');

			// Create a new subscriber
			$nl_user = array();
			$nl_user['email'] = $module->normalize_email($wp_user->user_email);
			$nl_user['name'] = $wp_user->user_login;
			$nl_user['status'] = $controls->data['align_wp_users_status'];
			$nl_user['wp_user_id'] = $wp_user->id;
			$nl_user['referrer'] = 'wordpress';
			$nl_user['sex'] = $employer;

			// Adds the force subscription preferences
			$preferences = NewsletterSubscription::instance()->options['preferences'];
			if (is_array($preferences)) {
				foreach ($preferences as $p) {
					$nl_user['list_' . $p] = 1;
				}
			}

			$module->save_user($nl_user);
			$count++;
		}
	//}
    $controls->messages = 'Total WP users aligned ' . count($wp_users) . ', total new subscribers ' . $count . '.';
}


if ($controls->is_action('bounces')) {
    $lines = explode("\n", $controls->data['bounced_emails']);
    $total = 0;
    $marked = 0;
    $error = 0;
    $not_found = 0;
    $already_bounced = 0;
    $results = '';
    foreach ($lines as &$email) {
        $email = trim($email);
        if (empty($email)) continue;

        $total++;

        $email = NewsletterModule::normalize_email($email);
        if (empty($email)) {
              $results .= '[INVALID] ' . $email . "\n";
          $error++;
            continue;
        }

        $user = NewsletterUsers::instance()->get_user($email);

        if ($user == null) {
          $results .= '[NOT FOUND] ' . $email . "\n";
          $not_found++;
          continue;
        }

        if ($user->status == 'B') {
          $results .= '[ALREADY BOUNCED] ' . $email . "\n";
          $already_bounced++;
          continue;
        }

        $r = NewsletterUsers::instance()->set_user_status($email, 'B');
        if ($r === 0) {
          $results .= '[BOUNCED] ' . $email . "\n";
        $marked++;
          continue;
        }
    }

    $controls->messages .= 'Total: ' . $total . '<br>';
    $controls->messages .= 'Bounce: ' . $marked . '<br>';
    $controls->messages .= 'Errors: ' . $error . '<br>';
    $controls->messages .= 'Not found: ' . $not_found . '<br>';
    $controls->messages .= 'Already bounced: ' . $already_bounced . '<br>';
}
?>

<div class="wrap">
    <?php $help_url = 'http://www.satollo.net/plugins/newsletter/subscribers-module'; ?>
    <?php include NEWSLETTER_DIR . '/header.php'; ?>
  <?php include NEWSLETTER_DIR . '/users/menu.inc.php'; ?>

    <h2>Massive Actions on Subscribers</h2>
  <?php $controls->show(); ?>

    <?php if (!empty($results)) { ?>

    <h3>Results</h3>

    <textarea wrap="off" style="width: 100%; height: 150px; font-size: 11px; font-family: monospace"><?php echo htmlspecialchars($results) ?></textarea>

    <?php } ?>


  <form method="post" action="">
  <?php $controls->init(); ?>

    <div id="tabs">
      <ul>
        <li><a href="#tabs-1">Global Actions</a></li>
      </ul>

      <div id="tabs-1">
        <table class="widefat" style="width: 100%;">
          <thead><tr><th>Status</th><th>Total</th><th>Actions</th></thead>
          <tr>
            <td>Total in database</td>
            <td>
              <?php echo $wpdb->get_var("select count(*) from " . NEWSLETTER_USERS_TABLE); ?>
            </td>
            <td nowrap>
              <?php $controls->button_confirm('remove_all', 'Delete all', 'Are you sure you want to remove ALL subscribers?'); ?>
            </td>
          </tr>
          <tr>
            <td>Confirmed</td>
            <td>
              <?php echo $wpdb->get_var("select count(*) from " . NEWSLETTER_USERS_TABLE . " where status='C'"); ?>
            </td>
            <td nowrap>
              <?php $controls->button_confirm('unconfirm_all', 'Unconfirm all', 'Are you sure? No way back.'); ?>
            </td>
          </tr>
          <tr>
            <td>Not confirmed</td>
            <td>
              <?php echo $wpdb->get_var("select count(*) from " . NEWSLETTER_USERS_TABLE . " where status='S'"); ?>
            </td>
            <td nowrap>
              <?php $controls->button_confirm('remove_unconfirmed', 'Delete all not confirmed', 'Are you sure you want to delete ALL not confirmed subscribers?'); ?>
              <?php $controls->button_confirm('confirm_all', 'Confirm all', 'Are you sure you want to mark ALL subscribers as confirmed?'); ?>
              <?php //$controls->button_confirm('resend_all', 'Resend confirmation message to all', 'Are you sure?'); ?>
            </td>
          </tr>
          <tr>
            <td>Unsubscribed</td>
            <td>
              <?php echo $wpdb->get_var("select count(*) from " . NEWSLETTER_USERS_TABLE . " where status='U'"); ?>
            </td>
            <td>
              <?php $controls->button_confirm('remove_unsubscribed', 'Delete all unsubscribed', 'Are you sure you want to delete ALL unsubscribed?'); ?>
            </td>
          </tr>
          <tr>
            <td>Import WP user</td>
            <td>
			 &nbsp;
            </td>
			
            <td>
                Link WordPress users with status
                <?php $controls->select('align_wp_users_status', array('C'=>'Confirmed', 'S'=>'Not confirmed')); ?>
                <?php $controls->button_confirm('align_wp_users', 'Go', 'Proceed?'); ?>
            </td>
			
          </tr>

          <tr>
            <td>Bounced</td>
            <td>
              <?php echo $wpdb->get_var("select count(*) from " . NEWSLETTER_USERS_TABLE . " where status='B'"); ?>
            </td>
            <td>
              <?php $controls->button_confirm('remove_bounced', 'Delete all bounced', 'Are you sure?'); ?>
            </td>
          </tr>
        </table>
        <h3>Customer</h3>
        <?php
            // TODO: do them with a single query
            $all_count = $wpdb->get_var("select count(*) from " . $wpdb->prefix . "newsletter where status='C'");
            $employer_count = $wpdb->get_var("select count(*) from " . $wpdb->prefix . "newsletter where sex='e' and status='C'");
            $jobseeker_count = $wpdb->get_var("select count(*) from " . $wpdb->prefix . "newsletter where sex='j' and status='C'");
            $other_count = ($all_count-$employer_count-$jobseeker_count)
        ?>
        <table class="widefat" style="width: 300px">
            <thead><tr><th>Customer</th><th>Total</th><th>Remove</th></thead>
            <tr><td>Employer</td><td><?php echo $employer_count; ?></td><td></td></tr>
            <tr><td>Jobseeker</td><td><?php echo $jobseeker_count; ?></td><td></td></tr>
            <tr><td>Partner</td><td><div id="delcount"><?php echo $other_count; ?></div></td><td><input type='button' id='delete' value='Remove' onclick='deletePartner()'></td></tr>
        </table>
		
      </div>
    </div>


  </form>
  </div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
		<script type="text/javascript">
			function deletePartner()
			{
				var del = jQuery.noConflict();
				var n = "n";
				del.ajax({ url: "<?php echo site_url()?>/wp-content/banners/deletePartner.php",
					data: {"user":n},
					type: 'post',
					success: function(output) {
					  alert("Partner deleted!");
					  del("#delcount").remove();
					}
				});
			}
		</script>