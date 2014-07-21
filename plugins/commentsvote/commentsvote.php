<?php
/*
Plugin Name: Vote on Comments
Plugin URI: 
Description:Allows to add votes on comment
Author: Abbas Suterwala
Version:
Author URI: 
*/

define('VOTECOMMENTSURL', WP_PLUGIN_URL."/".dirname( plugin_basename( __FILE__ ) ) );
define('VOTECOMMENTPATH', WP_PLUGIN_DIR."/".dirname( plugin_basename( __FILE__ ) ) );

function voteme_enqueuescripts()
	{
		wp_enqueue_script('votecomment', VOTECOMMENTSURL.'/js/commentsvote.js', array('jquery'));
		wp_localize_script( 'votecomment', 'votecommentajax', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ) ) );
	}
add_action('wp_enqueue_scripts', voteme_enqueuescripts);

function commentsvote_showlink()
{
    $link = "";
	$nonce = wp_create_nonce("commentsvote_nonce");
	$current_CommentID =  get_comment_ID();
	$votes = get_comment_meta($current_CommentID, '_commentsvote', true) != '' ? get_comment_meta($current_CommentID, '_commentsvote', true) : '0';
	if( get_option('commentvotelogin') != 'yes' || is_user_logged_in() )
	{
		$arguments = $current_CommentID.",'".$nonce."'";
		$link = __('[:en]Complain to this freelancer[:vi]Phàn nàn về người này[:ja]Complain to this freelancer').' <a style="cursor:pointer;" onclick="commentsvote_add('.$arguments.');">'.'<img src="'.site_url().'//wp-content/themes/responsive/library/images/number10.png">'.'</a>';
		$completelink = '<div id="commentsvote-'.$current_CommentID.'" class="commentsvote">';
		$completelink .= '<span>'.$link.'</span>';
		$completelink .= '</div>';
	}
	else
	{
		$register_link = site_url('wp-login.php', 'login') ;
		$completelink = '<div class="commentlink" >'." <a href=".$register_link.">".$votes." Votes"."</a>".'</div>';
	}
    return $completelink;
}
function commentsvote_comment_text($content)
{
    return $content.commentsvote_showlink();
}
//add_filter('comment_text', commentsvote_comment_text);


function commentsvote_ajaxhandler()
{
	if ( !wp_verify_nonce( $_POST['nonce'], "commentsvote_nonce")) {
      exit("Something Wrong");
   }  

    $results = '';
    global $wpdb;
	if( get_option('commentvotelogin') != 'yes' || is_user_logged_in() )
	{
	
		$commentid = $_POST['commentid'];
		$votecount = get_comment_meta($commentid, '_commentsvote', true) != '' ? get_comment_meta($commentid, '_commentsvote', true) : '0';
		$votecountNew = $votecount - 1;
		update_comment_meta($commentid, '_commentsvote', $votecountNew);
		
		$results.='<div class="votescore" >'.$votecountNew.'</div>';
	}
     
	 //Return the String
    die($results);
}
// creating Ajax call for WordPress

add_action( 'wp_ajax_nopriv_commentsvote_ajaxhandler', 'commentsvote_ajaxhandler' );
add_action( 'wp_ajax_commentsvote_ajaxhandler', 'commentsvote_ajaxhandler' );

// Settings
add_action('admin_menu', 'commentvote_create_menu');
function commentvote_create_menu() {
	add_submenu_page('options-general.php','Comments Vote','Comments Vote','manage_options', __FILE__.'comments_settings_page','comments_settings_page');
}
function comments_settings_page() {
?>
	<div class="wrap">
	<?php
	
	if( isset( $_POST['commentvotesubmit'] ) )
	{
		update_option( 'commentvotelogin' , $_POST[ 'commentvotelogin' ] );
	}
	?>
		<div id="commentvotesetting">
			<form id='commentvotesettingform' method="post" action="">
				<h1><?php echo 'Settings'; ?></h1>
				<Input type = 'Radio' Name ='commentvotelogin' value= 'yes' <?php if( get_option('commentvotelogin') == 'yes' ) echo 'checked';?> >Voting allowed to only logged in users
				<br/>
				<Input type = 'Radio' Name ='commentvotelogin' value= 'no' <?php if( get_option('commentvotelogin') != 'yes' ) echo 'checked';?> >Voting allowed to non logged in users
				<br/><br/>
				<p class="submit">
				<input type="submit" id="commentvotesubmit" name="commentvotesubmit" class="button-primary" value="<?php echo 'Save'; ?>" />
				</p>
			</form>
		</div>
	</div>
<?php
}
function commentsvote_get_top_voted_comments($post_id)
{
	
	$commentids = array();
	 global $wpdb;

	 $request = "
	select * from $wpdb->comments , $wpdb->commentmeta where 			
				$wpdb->comments.comment_post_ID = ".$post_id.
				" AND $wpdb->comments.comment_ID = $wpdb->commentmeta.comment_ID
				AND $wpdb->commentmeta.meta_key = '_commentsvote'
				ORDER BY $wpdb->commentmeta.meta_value+0 DESC";

	
    $comments = $wpdb->get_results($request);
		
	foreach ($comments as $comment) 
	{
			array_push( $commentids , $comment->comment_ID );
	}

	return $commentids;
}

function show_top_voted_comments($content)
{
	
	$result = "";
	$post_ID = get_the_ID();
	
	$commentids = commentsvote_get_top_voted_comments($post_ID);
	
	if(count($commentids) > 0 )
		$result = "Top Comments for this post:<br/>";
	
	foreach ($commentids as $commentid) 
	{
			$votecount = get_comment_meta($commentid, '_commentsvote', true) != '' ? get_comment_meta($commentid, '_commentsvote', true) : '0';
			$result .=get_comment_excerpt($commentid) .'('.$votecount.')'.'<br/>';
	}
	
	
	return $content.$result;
	
}

//add_filter('the_content', show_top_voted_comments);
?>