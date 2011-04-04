function tmfgLoaderGraphic(){
	$content = '<div style="text-align: center;">';
	$content += '<img src="'+tmfg_core.urlpath+'/css/images/ui-anim_basic_16x16.gif" /><br/>';
	$content += '<label class="description">'+tmfg_core.loading+'</label>';
	$content += '</div>';
	
	return $content;
}