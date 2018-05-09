jQuery(document).ready(function($) {
	$('.mh-loop-content').click('.editors-picks-btn', function() {

		var postID = $(this).data('id');
		var data = {
				'action' : 'editors_picks_actionmark',
				'post_id' : postID
		};
		jQuery.post(
			my_ajax_object.ajax_url, data, function(response) {
				alert(response);
		});
	});
});