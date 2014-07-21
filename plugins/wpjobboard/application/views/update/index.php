<?php $this->slot("title", __("Upgrade", WPJB_DOMAIN)); ?>
<?php $this->_include("header.php"); ?>

    <table class="form-table">
        <tbody>

            <?php if($upgrade->available): ?>
            <tr valign="top">
                <td class="wpjb-form-spacer" ><h3><?php _e("There is one upgrade available!", WPJB_DOMAIN) ?></h3></td>
            </tr>
            <tr>
                <td class="wpjb-normal-td">

                    <div style="margin-top:10px">
                        <?php _e("<strong>Important note:</strong> Upgrade will overwrite all files in WPJobBoard directory, if you made any modifications they will be lost.", WPJB_DOMAIN) ?> 
                    </div>

                    <div style="margin-top:10px">
                        <strong style="color:red"><?php _e("Even more important note", WPJB_DOMAIN) ?>:</strong> 
                        <?php _e("Before upgrading it is crucial that you read", WPJB_DOMAIN) ?>&nbsp;
                        <a href="http://wpjobboard.net/changelog" id="wpjb_changelog"><?php _e("WPJobBoard changelog", WPJB_DOMAIN) ?></a> 
                        <?php _e("to find out what can happen or what might require manual verification after upgrading to latest version.", WPJB_DOMAIN) ?>
                    </div>

                    <?php if(array_sum($tools)==count($tools)): ?>
                    <p id="wpjb-import-actions" class="submit wpjb-import-box">
                        <form action="<?php echo $this->_url->linkTo("wpjb/update", "upgrade"); ?>" method="post" id="">
                        <input type="hidden" name="checksum" value="<?php echo daq_escape($checksum) ?>" />
                        <input type="hidden" name="version" value="<?php echo daq_escape($upgrade->available->version) ?>" />
                        <input type="submit" value="Upgrade to WPJobBoard <?php echo $upgrade->available->version ?> now!" id="wpjb-start-import" class="button-primary" />
                        </form>
                    </p>
                    <?php else: ?>
                    <?php _e("Cannot execute automatic upgrade because of following errors", WPJB_DOMAIN) ?>:
                    <ul>
                        <?php if(!$tools['zip']): ?>
                            <li><?php _e("Your server is unable to unzip files.", WPJB_DOMAIN) ?></li>
                        <?php endif; ?>
                    </ul>
                    <?php endif; ?>

                </td>
            </tr>
            <?php else: ?>
            <tr valign="top">
                <td class="wpjb-form-spacer" ><h3><?php _e("No upgrades available at this time", WPJB_DOMAIN) ?></h3></td>
            </tr>
            <?php endif; ?>
        </tbody>
    </table>

</div>

<?php $this->_include("footer.php"); ?>