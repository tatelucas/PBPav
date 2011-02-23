<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
<title><?php dynamictitles(); ?></title>

<?php if (is_single() || is_page() ) : if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
<meta name="description" content="<?php the_excerpt_rss(); ?>" />
<?php keyword_tags(); ?>
<?php endwhile; endif; elseif(is_home()) : ?>
<meta name="description" content="<?php bloginfo('description'); ?>" />
<?php endif; ?>
<?php if(is_home() || is_single() || is_page()) 
{ echo '<meta name="robots" content="index,follow" />'; } 
else { echo '<meta name="robots" content="noindex,follow" />'; } ?>

<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="screen,projection" />
<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/css/print.css" type="text/css" media="print" />
<link rel="shortcut icon" href="<?php bloginfo('template_url'); ?>/images/favicon.ico" />
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />

<link rel="stylesheet" type="text/css" href="<?php bloginfo('template_url'); ?>/css/jcarousel.css" />
<link rel="stylesheet" type="text/css" href="<?php bloginfo('template_url'); ?>/css/jquery-ui.css" />

<script type="text/javascript" src="http://use.typekit.com/pfu1ygk.js"></script>
<script type="text/javascript">try{Typekit.load();}catch(e){}</script>

<?php nav_animation(); ?>
<?php wp_head(); ?>

</head>

<body <?php body_class(); ?>>
<div id="wrapper">

<div id="masthead">

  <div id="branding">
    <div id="logo">
      <a href="<?php echo get_option('home'); ?>/" title="<?php _e('Home','gravy'); ?>"><?php bloginfo('name'); ?></a>
    </div><!--/logo-->
  </div><!--/branding-->
  
  <div class="kingsnavcont">
    <?php wp_nav_menu( array( 'container_class' => 'kings-nav', 'theme_location' => 'kings' ) ); ?>
    <a href="http://www.twitter.com" class="twittericon">Twitter</a>    
    <a href="http://www.facebook.com" class="fbicon">Facebook</a>

  </div><!--/kingsnavcont-->
  
  <div class="topnavcont">
    <?php wp_nav_menu( array( 'container_class' => 'top-nav', 'theme_location' => 'primary' ) ); ?>

    <div class="searchform">
      <form method="get" id="searchform" action="<?php bloginfo('url'); ?>/">
        <input type="text" onblur="if (this.value == '') {this.value = 'Search';}" onfocus="if (this.value == 'Search') {this.value = '';}" value="<?php if ($_REQUEST['s']) { the_search_query(); } else { echo 'Search'; } ?>" name="s" id="searchfield" />
        <input type="submit" value="Go" id="searchsubmit" alt="search button" />
        <a href="#" class="searchweb">Web</a>
      </form>
    </div><!--/searchform-->

  </div>
   
  <div id="eventheadslider" class="jcarousel-skin-tango">
    <ul id="mycarousel" class="jcarousel-skin-tango">
      <?php
      query_posts("post_type=event&showposts=12&category_name=featured");
      ?>
    	<?php 
    	if (have_posts()) : while (have_posts()) : the_post(); 
    	$image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' ); 
      $eventtime = get_post_meta($post->ID, 'datetime'); 
       
    	?>
      <li class="eventhead">
          <a href="<?php the_permalink(); ?>">
            <img src="<?php bloginfo('template_url'); ?>/scripts/timthumb.php?src=<?php echo $image[0] ?>&h=94&w=224px&zc=1" alt="" />
          </a>
          <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?> - <?php echo date('M d', $eventtime[0]); ?></a></h3>         
      </li>
    	<?php endwhile; ?>      
      <?php endif; ?>      
      <?php wp_reset_query(); ?>           
    </ul>  
  </div>  

</div><!--/masthead-->

<div id="main">

