<?php

/***** MH Custom Posts [lite] *****/

class iBinex_editors_pick extends WP_Widget {
    function __construct() {
		parent::__construct(
			'iBinex_editors_pick', esc_html_x('iBinex Editor\'s Pick', 'widget name', 'ibinex'),
			array(
				'classname' => 'mh_custom_posts',
				'description' => esc_html__('Custom Posts Widget to display posts Editor\'s choice.', 'ibinex'),
				'customize_selective_refresh' => true
			)
		);

		add_action('wp_ajax_my_action', array($this,'editors_picks_actionmark'));
		add_action('wp_ajax_nopriv_my_action', array($this,'editors_picks_actionmark'));
	}

    function widget($args, $instance) {

	    $defaults = array('title' => 'Editor\'s Picks', 'postcount' => 5);
		$instance = wp_parse_args($instance, $defaults);
	   	$query_args = array();

		if (!empty($instance['postcount'])) {
			$query_args['posts_per_page'] = $instance['postcount'];
		}

		/* query posts with 
			category 'editor' */
		$query_args['cat'] = 100;
		$query_args['orderby'] = 'meta_value';
		
		$widget_loop = new WP_Query($query_args);  
        echo $args['before_widget'];
        	if (!empty($instance['title'])) {
				echo $args['before_title'];
					if ($instance['category'] != 0) {
						echo '<a href="' . esc_url(get_category_link($instance['category'])) . '" class="mh-widget-title-link">';
					}
					echo esc_html(apply_filters('widget_title', $instance['title']));
					if ($instance['category'] != 0) {
						echo '</a>';
					}
				echo $args['after_title'];
			} ?>
			<ul class="mh-custom-posts-widget mh-clearfix"><?php
				while ($widget_loop->have_posts()) : $widget_loop->the_post(); ?>
					<li class="post-<?php the_ID(); ?> mh-custom-posts-item mh-custom-posts-small mh-clearfix">
						<figure class="mh-custom-posts-thumb">
							<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php
								if (has_post_thumbnail()) {
									the_post_thumbnail('mh-magazine-lite-small');
								} else {
									echo '<img class="mh-image-placeholder" src="' . get_template_directory_uri() . '/images/placeholder-small.png' . '" alt="' . esc_html__('No Image', 'mh-magazine-lite') . '" />';
								} ?>
							</a>
						</figure>
						<div class="mh-custom-posts-header">
							<p class="mh-custom-posts-small-title">
								<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
									<?php the_title(); ?>
								</a>
							</p>
							<div class="mh-meta mh-custom-posts-meta">
								<?php mh_magazine_lite_loop_meta(); ?>
							</div>
						</div>
					</li><?php
				endwhile;
				wp_reset_postdata(); ?>
        	</ul><?php
        echo $args['after_widget'];
    }

    function update($new_instance, $old_instance) {
        $instance = array();
        if (!empty($new_instance['title'])) {
			$instance['title'] = sanitize_text_field($new_instance['title']);
		}


		if (0 !== absint($new_instance['postcount'])) {
			if (absint($new_instance['postcount']) > 10) {
				$instance['postcount'] = 10;
			} else {
				$instance['postcount'] = absint($new_instance['postcount']);
			}
		}
        return $instance;
    }

    function form($instance) {
	    $defaults = array('title' => '', 'postcount' => 5);
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


    public $editors_pick = array();
    public $pick;
	function editors_picks_actionmark()
	{	
		if (isset($_POST['post_id'])) {
			 $pick = $_POST['post_id'];

			/* append 'editor' 
				category to a post */
			wp_set_post_categories($pick, 100, true);
			wp_die();
		}
	}
}

?>