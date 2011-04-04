jQuery(document).ready( function($) {
	$('#tmfg-gallery-tree').html(tmfgLoaderGraphic());
	tmfg_gallery_get_tree();
});

function tmfg_gallery_get_tree(){
	jQuery.ajax({ 
		type: 'POST', 
		url: ajaxurl, 
		data: 'action=tmfg_get_gallery_tree&only-view=x', 
		success: function(data){
			jQuery('#tmfg-gallery-tree').html('<ul>'+data+'</ul>');
		}, 
		error: function(XMLHttpRequest, textStatus, errorThrown){ 
			jQuery('#tmfg-gallery-tree').html(XMLHttpRequest.status+': '+errorThrown);
		} 
	}); 
}