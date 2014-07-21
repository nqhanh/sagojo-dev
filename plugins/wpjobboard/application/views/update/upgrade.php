<?php $this->slot("title", __("Upgrade", WPJB_DOMAIN)); ?>
<?php $this->_include("header.php"); ?>

    <?php if($result<0): ?>
        <div class="error">
            <p><b><?php _e("There was an error when trying to upgrade application", WPJB_DOMAIN) ?>:</b></p>
            <?php if($result == Wpjb_Upgrade_Manager::ZIPERR_OPEN): ?>
            <p><?php _e("Could not open upgrade archive", WPJB_DOMAIN) ?>.</p>
            <?php elseif($result == Wpjb_Upgrade_Manager::ZIPERR_EXTRACT): ?>
            <p><?php _e("Could not extract files", WPJB_DOMAIN) ?>.</p>
            <?php else: ?>
            <p><?php _e("Unknown error", WPJB_DOMAIN) ?>.</p>
            <?php endif; ?>
        </div>
    <?php endif; ?>

    <table class="form-table">
        <tbody>

            <?php if($result < 0): ?>

            <tr>
                <td>
                    <p>
                        <?php _e("Download and manually extract files to <code>wp-content/plugins/wpjobboard</code> directory in order to complete upgrade to new version.", WPJB_DOMAIN) ?>
                    </p>
                </td>
            </tr>
            <?php else: ?>
            <tr valign="top">
                <td class="wpjb-form-spacer" ><h3><?php _e("Upgrade complete!", WPJB_DOMAIN) ?></h3></td>
            </tr>
            <tr>
                <td>
                    <p>
                        <a href="<?php echo $this->_url->linkTo("wpjb/job") ?>"><strong><?php _e("You can now go back to the job board.", WPJB_DOMAIN) ?></strong></a>
                    </p>

                    <p>
                        <?php _e('If you do not see any changes check <a href="plugins.php">WPJobBoard version</a> if it\'s different then latest version, then probably PHP does not have sufficent permissions to overwrite old files and you will have to do this manually using old fashion FTP.', WPJB_DOMAIN) ?>
                    </p>
                </td>
            </tr>
            <?php endif; ?>
        </tbody>
    </table>



<?php $this->_include("footer.php"); ?>