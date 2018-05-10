jQuery(document).ready(function($) {

	var editors_pick = [];
	var pick;

	$('.admin-btns').on('click', '.add-editors-picks-btn', function() {

		var postID = $(this).data('id');
	
		var data = {
				'action' : 'add_to_editors_action',
				'post_id' : postID
		};
		jQuery.post(my_ajax_object.ajax_url, data, function(response) {
			$('#add'+postID).removeClass('add-editors-picks-btn');
			$('#add'+postID).addClass('remove-editors-picks-btn');
			$('#add'+postID).html('Remove from Editor\'s Picks');
			$('#add'+postID).attr('id','remove'+postID);
			alert('Article has been added.');
		});
	});


	$('.admin-btns').on('click', '.remove-editors-picks-btn', function() {
		var postID = $(this).data('id');

		var data = {
				'action' : 'remove_from_editors_action',
				'post_id' : postID
		};

		jQuery.post(my_ajax_object.ajax_url, data, function(response) {
			$('#remove'+postID).removeClass('remove-editors-picks-btn');
			$('#remove'+postID).addClass('add-editors-picks-btn');
			$('#remove'+postID).html('Add to Editor\'s Picks');
			$('#remove'+postID).attr('id','add'+postID);
			alert('Article has been removed.' + response);
		});

	});
});


	
