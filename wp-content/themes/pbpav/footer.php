</div>

<div id="footer-widgets"><?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Footer Widgets') ) : ?><?php endif; ?></div>
</div>

<!--/main-->



</div>
<!--/wrapper-->




<div id="footer">

<div class="footerlogo">
  <img src="<?php bloginfo('template_url'); ?>/images/footerlogo.png" alt="Powerbalance Pavilion" />
</div>

  <div class="right"> &#169; <?php echo date('Y'); ?> <span class="url fn org">
    <?php bloginfo('name'); ?>
    </span> &bull;
    <?php _e('Powered by','gravy'); ?>
    <a href="http://wordpress.org/" target="_blank">WordPress</a>
    <?php wp_footer(); ?>
  </div>
  <!--/right-->

</div>
<!--/footer-->

<script type="text/javascript"> 
    jQuery(document).ready(function(){ 
        jQuery("ul.menu").superfish(); 
        jQuery('#mycarousel').jcarousel();
        jQuery("#tabs").tabs();
    }); 
</script>

<script type="text/javascript">
                jQuery("li.cat-item a").each(function(){ // Remove Titles from wp_list_categories
                    jQuery(this).removeAttr('title');
                })                
                jQuery("li.page_item a").each(function(){ // Remove Titles from wp_list_pages
                    jQuery(this).removeAttr('title');
                })
                jQuery('.kings-nav li').first().css('background', 'none');                
                jQuery('.kings-nav li').first().css('padding', '2px');
                jQuery('.top-nav li').last().css('background', 'none'); 
                jQuery('.top-nav li').first().css('padding', '0px');
                jQuery('#eventheadslider li').last().css('margin-right:', '0px');                   
                            
                
        </script>
        
</body>
</html>