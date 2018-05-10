jQuery(document).ready(function($) {

	var editors_pick = [];
	var pick;

	$('.editors-picks-btn').click(function() {

		var postID = $(this).data('id');
	
		var data = {
				'action' : 'add_to_editor',
				'post_id' : postID
		};
		jQuery.post(
			my_ajax_object.ajax_url, data, function(response) {

				
				alert('Article has been added.');
		});
	});


	$('.remove-editors-picks-btn').click(function() {
		var postID = $(this).data('id');

	});


});


	
