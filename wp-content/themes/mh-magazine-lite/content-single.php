<?php /* Default template for displaying content. */ ?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header mh-clearfix"><?php
		the_title('<h1 class="entry-title">', '</h1>');
		 if (current_user_can('administrator')) { ?>
			<div>
				<?php 
					if (has_category(100, $post->ID)) 
						{ ?> 

						<button class="remove-editors-picks-btn" data-id="<?php echo $post->ID; ?>" type="button">Remove from Editor's Picks</button>		
				<?php		
						}
						else
						{ ?>
						<button class="editors-picks-btn" data-id="<?php echo $post->ID; ?>" type="button">Add to Editor's Picks</button>	
				<?php
						}
				 ?>
			</div>
		<?php } 
		mh_post_header(); ?>
	</header>
	<?php dynamic_sidebar('posts-1'); ?>
	<div class="entry-content mh-clearfix"><?php
		mh_magazine_lite_featured_image();
		the_content(); ?>
	</div><?php
	the_tags('<div class="entry-tags mh-clearfix"><i class="fa fa-tag"></i><ul><li>','</li><li>','</li></ul></div>');
	dynamic_sidebar('posts-2'); 
	?>
</article>