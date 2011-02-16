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


<?php nav_animation(); ?>
<?php wp_head(); ?>

</head>

<body <?php body_class(); ?>>
<div id="wrapper">

<div id="masthead"<?php if (get_header_image() != '') {?> style="background:url(<?php header_image(); ?>) no-repeat;"<?php } ?>>

  <div id="branding">
    <?php if (is_home() && !is_paged()) { ?>
    <div id="logo"><?php bloginfo('name'); ?></div>
    <h1 id="description"><?php bloginfo('description'); ?></h1>
    <?php } else { ?>
    <div id="logo"><a href="<?php echo get_option('home'); ?>/" title="<?php _e('Home','gravy'); ?>">
      <?php bloginfo('name'); ?>
      </a></div>
    <div id="description">
      <?php bloginfo('description'); ?>
    </div>
    <?php } ?>
  </div><!--/branding-->
  
  <form method="get" id="searchform" action="<?php bloginfo('url'); ?>/">
    <input type="text" value="<?php the_search_query(); ?>" name="s" id="searchfield" />
    <input type="image" src="<?php bloginfo('template_url'); ?>/images/magnify.gif" id="searchsubmit" alt="search button" />
  </form>
</div><!--/masthead-->


<?php wp_nav_menu( array( 'container_class' => 'top-nav', 'theme_location' => 'primary' ) ); ?>
<div id="main">

