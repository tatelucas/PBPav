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

<!-- Dropdown menu content is here -->
<div class="hiddendropdownmenu" id="hiddendropdownmenu-26">
Lorem<br />
Lorem<br />
<p>Testing</p>
</div>


<script type="text/javascript"> 
    jQuery(document).ready(function(){ 
        jQuery("ul.menu").superfish(); 
        jQuery('#mycarousel').jcarousel();
        jQuery("#tabs").tabs();
    }); 
</script>

</body>
</html>