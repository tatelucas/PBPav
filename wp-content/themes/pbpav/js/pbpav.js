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

/*
jQuery(document).ready(function(){ 

  jQuery('#menu-item-26').hover(function(){
    jQuery('.dropdown-26').css('display','block');
  })  
});
*/

var timeout    = 500;
var closetimer = 0;
var ddmenuitem = 0;

function jsddm_open()
{  jsddm_canceltimer();
   jsddm_close();
   ddmenuitem = jQuery(this).find('div').css('visibility', 'visible');
}

function jsddm_close()
{  if(ddmenuitem) ddmenuitem.css('visibility', 'hidden');}

function jsddm_timer()
{  closetimer = window.setTimeout(jsddm_close, timeout);}

function jsddm_canceltimer()
{  if(closetimer)
   {  window.clearTimeout(closetimer);
      closetimer = null;}}

jQuery(document).ready(function(){ 

  jQuery('#menu-item-26').append('<div class="dropdown-26 dropdownmenu"></div>');
  jQuery('.dropdown-26').html(function(){
    var newcontent;
    newcontent = jQuery('#hiddendropdownmenu-26').html();
    return newcontent;
  });

  jQuery('.top-nav li').bind('mouseover', jsddm_open)
  jQuery('.top-nav li').bind('mouseout',  jsddm_timer)
});