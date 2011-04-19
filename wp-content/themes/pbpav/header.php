<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
<title><?php dynamictitles(); ?></title>

<?php if (is_single() || is_page() ) : if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
<?php
ob_start();
the_excerpt();
$content = ob_get_clean();
?>
<meta name="description" content="<?php echo strip_tags($content); ?>" />
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

<!--[if IE]>
        <link rel="stylesheet" type="text/css" href="<?php bloginfo('template_url'); ?>/css/ie-only.css" />
<![endif]-->


<script type="text/javascript" src="http://use.typekit.com/pfu1ygk.js"></script>
<script type="text/javascript">try{Typekit.load();}catch(e){}</script>

<?php nav_animation(); ?>
<?php wp_head(); ?>

<script type="text/javascript" src="http://w.sharethis.com/button/buttons.js"></script><script type="text/javascript">stLight.options({publisher:'2ba9d27c-e8a1-4a67-a4de-7032a0c9f339'});</script>


<style type="text/css">
body {
  background-image: url(/wp-content/gallery/backgrounds/rotate.php);
  background-position: center top;
  background-repeat: no-repeat;
} 
</style>

<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-21838204-1']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>

<script type="text/javascript">var switchTo5x=true;</script><script type="text/javascript" src="http://w.sharethis.com/button/buttons.js"></script><script type="text/javascript">stLight.options({publisher:'2ba9d27c-e8a1-4a67-a4de-7032a0c9f339'});</script>

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
    <a href="http://www.twitter.com/pbpav" target="_blank" class="twittericon">Twitter</a>    
    <a href="http://www.facebook.com/powerbalancepavilion" target="_blank" class="fbicon">Facebook</a>

  </div><!--/kingsnavcont-->
  
  <div class="topnavcont">
    <?php wp_nav_menu( array( 'container_class' => 'top-nav', 'theme_location' => 'primary' ) ); ?>

    <div class="searchform">
      <form method="get" id="searchform" action="<?php bloginfo('url'); ?>/">
        <input type="text" onblur="if (this.value == '') {this.value = 'Search';}" onfocus="if (this.value == 'Search') {this.value = '';}" value="<?php if ($_REQUEST['s']) { the_search_query(); } else { echo 'Search'; } ?>" name="s" id="searchfield" />
        <input type="submit" value="Go" id="searchsubmit" />
        <a href="#" class="searchweb">Web</a>
      </form>
    </div><!--/searchform-->

    <div class="hiddengoogle">
    <form method="get" action="http://www.google.com/search" id="googleform">
    
    <input type="text"   name="q" size="31" id="googleq"
     maxlength="255" value="" />
    <input type="submit" value="Google Search" />
    <input type="radio"  name="sitesearch" value="" checked />
    </form>
    </div>

  </div>
   
  <div id="eventheadslider" class="jcarousel-skin-tango">
    <ul id="mycarousel" class="jcarousel-skin-tango">
      <?php
      //query_posts("post_type=event&showposts=12&sitelocation=featured");

        $topfeaturedargs = array(
        'post_type' => 'event',
        'showposts' => '12',
        'meta_key' => 'removedate',
        'meta_compare' => '>=',
        'meta_value' => mktime(),
        'sitelocation' => 'featured'     
        );

        $top_featured_posts = query_posts($topfeaturedargs);  

      /*
      $top_featured_posts = get_posts(array(
        'numberposts' => 12,
        'sitelocation' => 'featured',
        'post_type' => array('event')
      ));
      */
      
      ?>
    	<?php 
    	//if (have_posts()) : while (have_posts()) : the_post(); 
      foreach ($top_featured_posts as $post) {
      setup_postdata($post);
    	$image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' ); 
      $eventtime = get_post_meta($post->ID, 'datetime'); 
      $shorttitle = get_post_meta($post->ID, 'shorttitle'); 
    	?>
      <li class="eventhead">
          <a href="<?php the_permalink(); ?>">
            <img src="<?php bloginfo('template_url'); ?>/scripts/timthumb.php?src=<?php echo $image[0] ?>&amp;h=94&amp;w=224px&amp;zc=1" alt="" />
          </a>
          <h3><a href="<?php the_permalink(); ?>"><?php echo $shorttitle[0] ?></a></h3>         
      </li>   
    <?php } ?>    
    </ul>  
     
    <?php wp_reset_query(); ?>  
  </div>  

</div><!--/masthead-->
<div class="clear"></div>
<div id="main">

