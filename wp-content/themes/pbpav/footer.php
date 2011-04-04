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
        /*
        jQuery(".slidetitle").html(function() {
          var newtext;
          newtext = jQuery(".gholder .active .currentposttitle").html();
          return newtext;
        });
        */
    });
    
    
     
</script>

</body>
</html>