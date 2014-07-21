<?php
require_once NEWSLETTER_INCLUDES_DIR . '/controls.php';
$controls = new NewsletterControls();
$module = NewsletterUsers::instance();

$options_profile = get_option('newsletter_profile');

if ($controls->is_action('import')) {
    $mode = $controls->data['mode'];    

    // TODO: to be reomved, it's not safe
    @set_time_limit(100000);
    $csv = stripslashes($controls->data['csv']);

    $lines = explode("\n", $csv);

    $results = '';

    // Set the selected preferences inside the
    if (!is_array($controls->data['preferences'])) $controls->data['preferences'] = array();

//    if ($options['followup'] == 'activate') {
//        $subscriber['followup'] = 1;
//    }

    $error_count = 0;
    $added_count = 0;
    $updated_count = 0;
    $skipped_count = 0;
    
    foreach ($lines as &$line) {
        // Parse the CSV line
        $line = trim($line);
        if ($line == '') continue;
        if ($line[0] == '#' || $line[0] == ';') continue;
        $separator = $controls->data['separator'];
        if ($separator == 'tab') $separator = "\t";
        $data = explode($separator, $line);

        // Builds a subscriber data structure
        $email = $newsletter->normalize_email($data[0]);
        if (!$newsletter->is_email($email)) {
            $results .= '[INVALID EMAIL] ' . $line . "\n";
            $error_count++;
            continue;
        }

        $subscriber = NewsletterUsers::instance()->get_user($email, ARRAY_A);
        if ($subscriber == null) {
            $subscriber = array();
            $subscriber['email'] = $email;
            $subscriber['name'] = $newsletter->normalize_name($data[1]);
            $subscriber['surname'] = $newsletter->normalize_name($data[2]);
            $subscriber['status'] = 'C';
            foreach ($controls->data['preferences'] as $i) $subscriber['list_' . $i] = 1;
            NewsletterUsers::instance()->save_user($subscriber);
            $results .= '[ADDED] ' . $line . "\n";
            $added_count++;
        }
        else {
            if ($mode == 'skip') {
                $results .= '[SKIPPED] ' . $line . "\n";
                $skipped_count++;
                continue;
            }

            if ($mode == 'overwrite') {
                $subscriber['name'] = $newsletter->normalize_name($data[1]);
                $subscriber['surname'] = $newsletter->normalize_name($data[2]);

                // Prepare the preference to zero
                for ($i=1; $i<NEWSLETTER_LIST_MAX; $i++) $subscriber['list_' . $i] = 0;

                foreach ($controls->data['preferences'] as $i) $subscriber['list_' . $i] = 1;
            }

            if ($mode == 'update') {
                $subscriber['name'] = $newsletter->normalize_name($data[1]);
                $subscriber['surname'] = $newsletter->normalize_name($data[2]);
                foreach ($controls->data['preferences'] as $i) $subscriber['list_' . $i] = 1;
            }

            NewsletterUsers::instance()->save_user($subscriber);

            $results .= '[UPDATED] ' . $line . "\n";
            $updated_count++;
        }

    }
    if ($error_count) {
        $controls->errors = "Import completed but with errors.";
    }
    $controls->messages = "Import completed: $error_count errors, $added_count added, $updated_count updated, $skipped_count skipped.";
}
?>

<div class="wrap">
    <?php $help_url = 'http://www.sagojo.com'; ?>
    <?php include NEWSLETTER_DIR . '/header.php'; ?>

    <?php include NEWSLETTER_DIR . '/users/menu.inc.php'; ?>

        <h2>Import</h2>

    <?php $controls->show(); ?>
    

    <?php if (!empty($results)) { ?>

    <h3>Results</h3>

    <textarea wrap="off" style="width: 100%; height: 150px; font-size: 11px; font-family: monospace"><?php echo htmlspecialchars($results) ?></textarea>

    <?php } ?>

    <form method="post">

        <?php $controls->init(); ?>

        <h3>CSV text with subscribers</h3>
        <table class="form-table">
            <tr valign="top" style='display:none;'>
                <th>Preferences</th>
                <td>
                    <?php $controls->preferences_group('preferences', true); ?>
                    <div class="hints">
                        Every new imported or updated subscriber will be associate with selected preferences above.
                    </div>
                </td>
            </tr>

            <!--
            <tr valign="top">
                <th>Follow up</th>
                <td>
                    <?php $controls->select('followup', array('none' => 'None', 'activate' => 'Activate')); ?>
                </td>
            </tr>
            -->

            <tr valign="top">
                <th>Import mode</th>
                <td>
                    If the email is already present:
                    <?php $controls->select('mode', array('update' => 'Update', 'overwrite' => 'Overwrite', 'skip' => 'Skip')); ?>                    
                </td>
            </tr>
            <tr valign="top">
                <th>Separator</th>
                <td>
                    <?php $controls->select('separator', array(';' => 'Semicolon', ',' => 'Comma', 'tab' => 'Tabulation')); ?>
                </td>
            </tr>


            <tr valign="top">
                <th>CSV text</th>
                <td>
                    <textarea name="options[csv]" wrap="off" style="width: 100%; height: 300px; font-size: 11px; font-family: monospace"><?php echo $controls->data['csv']; ?></textarea>
                </td>
            </tr>
        </table>

        <p class="submit">
            <?php $controls->button('import', 'Import'); ?>
        </p>
    </form>

</div>
