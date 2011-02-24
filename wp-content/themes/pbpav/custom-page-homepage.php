<?php
/*
Template Name: Homepage
*/
?>

<?php get_header(); ?>

<div id="content">

  <div class="homepageslidercont">
    <div class="postslider">
    <?php
    // Load 7 latest posts in the 'Featured' category
    $featured_posts = get_posts(array(
      'numberposts' => 7,
      'sitelocation' => 'billboard',
      'post_type' => array('post','event')
    ));

    if ($featured_posts) {
      echo '<ul>';
      $post_count = 0;
      foreach ($featured_posts as $post) {
        setup_postdata($post);
        ++$post_count;

        if (has_post_thumbnail()) {
          echo "<li id=\"post_count-{$post_count}\">";
          the_post_thumbnail('featured');
          echo "</li>";
        }
      }
      echo '</ul>';
    }
    ?>
    </div>

      <div class="content">
        <?php 
        if ($featured_posts) {
          $post_count = 0;
          foreach ($featured_posts as $post) {
            setup_postdata($post);
            ++$post_count;

            echo "<div id=\"post_count-{$post_count}_div\">";
            ?>
            <h2><?php the_title() ?></h2>
            <p><?php the_excerpt() ?></p>
            <?php
            echo "</div>";
          }
        }
        ?>
      </div>

    <div class="vertical">
    <?php
    if ($featured_posts) {
      $post_count = 0;
      foreach ($featured_posts as $post) {
        setup_postdata($post);
        ++$post_count;
        ?>
        <a href="" id="<?php echo "post_count-{$post_count}"; ?>">
          <?php
          if (has_post_thumbnail()) {
            the_post_thumbnail('small-thumbnail');
          }
          ?>
        </a>
        <?php
      }
    }
    ?>
    </div>

    <div style="clear:both"></div>
  </div><!--/homepageslidercont-->
  <script type="text/javascript">
    jQuery('.homepageslidercont .postslider ul').cycle({timeout:8000,fx:'scrollDown',speed:500,pager:'.homepageslidercont .vertical',pagerEvent:'click mouseenter mouseleave',pauseOnPagerHover:1,enableCustom:true,imageParentId:'.homepageslidercont',imageParentIdHover:true,before:marqueeBeforeShow,prefix:'marquee',delay:0});
  </script>

  <div class="homepagecontent">

    <div id="tabs">
    	<ul>
    		<li><a href="#tabs-1">Events</a></li>
    		<li><a href="#tabs-2">News</a></li>
    		<li class="last"><a href="#tabs-3">Promos</a></li>
    	</ul>
    	<div id="tabs-1">
    
        <?php
        $page = (get_query_var('paged')) ? get_query_var('paged') : 1;
        query_posts("post_type=event&showposts=6&paged=$page");
        ?>
        
        	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
          <?php include (TEMPLATEPATH . '/includes/eventloop.php'); ?>
        	<?php endwhile; ?>
        
        		  <?php //numeric_pagination(); ?>
        
        
        	<?php else : ?>
        	
        	<p><?php _e('Not Found','gravy'); ?></p>
        
        	<?php endif; ?>
    
        <a href="/events/" class="moreevents">More</a>
    
        <div class="clear"></div>
    
    	</div><!--/tabs-1-->
    	
    	
    	<div id="tabs-2">
    	
        <div class="homenewscont">
        <?php
        query_posts("showposts=6&cat=8");
        ?>

        	<?php 
        	  if (have_posts()) : while (have_posts()) : the_post(); 
            $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' );             	
        	?>
            
            <div class="homeevent">        		
        		  <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
              <a href="<?php the_permalink(); ?>">
                <img src="<?php bloginfo('template_url'); ?>/scripts/timthumb.php?src=<?php echo $image[0] ?>&h=95&w=152px&zc=1" alt="" />
              </a>
              <div class="eventdetails">
            		<h4 class="posttitle"><a href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?></a></h4>     
                <div class="eventexcerpt">
              		<div class="entry">
              		<?php the_excerpt(); ?>
              		</div><!--/entry-->
              	</div><!--/eventexcerpt-->	
            	</div><!--/eventdetails-->	
            	<div class="eventlinks">
                <a href="<?php the_permalink(); ?>" class="eventmore">More Info</a>
              </div><!--/eventlinks-->
        		</div><!--/post-->
        		<div class="clear"></div>
        	</div><!--/homeevent-->	
      	
      	<?php endwhile; ?>
      
        <?php //numeric_pagination(); ?>
      	
      	<?php else : ?>
      	<p><?php _e('Not Found','gravy'); ?></p>
      	<?php endif; ?>

    
        <a href="/news/" class="moreevents">More</a>
    
        <div class="clear"></div>
    
    
        </div><!--/homenews-->
    	</div><!--/tabs-2-->
    	<div id="tabs-3">


        <div class="homenewscont">
        <?php
        query_posts("showposts=6&cat=7");
        ?>

        	<?php 
        	  if (have_posts()) : while (have_posts()) : the_post(); 
            $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' );             	
        	?>
            
            <div class="homeevent">        		
        		  <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
              <a href="<?php the_permalink(); ?>">
                <img src="<?php bloginfo('template_url'); ?>/scripts/timthumb.php?src=<?php echo $image[0] ?>&h=95&w=152px&zc=1" alt="" />
              </a>
              <div class="eventdetails">
            		<h4 class="posttitle"><a href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?></a></h4>     
                <div class="eventexcerpt">
              		<div class="entry">
              		<?php the_excerpt(); ?>
              		</div><!--/entry-->
              	</div><!--/eventexcerpt-->	
            	</div><!--/eventdetails-->	
            	<div class="eventlinks">
                <a href="<?php the_permalink(); ?>" class="eventmore">More Info</a>
              </div><!--/eventlinks-->
        		</div><!--/post-->
        		<div class="clear"></div>
        	</div><!--/homeevent-->	
      	
      	<?php endwhile; ?>
      
        <?php //numeric_pagination(); ?>
      	
      	<?php else : ?>
      	<p><?php _e('Not Found','gravy'); ?></p>
      	<?php endif; ?>

    
        <a href="/news/" class="moreevents">More</a>
    
        <div class="clear"></div>
    
    
        </div><!--/homenews-->


    	</div><!--/tabs-3-->
    
    </div><!--/tabs-->

  </div><!--/homepagecontent-->

</div><!--/content-->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
