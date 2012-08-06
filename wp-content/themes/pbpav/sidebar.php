<div id="sidebar">

    <div class="sidesearch">
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
      </div><!--/hiddengoogle-->
    </div><!--/sidesearch-->
<div class="clear"></div>
<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Sidebar Widgets') ) : ?><?php endif; ?>
 		

</div><!--/sidebar-->