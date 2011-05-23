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

jQuery('.searchweb').click(function() {
  var newsearchstring;
  newsearchstring = jQuery('#searchfield').val();
  jQuery('#googleq').val(function(index, value) {
    return newsearchstring;
  });
  jQuery('#googleform').submit();
});

jQuery('#eventcat').change(function () {
  jQuery('#searchcat').submit();
  //alert('asdasd');
});