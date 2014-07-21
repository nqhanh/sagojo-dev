<!--Neu la nguoi tim viec-->
    <?php  if(!get_user_meta(wp_get_current_user()->ID, "is_employer")):  ?>
<?php

/**
 * Featured Jobs
 * 
 * Featured jobs widget template file
 * 
 * 
 * @author Greg Winiarski
 * @package Templates
 * @subpackage Widget
 * 
 */

 /* @var $jobList array List of Wpjb_Model_Job objects */

?>
<style>
			#widgets ol {
			padding: 0px; 
			}
			ol{
				counter-reset: li;
				list-style: none;
				*list-style: decimal;
				/*font: 15px 'trebuchet MS', 'lucida sans';*/
				padding: 0;
				/*margin-bottom: 4em;*/
				text-shadow: 0 1px 0 rgba(255,255,255,.5);
			}

			ol ol{
				margin: 0 0 0 2em;
			}

			.circle-list li{
			    padding: 1.5em 1.5em 0.8em;
			    border-top: 1px dashed #ccc;
				width: 90%;
			}

			.circle-list h2{
			    position: relative;
			    margin: 0;
				font-size:1.1em;
				font-weight: 700;
			}

			.circle-list p{
			    margin: 0;
			}

			.circle-list h2:before{
				
			    content: counter(li);
			    counter-increment: li;
			    position: absolute;    
			    z-index: -1;
			    left: -1.3em;
			    top: -.8em;
			    background: #f5f5f5;
			    height: 1.5em;
			    width: 1.5em;
			    border: .1em solid rgba(0,0,0,.05);
			    text-align: center;
			    font: italic bold 1em/1.5em Georgia, Serif;
			    color: #ccc;
			    -moz-border-radius: 1.5em;
			    -webkit-border-radius: 1.5em;
			    border-radius: 1.5em;
			    -webkit-transition: all .2s ease-out;
			    -moz-transition: all .2s ease-out;
			    -ms-transition: all .2s ease-out;
			    -o-transition: all .2s ease-out;
			    transition: all .2s ease-out;    
			}

			.circle-list li:hover h2:before{
			    background-color: #ffd797;
			    border-color: rgba(0,0,0,.08);
			    border-width: .2em;
			    color: #444;
			    -webkit-transform: scale(1.5);
			    -moz-transform: scale(1.5);
			    -ms-transform: scale(1.5);
			    -o-transform: scale(1.5);
			    transform: scale(1.5);
			}
			.widget_wpjb-wearehiring-jobs .widget-title {
				color: #f15a24;
				font-size: 20px;
				padding-bottom: 15px;
				}
		</style>

<?php echo $theme->before_widget ?>
<?php if($title) echo $theme->before_title.$title.$theme->after_title ?>
<div class="wbjp_widget">
<ol class="circle-list">
    <?php if(!empty($jobList)): foreach($jobList as $job): ?>
    <li>
        <h2><a href="<?php echo wpjb_link_to("job", $job) ?>" class="job_title_id"><?php esc_html_e($job->job_title) ?></a></h2>
        
    </li>
    <?php endforeach; ?>
    <?php else: ?>
    <li><?php _e("No featured jobs found.", WPJB_DOMAIN) ?></li>
    <?php endif; ?>
</ol>
</div>
<?php echo $theme->after_widget ?>
<?php endif; ?>
<!--End neu la nguoi tim viec-->