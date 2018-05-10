<?php /* Loop Template used for index/archive/search */ ?>
<article <?php post_class('mh-loop-item mh-clearfix'); ?>>
	<figure class="mh-loop-thumb">
		<a href="<?php the_permalink(); ?>"><?php
			if (has_post_thumbnail()) {
				the_post_thumbnail('mh-magazine-lite-medium');
			} else {
				echo '<img class="mh-image-placeholder" src="' . get_template_directory_uri() . '/images/placeholder-medium.png' . '" alt="' . esc_html__('No Image', 'mh-magazine-lite') . '" />';
			} ?>
		</a>
	</figure>
	<div class="mh-loop-content mh-clearfix">
		<header class="mh-loop-header">
			<h3 class="entry-title mh-loop-title">
				<a href="<?php the_permalink(); ?>" rel="bookmark">
					<?php the_title(); ?>
				</a>
			</h3>
			<div class="mh-meta mh-loop-meta">
				<?php mh_magazine_lite_loop_meta(); ?>
			</div>
		</header>
		<div class="mh-loop-excerpt">
			<?php the_excerpt(); ?>
		</div>
	</div>
<?php if (current_user_can('administrator')) { ?>
	<div class="admin-btns">
		<?php 
			if (has_category(100, $post->ID)) 
				{ ?> 

				<button id="remove<?php echo $post->ID; ?>" class="remove-editors-picks-btn" data-id="<?php echo $post->ID; ?>" type="button">Remove from Editor's Picks</button>		
		<?php		
				}
				else
				{ ?>
				<button id="add<?php echo $post->ID; ?>" class="add-editors-picks-btn" data-id="<?php echo $post->ID; ?>" type="button">Add to Editor's Picks</button>	
		<?php
				}
		 ?>
	</div>
<?php } ?>
</article>