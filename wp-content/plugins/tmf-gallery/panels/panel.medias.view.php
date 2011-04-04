<?php 
	$wpdb = TMFGDB::getInstance();
	
	$viewGallery = false;
	$viewList = false;
	
	if(get_option(TMFG::optionPrefix.'manageView', TMFGHelper::getDefaultManageView()) == 'gallery'){
		$manageViewDetails = get_option(TMFG::optionPrefix.'manageViewGallery', TMFGHelper::getDefaultManageViewList());
		$viewGallery = true;
	}else{
		$manageViewDetails = get_option(TMFG::optionPrefix.'manageViewList', TMFGHelper::getDefaultManageViewList());
		$viewList = true;
	}
	
	$gallery = ($_REQUEST['gallery'] != null && $_REQUEST['gallery'] != '')? intval($_REQUEST['gallery']): 0;
	$order = ($_REQUEST['order'] != null && $_REQUEST['order'] != '')? $_REQUEST['order']: 'name';
	$viewLimit = intval($manageViewDetails['items']);
	$offset = ($_REQUEST['offset'] != null && $_REQUEST['offset'] != '')? intval($_REQUEST['offset']): 0;
	
	$fileCount = $wpdb->getFileCount($gallery);
	$aFiles = $wpdb->getFiles($gallery, ($offset*$viewLimit), $viewLimit, $order);
?>

<div class="tablenav">
	<div class="alignleft actions">
		<input type="submit" id="tmfg-query-submit" value="Filter" class="button-secondary" />
	</div>
<?php tmfgMediasPaging($offset, $viewLimit, $fileCount); ?>
</div>

<?php if($viewList){ ?>
<!-- List view -->
<table class="tmfg-medias-view-list" cellspacing="0" cellpadding="0">
	<thead>
		<tr>
			<th class="image-id" scope="col">ID</th>
			<th class="image-thumbnail" scope="col">Thumbnail</th>
			<th scope="col">Name</th>
			<th scope="col">Description</th>
			<th class="image-galleries" scope="col">Galleries</th>
		</tr>
	</thead>
	<tbody>
<?php foreach($aFiles as $file){ ?>
<?php 
	$fileHandler = TMFGHelper::getFileHandler($file['type'], $file['id']);
?>
		<tr>
			<td class="image-id" scope="row">1</td>
			<td class="image-thumbnail"><img src="<?php echo $fileHandler->getThumbnailUrl(); ?>" /></td>
			<td class="image-name"><a href="?page=tmfgallery_medias&action=edit&id=<?php echo $fileHandler->getID(); ?>" title="<?php echo $fileHandler->getTitel(); ?>"><?php echo $fileHandler->getTitel(); ?></a></td>
			<td class="image-description"><div>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</div></td>
			<td class="image-galleries">5</td>
		</tr>
<?php } ?>
	</tbody>
	<tfoot>
		<tr>
			<th class="image-id" scope="col">ID</th>
			<th class="image-thumbnail" scope="col">Thumbnail</th>
			<th scope="col">Name</th>
			<th scope="col">Description</th>
			<th class="image-galleries" scope="col">Galleries</th>
		</tr>
	</tfoot>
</table>
<?php } ?>

<?php if($viewGallery){ ?>
<?php 
?>
<!-- Gallery view -->
<div id="tmfg-medias-view-gallery">
<?php foreach($aFiles as $file){ ?>
<?php 
	$fileHandler = TMFGHelper::getFileHandler($file['type'], $file['id']);
?>
<div class="image">
	<div class="image-title"><strong><a href="?page=tmfgallery_medias&action=edit&id=<?php echo $fileHandler->getID(); ?>" title="<?php echo $fileHandler->getTitel(); ?>"><?php echo $fileHandler->getTitel(); ?></a></strong></div>
	<div class="image-content">
		<img src="<?php echo $fileHandler->getThumbnailUrl(); ?>" />
	</div>
</div>
<?php } ?>
<div class="clear"></div>
</div>
<?php } ?>
<div class="tablenav">
<?php tmfgMediasPaging($offset, $viewLimit, $fileCount); ?>
</div>

<?php 
function tmfgMediasPaging($offset, $viewLimit, $fileCount){
	$pageCount = ceil($fileCount/$viewLimit);
	$pageNumber = (($offset*$viewLimit)+$viewLimit)/$viewLimit;
	if($fileCount > 0){
?>
	<div class="tablenav-pages">
		<span class="displaying-num"><?php printf(__('Displaying %s-%s of %s', TMFG::i18nDomain), ($offset*$viewLimit)+1, ((($offset*$viewLimit)+$viewLimit) < $fileCount)? (($offset*$viewLimit)+$viewLimit) : $fileCount, $fileCount); ?></span>
		<?php if($pageNumber > 1){ ?>
		<a class="next page-numbers" href="?page=tmfgallery_medias&offset=<?php echo ($pageNumber-2); ?>">&laquo;</a>
		<?php } ?>
		
		<?php if($pageNumber == 1){ ?>
		<span class="page-numbers current"><?php echo $pageNumber; ?></span> 
		<?php }else{ ?>
		<a class="page-numbers" href="?page=tmfgallery_medias&offset=<?php echo $pageNumber-2; ?>"><?php echo $pageNumber-1; ?></a> 
		<?php } ?> 
		
		<?php if($pageNumber > 1 && $pageNumber < $pageCount){ ?>
		<span class="page-numbers current"><?php echo $pageNumber; ?></span>
		<?php } ?>
		
		<?php if($pageNumber == $pageCount){ ?>
		<span class="page-numbers current"><?php echo $pageNumber; ?></span> 
		<?php }else{ ?>
		<a class="page-numbers" href="?page=tmfgallery_medias&offset=<?php echo $pageNumber; ?>"><?php echo $pageNumber+1; ?></a> 
		<?php } ?> 
		
		<?php if($pageNumber < $pageCount){ ?>
		<a class="next page-numbers" href="?page=tmfgallery_medias&offset=<?php echo $pageNumber; ?>">&raquo;</a>
		<?php } ?>
	</div>
	<div class="clear"></div>
<?php 
	}
}
?>