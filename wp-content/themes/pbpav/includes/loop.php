<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
 
  <?php if (is_single() || is_page()) { 
  // This links the page- or post-title where necessary, and otherwise displays as plain text  
  ?>
 <h1 class="posttitle"><?php the_title(); ?></h1>
  <?php } elseif (is_search()) { ?>
 
   <h2 class="posttitle"><a href="<?php the_permalink() ?>" rel="bookmark"><?php search_title_highlight(); ?></a></h2>
	
    <?php } else { ?>
    
 <h2 class="posttitle"><a href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?></a></h2>

<?php } ?>

<?php if (!is_page()) { 
  // This inserts metadata everywhere except on Pages  
  ?>
<p class="postmetadata"><em><?php _e('by','gravy'); ?></em> <?php the_author_posts_link('namefl'); ?> <em><?php _e('on','gravy'); ?></em> <?php the_time('M d, Y'); ?> 
    <?php if (!is_single()) { ?> <span class="commentcount">(<?php comments_popup_link('0', '1', '%'); ?>) <?php _e('Comments','gravy'); ?></span><?php } ?>
</p>
<?php } ?>


<div class="entry">
<?php if (is_archive()) { 
// This displays an excerpt or the entire post, depending on the context
?>

	<?php the_excerpt(); ?>

   </div><!--/end entry-->
</div><!--/end post-->

<?php } elseif (is_search()) { ?>

   <?php search_excerpt_highlight(); ?>
    
     </div><!--/end entry-->
</div><!--/end post-->

<?php } else { ?>
	<?php the_content(); ?>
    
	<?php wp_link_pages(array(
				'before' => '<p class="nextpage"><strong> '.__('Pages:','gravy').' </strong>', 
				'after' => '</p>', 
				'next_or_number' => 'number')); 
				?>

 <?php if (is_single()) 
 // This adds Tags and 'Edit' link to single-post pages
 { ?>
 
 <p id="tags"><?php the_tags('<span><strong>'.__('Tagged as:','gravy').'</strong> ', ', ', '</span>'); ?></p>
 <?php  } ?>
 
<?php edit_post_link(__('Edit this entry','gravy'), '<p id="wp-edit">', ' &rsaquo;</p>'); ?>

 </div><!--/end entry-->
</div><!--/end post-->

<?php } ?>