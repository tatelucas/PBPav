<?php
/*
Template Name: Homepage
*/
?>

<?php get_header(); ?>

<div id="content">

  <div class="homepageslidercont">
    <!-- Slider goes here -->
    
  </div><!--/homepageslidercont-->

  <div class="homepagecontent">

    <div id="tabs">
    	<ul>
    		<li><a href="#tabs-1">Events</a></li>
    		<li><a href="#tabs-2">News</a></li>
    		<li class="last"><a href="#tabs-3">Promos</a></li>
    	</ul>
    	<div id="tabs-1">
    
        <div class="homeevent">
          <a href="#">
            <img src="<?php bloginfo('template_url'); ?>/images/eventexample.jpg" />
          </a>
          <div class="eventdetails">
            <h4><a href="#">Jaime Foxx</a></h4>
            <p class="eventdate">Thursday January 21, 2011</p>
            <p class="eventexcerpt">
            Check out Jaime Foxx on his brand-new world-wide tour starting this month at Power Balance Pavilion!
            </p>
          </div>
          <div class="eventlinks">
            <a href="#" class="eventmore">More Info</a>
            <a href="#" class="eventbuy">Buy Now</a> 
          </div>
          <div class="clear"></div>
        </div><!--/homeevent-->

        <div class="homeevent">
          <a href="#">
            <img src="<?php bloginfo('template_url'); ?>/images/eventexample.jpg" />
          </a>
          <div class="eventdetails">
            <h4><a href="#">Jaime Foxx</a></h4>
            <p class="eventdate">Thursday January 21, 2011</p>
            <p class="eventexcerpt">
            Check out Jaime Foxx on his brand-new world-wide tour starting this month at Power Balance Pavilion!
            </p>
          </div>
          <div class="eventlinks">
            <a href="#" class="eventmore">More Info</a>
            <a href="#" class="eventbuy">Buy Now</a> 
          </div>
          <div class="clear"></div>
        </div><!--/homeevent-->
        
        <div class="homeevent">
          <a href="#">
            <img src="<?php bloginfo('template_url'); ?>/images/eventexample.jpg" />
          </a>
          <div class="eventdetails">
            <h4><a href="#">Jaime Foxx</a></h4>
            <p class="eventdate">Thursday January 21, 2011</p>
            <p class="eventexcerpt">
            Check out Jaime Foxx on his brand-new world-wide tour starting this month at Power Balance Pavilion!
            </p>
          </div>
          <div class="eventlinks">
            <a href="#" class="eventmore">More Info</a>
            <a href="#" class="eventbuy">Buy Now</a> 
          </div>
          <div class="clear"></div>
        </div><!--/homeevent-->        
    
        <a href="#" class="moreevents">More</a>
    
        <div class="clear"></div>
    
    	</div><!--/tabs-1-->
    	
    	
    	<div id="tabs-2">
    
        <?php
        $page = (get_query_var('paged')) ? get_query_var('paged') : 1;
        query_posts("showposts=6&paged=$page");
        ?>
        
        	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
        		<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
        		
        		<h2 class="posttitle"><a href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?></a></h2>
        		<p class="postmetadata"><em><?php _e('by','gravy'); ?></em> <?php the_author_posts_link('namefl'); ?> <em><?php _e('on','gravy'); ?></em> <?php the_time('M d, Y'); ?> 
             <span class="commentcount">(<?php comments_popup_link('0', '1', '%'); ?>) <?php _e('Comments','gravy'); ?></span>
        </p>
      
      
      		<div class="entry">
      		<?php the_content(); ?>
      		</div>
      		</div>
      	<?php endwhile; ?>
      
      		  <?php numeric_pagination(); ?>
      
      
      	<?php else : ?>
      	
      	<p><?php _e('Not Found','gravy'); ?></p>
      
      	<?php endif; ?>
    
    
    	</div><!--/tabs-2-->
    	<div id="tabs-3">
    		<p>Mauris eleifend est et turpis. Duis id erat. Suspendisse potenti. Aliquam vulputate, pede vel vehicula accumsan, mi neque rutrum erat, eu congue orci lorem eget lorem. Vestibulum non ante. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Fusce sodales. Quisque eu urna vel enim commodo pellentesque. Praesent eu risus hendrerit ligula tempus pretium. Curabitur lorem enim, pretium nec, feugiat nec, luctus a, lacus.</p>
    		<p>Duis cursus. Maecenas ligula eros, blandit nec, pharetra at, semper at, magna. Nullam ac lacus. Nulla facilisi. Praesent viverra justo vitae neque. Praesent blandit adipiscing velit. Suspendisse potenti. Donec mattis, pede vel pharetra blandit, magna ligula faucibus eros, id euismod lacus dolor eget odio. Nam scelerisque. Donec non libero sed nulla mattis commodo. Ut sagittis. Donec nisi lectus, feugiat porttitor, tempor ac, tempor vitae, pede. Aenean vehicula velit eu tellus interdum rutrum. Maecenas commodo. Pellentesque nec elit. Fusce in lacus. Vivamus a libero vitae lectus hendrerit hendrerit.</p>
    	</div><!--/tabs-3-->
    
    </div><!--/tabs-->

  </div><!--/homepagecontent-->

</div><!--/content-->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
