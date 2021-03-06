<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>

<?php
if($job->id != ''){

include_once($_SERVER['DOCUMENT_ROOT']."/wordpress_op2/wp-content/banners/config.php");
$homeurl = curPageURL();
if ($fbuser) {
  try {
	 	$user_profile = $facebook->api('/me');
		//Get user pages details using Facebook Query Language (FQL)
		$fql_query = 'SELECT page_id, name, page_url FROM page WHERE page_id IN (SELECT page_id FROM page_admin WHERE uid='.$fbuser.')';
		$postResults = $facebook->api(array( 'method' => 'fql.query', 'query' => $fql_query ));
	} catch (FacebookApiException $e) {
		echo $e->getMessage();
		$fbuser = null;
  }
}else{
		//Show login button for guest users
		$loginUrl = $facebook->getLoginUrl(array('redirect_uri'=>$homeurl,'scope'=>$fbPermissions));
		echo '<a href="'.$loginUrl.'"><img src="http://'.$_SERVER['HTTP_HOST'].'/wp-content/banners/facebook-login.png" border="0"></a>';
		$fbuser = null;
}

if($fbuser && empty($postResults))
{
		/*
		if user is logged in but FQL is not returning any pages, we need to make sure user does have a page
		OR "manage_pages" permissions isn't granted yet by the user. 
		Let's give user an option to grant application permission again.
		*/
		$loginUrl = $facebook->getLoginUrl(array('redirect_uri'=>$homeurl,'scope'=>$fbPermissions));
		echo '<br />Could not get your page details!';
		echo '<br /><a href="'.$loginUrl.'">Click here to try again!</a>'; 
		
}elseif($fbuser && !empty($postResults)){

//Everything looks good, show message form.
?>

<form id="multiform" name="multiform" method="post" action="<?php echo 'http://'.$_SERVER['HTTP_HOST'];?>/wp-content/banners/process.php" enctype="multipart/form-data">
Post to Facebook Page Wall. <?php
/*
Get Log out URL
Due to some bug or whatever, SDK still thinks user is logged in even
after user logs out. To deal with it, user is redirected to another page "logged-out.php" after logout
it is working fine for me with this trick. Hope it works for you too.
*/

$logout = 'http://'.$_SERVER['HTTP_HOST'].'/wp-content/banners/';
$logOutUrl = $facebook->getLogoutUrl(array('next'=>$logout.'logged-out.php'));
echo '<a href="'.$logOutUrl.'">Log Out</a>';
?>
<table><tr><td class="wpjb-info-label">
<label>Post image</label></td>
<td class="wpjb-info-label">
<input type="file" name="pic" />
</td>
</tr><tr><td class="wpjb-info-label">
<label>Header message</label></td><td class="wpjb-info-label">
<input type="text" name="message" size="40" placeholder="< VIỆC LÀM BÁN THỜI GIAN - CẦN TUYỂN >">
</td></tr><tr><td class="wpjb-info-label">
<label>Footer message</label></td><td class="wpjb-info-label">
<textarea name="fmessage">♥♥♥ Còn nhiều công việc mới đang chờ bạn tại : http://sagojo.com/viec-lam/</textarea>
</td></tr><tr><td class="wpjb-info-label">
<label>Select a Page</label></td><td class="wpjb-info-label">
<select name="userpages" id="upages">
	<?php
    foreach ($postResults as $postResult) {
            echo '<option value="'.$postResult["page_id"].'">'.$postResult["name"].'</option>';
        }
    ?>
</select>
<input type="hidden" name="homeurl" value="<?php  echo $homeurl;?>">
<input type="hidden" name="jobID" value="<?php echo $job->id;?>">
<input type="hidden" name="job_slug" value="<?php echo $return_link;?>">
<button type="submit" class="button" id="submit_button">Send Message</button>
</td></tr></table>
<div class="spacer"></div>
</form>
<?php /*</div>*/?>
<div id="multi-msg"></div>
<script type="text/javascript">
	var j = jQuery.noConflict();
</script>
<script>
j(document).ready(function()
{


 function getDoc(frame) {
     var doc = null;
     
     // IE8 cascading access check
     try {
         if (frame.contentWindow) {
             doc = frame.contentWindow.document;
         }
     } catch(err) {
     }

     if (doc) { // successful getting content
         return doc;
     }

     try { // simply checking may throw in ie8 under ssl or mismatched protocol
         doc = frame.contentDocument ? frame.contentDocument : frame.document;
     } catch(err) {
         // last attempt
         doc = frame.document;
     }
     return doc;
 }

j("#multiform").submit(function(e)
{
		j("#multi-msg").html("<div align='center'><img src='http://www.sagojo.com/wp-content/banners/loading_round.gif'/></div>");

	var formObj = j(this);
	var formURL = formObj.attr("action");

if(window.FormData !== undefined)  // for HTML5 browsers
//	if(false)
	{
	
		var formData = new FormData(this);
		j.ajax({
        	url: formURL,
	        type: 'POST',
			data:  formData,
			mimeType:"multipart/form-data",
			contentType: false,
    	    cache: false,
        	processData:false,
			success: function(data, textStatus, jqXHR)
		    {
					$("#multi-msg").html('<pre><code>'+data+'</code></pre>');
		    },
		  	error: function(jqXHR, textStatus, errorThrown) 
	    	{
				$("#multi-msg").html('<pre><code class="prettyprint">AJAX Request Failed<br/> textStatus='+textStatus+', errorThrown='+errorThrown+'</code></pre>');
	    	} 	        
	   });
        e.preventDefault();
   }
   else  //for olden browsers
	{
		//generate a random id
		var  iframeId = 'unique' + (new Date().getTime());

		//create an empty iframe
		var iframe = $('<iframe src="javascript:false;" name="'+iframeId+'" />');

		//hide it
		iframe.hide();

		//set form target to iframe
		formObj.attr('target',iframeId);

		//Add iframe to body
		iframe.appendTo('body');
		iframe.load(function(e)
		{
			var doc = getDoc(iframe[0]);
			var docRoot = doc.body ? doc.body : doc.documentElement;
			var data = docRoot.innerHTML;
			$("#multi-msg").html('<pre><code>'+data+'</code></pre>');
		});
	
	}

});


j("#multi-post").click(function()
	{
		
	j("#multiform").submit();
	
});

});
</script>

<?php
}
} else {
	echo "Access Denied";
}
?>

