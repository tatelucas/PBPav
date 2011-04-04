jQuery(document).ready( function($) {
	$('input#tmfg-gallery-button-create').executeClickAction('tmfg_gallery_create');
	$('input#tmfg-gallery-button-save').executeClickAction('tmfg_gallery_edit');
	$('input#tmfg-gallery-button-delete').executeClickAction('tmfg_gallery_delete');
});

(function($){
	$.fn.executeClickAction = function(action){
		$(this).live('click', function(event){
			var messageObject = new Object();
			switch(action){
				case 'tmfg_gallery_create':
					messageObject.confirm = tmfg.confirm_create_gallery;
					messageObject.success = tmfg.success_create_gallery;
					messageObject.urlParameter = '&name='+jQuery('#tmfg-gallery-detail input[name=name]').val()+'&description='+jQuery('#tmfg-gallery-detail textarea[name=tmfg-content]').val()+'&parent='+jQuery('#tmfg-gallery-detail input[name=parent]').val();
					break;
				case 'tmfg_gallery_edit':
					messageObject.confirm = tmfg.confirm_save_gallery;
					messageObject.success = tmfg.success_save_gallery;
					messageObject.urlParameter = '&id='+jQuery('#tmfg-gallery-detail input[name=id]').val()+'&name='+jQuery('#tmfg-gallery-detail input[name=name]').val()+'&description='+jQuery('#tmfg-gallery-detail textarea[name=tmfg-content]').val()+'&parent='+jQuery('#tmfg-gallery-detail input[name=parent]').val();
					break;
				case 'tmfg_gallery_delete':
					messageObject.confirm = tmfg.confirm_delete_gallery;
					messageObject.success = tmfg.success_delete_gallery;
					messageObject.urlParameter = '&id='+jQuery('#tmfg-gallery-detail input[name=id]').val();
					break;
				default:
					jQuery('#tmfg-messagebox').html('<p>'+tmfg.action_not_supported+'</p>').addClass('error').removeClass('updated').show(500);
					return;
			}
			
			if (confirm(messageObject.confirm)){
				jQuery.ajax({ 
					type: 'POST', 
					url: ajaxurl, 
					data: 'action='+action+messageObject.urlParameter, 
					success: function(data, textStatus, XMLHttpRequest){
						jQuery('#tmfg-messagebox').html('<p>'+messageObject.success+'</p>').removeClass('error').addClass('updated').show(500).delay(3000).hide(500);
						tmfg_gallery_get_tree();
					}, 
					error: function(XMLHttpRequest, textStatus, errorThrown){ 
						jQuery('#tmfg-messagebox').html('<p>'+XMLHttpRequest.status+': '+errorThrown+'</p>').removeClass('updated').addClass('error').show(500); 
					} 
				});
			}
		});
	};
})(jQuery);

jQuery(document).ready( function($) {
	/* Gallerien laden */
	$('#tmfg-gallery-tree').html(tmfgLoaderGraphic());
	tmfg_gallery_get_tree();

	$('a.ui-icon-trash').live('click', function(event){
		$galleryID = $(this).attr('id');
		$galleryID = $galleryID.substring(('tmfg-delg-').length);
		tmfgGalleryAction('delete', $galleryID);
	});

	$('a.ui-icon-wrench').live('click', function(event){
		$galleryID = $(this).attr('id');
		$galleryID = $galleryID.substring(('tmfg-editg-').length);
		tmfgGalleryAction('edit', $galleryID);
	});

	$('a.ui-icon-document').live('click', function(event){
		$galleryID = $(this).attr('id');
		$galleryID = $galleryID.substring(('tmfg-newg-').length);
		tmfgGalleryAction('create', $galleryID);
	});
});

function tmfg_gallery_get_tree(){
	jQuery.ajax({ 
		type: 'POST', 
		url: ajaxurl, 
		data: 'action=tmfg_get_gallery_tree', 
		success: function(data){
			jQuery('#tmfg-gallery-tree').html('<ul>'+data+'</ul>');

			jQuery('a.ui-icon-arrow-4').draggable({
				helper: 'clone',
				cursor: 'move'
			});

			jQuery('#tmfg-gallery-tree .gallery div.container').droppable({
				hoverClass: 'ui-state-hover',
				drop: function(event, ui) {
					movIDattr = '#'+ui.draggable.attr('id');
					movID = movIDattr.substring('tmfg-movg-'.length+1);
					movIDattr = '#tmfg-gallery-tree-elem-'+movID;
					tarIDattr = '#'+jQuery(this).attr('id');
					tarID = tarIDattr.substring('tmfg-gallery-tree-container-'.length+1);

					//alert(movID+'_'+tarID);
					//alert(tarIDattr+'_'+movIDattr);
					//alert(jQuery(tarIDattr).parents(movIDattr).length);
					
					if(jQuery(tarIDattr).parents(movIDattr).length == 0 && movID != tarID){
						//Verschieben
						jQuery.ajax({ 
							type: 'POST', 
							url: ajaxurl, 
							data: 'action=tmfg_gallery_move&id='+movID+'&target='+tarID, 
							success: function(data, textStatus, XMLHttpRequest){
								jQuery('#tmfg-messagebox').html('<p>'+tmfg.success_move_gallery+'</p>').removeClass('error').addClass('updated').show(500).delay(3000).hide(500);
								tmfg_gallery_get_tree();
							},
							error: function(XMLHttpRequest, textStatus, errorThrown){ 
								jQuery('#tmfg-messagebox').html('<p>'+XMLHttpRequest.status+': '+errorThrown+'</p>').removeClass('error').removeClass('updated').hide(500);
							} 
						});
					}else if(jQuery(tarIDattr).parents(movIDattr).length > 0){
						jQuery('#tmfg-messagebox').html('<p>'+tmfg.error_move_gallery_child+'</p>').addClass('error').removeClass('updated').show(500);
					}else{}
				}
			});
		}, 
		error: function(XMLHttpRequest, textStatus, errorThrown){ 
			jQuery('#tmfg-gallery-tree').html(XMLHttpRequest.status+': '+errorThrown);
		} 
	}); 
}

