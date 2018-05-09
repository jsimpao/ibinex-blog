jQuery(document).ready(function($) {

	var editors_pick = [];
	var pick;

	$('.editors-picks-btn').click(function() {

		var postID = $(this).data('id');

		// editors_pick.push(postID);
		var data = {
				'action' : 'my_action',
				'post_id' : postID
		};
		jQuery.post(
			my_ajax_object.ajax_url, data, function(response) {
				alert(response);
		});
	});
});


	
