<?php

/***** iBinex Related Posts *****/

class iBinex_related_posts_large extends WP_Widget {
	function __construct() {
		parent::__construct(
			'iBinex_related_posts', esc_html_x('iBinex Related Posts', 'widget name', 'mh-magazine-lite'),
			array(
				'classname' => 'iBinex_related_posts_large',
				'description' => esc_html__('Related Posts Large widget to display posts (large-sized) including thumbnail images.', 'mh-magazine-lite'),
				'customize_selective_refresh' => true
			)
		);
	}

	function widget($args, $instance) {
		global $post;
		
		/* store the post ID of the individual post */
		$current_post_ID = $post->ID;

		/* variable for slugs */
		$current_post_tag_slugs = array();

		$defaults = array('title' => 'Related Posts', 'tags' => '', 'postcount' => 5, 'offset' => 0, 'sticky' => 1);
        $instance = wp_parse_args($instance, $defaults);
		$query_args = array();
		$query_args['ignore_sticky_posts'] = $instance['sticky'];

		/* set the order to random */
		$query_args['orderby'] = 'rand';
		
		if (!empty($instance['postcount'])) {
			$query_args['posts_per_page'] = $instance['postcount'];
		}

		/* Exclude the current post 
			from the LOOP (query) */
		$query_args['post__not_in'] = array($current_post_ID);

		/* get the tag slugs 
			of the current post 
			then store the count*/
		$cnt = array();
		foreach (get_the_tags($current_post_ID) as $tag) {
			array_push($current_post_tag_slugs, $tag->slug);
			$cnt[] = $tag->count;
		}

		/* check if the total number 
			of posts is less than the 
			desired post count */
		if ( (array_sum($cnt) - count($current_post_tag_slugs)) < $query_args['posts_per_page'] ) 
		{

		/* if less, get posts according 
			to category instead */
			$query_args['category__and'] = wp_get_post_categories($post->ID)[0];
		}
		else
		{

		/* else get posts according to tags*/
			$query_args['tag_slug__in'] = $current_post_tag_slugs;
		}

		$widget_posts = new WP_Query($query_args);

        echo $args['before_widget'];
			if ($widget_posts->have_posts()) :
				if (!empty($instance['title'])) {
					echo $args['before_title'] . esc_html(apply_filters('widget_title', $instance['title'])) . $args['after_title'];
				}
				echo '<div class="mh-posts-large-widget">' . "\n";
					while ($widget_posts->have_posts()) :
						$widget_posts->the_post();
						get_template_part('content', 'large');
					endwhile;
					wp_reset_postdata();
				echo '</div>' . "\n";
			endif;
		echo $args['after_widget'];
    }

	function update($new_instance, $old_instance) {
        $instance = array();
        
        if (!empty($new_instance['title'])) {
			$instance['title'] = sanitize_text_field($new_instance['title']);
		}
		if (0 !== absint($new_instance['postcount'])) {
			if (absint($new_instance['postcount']) > 50) {
				$instance['postcount'] = 50;
			} else {
				$instance['postcount'] = absint($new_instance['postcount']);
			}
		}
        return $instance;
    }

    function form($instance) {
        $defaults = array('title' => '', 'category' => 0, 'tags' => '', 'postcount' => 1, 'offset' => 0, 'sticky' => 1);
        $instance = wp_parse_args($instance, $defaults); ?>
        <p>
        	<label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php esc_html_e('Title:', 'ibinex'); ?></label>
			<input class="widefat" type="text" value="<?php echo esc_attr($instance['title']); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" id="<?php echo esc_attr($this->get_field_id('title')); ?>" />
        </p>	
        <p>
        	<label for="<?php echo esc_attr($this->get_field_id('postcount')); ?>"><?php esc_html_e('Post Count (max. 50):', 'ibinex'); ?></label>
			<input class="widefat" type="text" value="<?php echo absint($instance['postcount']); ?>" name="<?php echo esc_attr($this->get_field_name('postcount')); ?>" id="<?php echo esc_attr($this->get_field_id('postcount')); ?>" />
	    </p>  
    	<?php
    }
}