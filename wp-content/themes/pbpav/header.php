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

<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>?<?php echo date('mdY'); ?>" type="text/css" media="screen,projection" />
<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/css/print.css" type="text/css" media="print" />
<link rel="shortcut icon" href="<?php bloginfo('template_url'); ?>/images/favicon.ico" />
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />

<link rel="stylesheet" type="text/css" href="<?php bloginfo('template_url'); ?>/css/jcarousel.css" />
<link rel="stylesheet" type="text/css" href="<?php bloginfo('template_url'); ?>/css/jquery-ui.css" />
<link rel="stylesheet" type="text/css" href="<?php bloginfo('template_url'); ?>/css/mosaic.css" />

<!--[if IE]>
        <link rel="stylesheet" type="text/css" href="<?php bloginfo('template_url'); ?>/css/ie-only.css" />
<![endif]-->


<?php
//date_default_timezone_set('America/Los_Angeles');
?>

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

<script type='text/javascript' src='http://partner.googleadservices.com/gampad/google_service.js'>
</script>
<script type='text/javascript'>
GS_googleAddAdSenseService("ca-pub-0813157675530516");
GS_googleEnableAllServices();
</script>
<script type='text/javascript'>
GA_googleAddSlot("ca-pub-0813157675530516", "300x250_PBPAV_MAIN_UPPERRIGHT");
</script>
<script type='text/javascript'>
GA_googleFetchAds();
</script>

<script src="http://mobileroadie.com/clientmodal/js/514" type="text/javascript"></script>

</head>

<body <?php body_class(); ?>>
<div id="wrapper">

<div id="masthead">
  <div class="greybg">
    <div id="branding">
      <div id="logo">
        <a href="<?php echo get_option('home'); ?>/" title="<?php _e('Home','gravy'); ?>"><?php bloginfo('name'); ?></a>
      </div><!--/logo-->
    </div><!--/branding-->
    
    <div class="kingsref">
      <div class="smallsocialicons">
        <ul>
        <li><a target="_blank" href="http://www.facebook.com/powerbalancepavilion" class="fblink">Facebook</a></li>
        <li><a target="_blank" href="http://www.twitter.com/pbpav" class="twitterlink">Twitter</a></li>
        <li><a target="_blank" href="http://www.flickr.com/photos/backstagepass/" class="flickrlink">Flickr</a></li>
        <li><a target="_blank" href="http://www.youtube.com/pbpflix" class="youtubelink">YouTube</a></li>
        </ul>
      </div>
      <div class="kingscomlink"><a href="http://www.kings.com">Kings.com</a></div>
      <div class="topfacebook"><iframe src="http://www.facebook.com/plugins/like.php?app_id=221271514579314&amp;href=http%3A%2F%2Fwww.facebook.com%2Fpowerbalancepavilion&amp;send=false&amp;layout=button_count&amp;width=100&amp;show_faces=false&amp;action=like&amp;colorscheme=light&amp;font&amp;height=21" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:100px; height:21px;" allowTransparency="true"></iframe></div>
      <div class="topgoogle"><!-- Place this tag in your head or just before your close body tag -->
<script type="text/javascript" src="https://apis.google.com/js/plusone.js"></script>
<!-- Place this tag where you want the +1 button to render -->
<g:plusone size="medium"></g:plusone></div>
      <div class="toptwitter"><a href="http://twitter.com/pbpav" class="twitter-follow-button" data-button="grey" data-text-color="#FFFFFF" data-link-color="#00AEFF">Follow @pbpav</a><script src="http://platform.twitter.com/widgets.js" type="text/javascript"></script></div>
    </div><!--/kingsref-->
      
    <div class="topnavcont">
      <?php wp_nav_menu( array( 'container_class' => 'top-nav', 'theme_location' => 'primary' ) ); ?>
    </div>
  </div><!--/greybg-->
   
  <div id="eventheadslider" class="jcarousel-skin-tango">
    <ul id="mycarousel" class="jcarousel-skin-tango">
      <?php
      //query_posts("post_type=event&showposts=12&sitelocation=featured");

        $comparedate = strtotime('-8 hours');

        $topfeaturedargs = array(
        'post_type' => 'event',
        'showposts' => '12',
        'meta_key' => 'removedate',
        'meta_compare' => '>=',
        'meta_value' => $comparedate,
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
      //$eventtime = get_post_meta($post->ID, 'datetime'); 
      $shorttitle = get_post_meta($post->ID, 'shorttitle'); 
    	?>
      <li>

    		<div class="mosaic-block bar">
    			<a href="<?php the_permalink(); ?>" class="mosaic-overlay">
    				<div class="details">
    					<h4><?php echo $shorttitle[0] ?></h4>
    				</div>
    			</a>
    			<a href="<?php the_permalink(); ?>" class="mosaic-backdrop"> <img src="<?php bloginfo('template_url'); ?>/scripts/timthumb.php?src=<?php echo $image[0] ?>&amp;h=94&amp;w=224px&amp;zc=1" alt="" /></a>
    		</div>   
      </li>
    <?php } ?>    
    </ul>  
     
    <?php wp_reset_query(); ?>  
  </div>  

</div><!--/masthead-->
<div class="clear"></div>
<div id="main">

