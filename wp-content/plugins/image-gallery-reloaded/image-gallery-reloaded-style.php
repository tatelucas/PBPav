<?php
require_once( dirname(__FILE__) . '/image-gallery-reloaded.php');
  $g_main_height=get_option('g_main_height');
  $g_main_width=get_option('g_main_width');
  $g_thumb_height=get_option('g_thumb_height');
  $g_thumb_width=get_option('g_thumb_width');
  $g_slide=get_option('g_slide');
  $g_border_color=get_option('g_border_color');
  $g_background_color=get_option('g_background_color');
  $g_caption_color=get_option('g_caption_color');
  $g_fwd_back_position=get_option('g_fwd_back_position');
  $g_fwd_back_add=get_option('g_fwd_back');
  $g_fwd_back_ini = '<div class="clear" style="clear: both;"></div><p class="gallery-nav"><a class="back" href="#" onclick="$.gallery_reloaded.prev(); return false;">&laquo; Back</a>    <a class="forward" href="#" onclick="$.gallery_reloaded.next(); return false;">Forward &raquo;</a></p>';
?>
<style type="text/css" media="screen" rel="stylesheet">
body {opacity .999;}
.gbackgr {border: 5px solid #<?php echo $g_border_color; ?>;width:<?php echo $g_main_width; ?>px;background:#<?php echo $g_background_color; ?>;text-align:center;}
.caption{color:#<?php echo $g_caption_color; ?>;display:block;font-style:italic;padding:0 8px 8px 0;float:left;}
.gallery_reloaded {width:<?php echo $g_main_width; ?>px;margin:auto;}
.gallery_reloaded li div .caption{font:italic 0.9em/1.4 georgia,serif;}
.main_image {width:<?php echo $g_main_width; ?>px;height:auto;/*In testing - max-height:<?php echo $g_main_height; ?>px;*/overflow:hidden;}
.main_image img{ margin-bottom:10px;max-width:<?php echo $g_main_width; ?>px;height:auto;width:auto;max-height:<?php echo $g_main_height; ?>px;}
.gholder{position: relative;width: <?php echo $g_main_width; ?>px;overflow: auto;/* For plugin to work on RTL sites */direction:ltr;padding: 0 0 5px 0;}
.gallery_reloaded {width: 10000px;margin: 0 !important;padding: 0 !important;list-style: none;}
.gallery_reloaded li {display:block;float:left;height:<?php echo $g_thumb_height; ?>px;margin:0 8px 0 0;overflow:hidden;width:<?php echo $g_thumb_width; ?>px;background:none;list-style:none;}
.gallery_reloaded li a {display:none}
.gallery_reloaded li div {position:absolute;display:none;top:0;left:180px}
.gallery_reloaded li div img {cursor:pointer;height:100%;}
.gallery_reloaded li.active div img, .gallery_reloaded li.active div {display:block}
.gallery_reloaded li img.thumb {cursor:pointer;top:auto;left:auto;display:block;width:auto;height:auto}
.gallery_reloaded li .caption {display:block;padding-top:.5em}
* html .gallery_reloaded li div span {width:<?php echo $g_main_width; ?>px;} /* MSIE bug */
p.gallery-nav{max-width:<?php echo $g_main_width; ?>px;height:30px;margin:0;padding:10px 5px 0;}
p.gallery-nav a.back{background:url('<?php echo bloginfo( 'url' ) . '/wp-content/plugins/image-gallery-reloaded/images/back.png'; ?>') no-repeat; display:block;width:24px;height:24px;text-indent:-9999px;text-decoration:none;float:left;}
p.gallery-nav a.forward{background:url('<?php echo bloginfo( 'url' ) . '/wp-content/plugins/image-gallery-reloaded/images/forward.png'; ?>') no-repeat; display:block;width:24px;height:24px;text-indent:-9999px;text-decoration:none;float:right;}
.gallery_reloaded_container a{color: #666666; text-indent:-9999px; background:url('<?php echo bloginfo( 'url' ) . '/wp-content/plugins/image-gallery-reloaded/images/larger.png'; ?>') no-repeat;height:12px;width:12px;display:block;float:left;text-decoration:none;}
#gr_tooltip{position:absolute;border:1px solid #<?php echo $g_caption_color; ?>;background:#<?php echo $g_background_color; ?>;-moz-border-radius:5px;padding:4px 5px;color:#<?php echo $g_caption_color; ?>;display:none;}
.loading{-moz-border-radius:4px;background:#<?php echo $g_background_color; ?>;border:1px solid #<?php echo $g_caption_color; ?>;color:#<?php echo $g_caption_color; ?>;padding:10px;text-align:center;width:100px;}
#TB_window a:link {color: #666666; text-indent:-9999px; background:url('<?php echo bloginfo( 'url' ) . '/wp-content/plugins/image-gallery-reloaded/images/close.png'; ?>') no-repeat;height:24px;width:24px;display:block;}
.TB_overlayBG {background-color:#000;filter:alpha(opacity=75);-moz-opacity: 0.75;opacity: 0.75;}
* html #TB_overlay { /* ie6 hack */position: absolute;height: expression(document.body.scrollHeight > document.body.offsetHeight ? document.body.scrollHeight : document.body.offsetHeight + 'px');}
#TB_window {position: fixed;z-index: 102;color:#000000;display:none;top:50%;left:50%;}
* html #TB_window { /* ie6 hack */position: absolute;margin-top: expression(0 - parseInt(this.offsetHeight / 2) + (TBWindowMargin = document.documentElement && document.documentElement.scrollTop || document.body.scrollTop) + 'px');}
#TB_window img#TB_Image {border: 4px solid #<?php echo $g_border_color; ?>;}
#TB_caption{height:25px;padding:7px 10px 10px 12px;float:left;color:#<?php echo $g_caption_color; ?>;}
#TB_closeWindow{float:right;height:25px;padding:4px 9px 10px 0;color:#<?php echo $g_caption_color; ?>;}
</style>