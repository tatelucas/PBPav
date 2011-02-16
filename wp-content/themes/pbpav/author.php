<?php get_header(); ?>

	<div id="content">

	<?php if (have_posts()) : ?>

<h1 class="pagetitle"><?php _e('Author Archives','gravy'); ?> <a class="rss" href="<?php echo get_author_posts_url( $author, ""); ?>feed/"><img src="<?php bloginfo('template_url'); ?>/images/rss.png" id="icon-rss" alt="rss" /></a></h1>

        <div id="writer">
        <?php
            global $wp_query;
            $curauth = $wp_query->get_queried_object();
            echo get_avatar( $curauth->user_email, '80' );
        ?>
        <p><?php echo $curauth->user_description; ?></p>
        </div><!--/writer-->

			<?php while (have_posts()) : the_post(); ?>

					<?php include (TEMPLATEPATH . '/includes/loop.php'); ?>

			<?php endwhile; ?>
		
		  <?php numeric_pagination(); ?>

		
	<?php else : ?>

		<h2 class="pagetitle"><?php _e('Search Results','gravy'); ?></h2>
		<p><?php _e('Not Found','gravy'); ?></p>

	<?php endif; ?>

	</div><!--/content-->

<?php get_sidebar(); ?>

<?php get_footer(); ?>