function tmfgGalleryAction(action, id){
	if(action == 'delete' || action == 'edit' || action == 'create'){
		jQuery('#tmfg-messagebox').html(tmfgLoaderGraphic()).removeClass('error').addClass('updated').show(500);

		jQuery.ajax({ 
			type: 'POST', 
			url: ajaxurl, 
			data: 'action=tmfg_get_gallery_detail&id='+id, 
			success: function(data){
				var result = JSON.parse(data);

				clearFormFields();
				
				switch(action){
					case 'delete':
						jQuery('#tmfg-gallery-detail input[name=action]').val(action);
						jQuery('#tmfg-gallery-detail input[name=id]').val(result['id']);
						jQuery('#tmfg-gallery-detail input[name=parent]').val(result['parent']);
						
						jQuery('#tmfg-gallery-detail input[name=name]').val(result['name']);
						jQuery('#tmfg-gallery-detail textarea[name=tmfg-content]').val(result['description']);
						
						jQuery('#tmfg-gallery-detail span#tmfg-gallery-parent-name').html(result['parent-name']);
						jQuery('#tmfg-gallery-detail span#tmfg-gallery-parent-id').html('('+result['parent']+')');
						
						jQuery('#tmfg-gallery-detail #tmfg-gallery-button-delete').show();
						jQuery('#tmfg-gallery-detail').show(500);
						break;
					case 'edit':
						jQuery('#tmfg-gallery-detail input[name=action]').val(action);
						jQuery('#tmfg-gallery-detail input[name=id]').val(result['id']);
						jQuery('#tmfg-gallery-detail input[name=parent]').val(result['parent']);
						
						jQuery('#tmfg-gallery-detail input[name=name]').val(result['name']);
						jQuery('#tmfg-gallery-detail textarea[name=tmfg-content]').val(result['description']);
						
						jQuery('#tmfg-gallery-detail span#tmfg-gallery-parent-name').html(result['parent-name']);
						jQuery('#tmfg-gallery-detail span#tmfg-gallery-parent-id').html('('+result['parent']+')');

						jQuery('#tmfg-gallery-detail #tmfg-gallery-button-save').show();
						jQuery('#tmfg-gallery-detail').show(500);
						break;
					case 'create':
						jQuery('#tmfg-gallery-detail input[name=action]').val(action);
						jQuery('#tmfg-gallery-detail input[name=parent]').val(id);

						jQuery('#tmfg-gallery-detail span#tmfg-gallery-parent-name').html(result['name']);
						jQuery('#tmfg-gallery-detail span#tmfg-gallery-parent-id').html('('+id+')');

						jQuery('#tmfg-gallery-detail #tmfg-gallery-button-create').show();
						jQuery('#tmfg-gallery-detail').show(500);
						break;
					default:
						break;
				}
				jQuery('#tmfg-messagebox').hide(500).html('').removeClass('error').removeClass('updated');
			}, 
			error: function(){ 
				jQuery('#tmfg-messagebox').html('<p>ERROR</p>').removeClass('error').removeClass('updated').hide(500);
			} 
		});
	}
}

function clearFormFields(){
	jQuery('#tmfg-gallery-detail input[name=action]').val('');
	jQuery('#tmfg-gallery-detail input[name=id]').val('');
	jQuery('#tmfg-gallery-detail input[name=parent]').val('');

	jQuery('#tmfg-gallery-detail input[name=name]').val('');
	jQuery('#tmfg-gallery-detail textarea[name=tmfg-content]').val('');	

	jQuery('#tmfg-gallery-detail span#tmfg-gallery-parent-name').html('');
	jQuery('#tmfg-gallery-detail span#tmfg-gallery-parent-id').html('()');
	
	jQuery('#tmfg-gallery-detail #publishing-action input[type=button]').hide();
}