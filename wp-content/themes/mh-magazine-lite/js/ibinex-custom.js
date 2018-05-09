jQuery(document).ready(function($) {

	var editors_pick = [];

	$('.editors-picks-btn').click(function() {

		var postID = $(this).data('id');

		editors_pick.push(postID);
		var data = {
				'action' : 'my_action',
				'post_id_array' : editors_pick
		};
		jQuery.post(
			my_ajax_object.ajax_url, data, function(response) {
				alert(response);
		});
	});
});


	
