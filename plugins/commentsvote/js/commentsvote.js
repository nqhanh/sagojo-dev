function commentsvote_add(comment_id,nonce)
{
	
	jQuery.ajax({
	type: 'POST',
	url: votecommentajax.ajaxurl,
	data: {
	action: 'commentsvote_ajaxhandler',
	commentid: comment_id,
	nonce:nonce
},
success:function(data, textStatus, XMLHttpRequest){
	var linkofcomment = '#commentsvote-' + comment_id;
	jQuery(linkofcomment).html('');
	jQuery(linkofcomment).append(data);
	},
	error: function(MLHttpRequest, textStatus, errorThrown){
		alert(errorThrown);
		}
	});
	
}