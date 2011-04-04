<table width="100%" cellspacing="2" cellpadding="5" class="form-table table-seperator">
	<tbody>
		<tr>
			<th><?php _e('Supported File Extensions', TMFG::i18nDomain); ?></th>
			<td>
				<input type="text" size="80" name="<?php echo TMFG::optionPrefix; ?>supportedFileExtensions" value="<?php echo get_option(TMFG::optionPrefix.'supportedFileExtensions', TMFGHelper::getDefaultSupportedFileExtensions()); ?>" />
				<br/><span class="description">Enter your supported file extension in following format <code>*.jpg;*.gif;*.png</code>. When the field is blank, every file would be accepted.</span>
			</td>
		</tr>
		<tr>
			<th><?php _e('File Size Limit', TMFG::i18nDomain); ?></th>
			<td>
				<input type="text" dir="rtl" size="10" name="<?php echo TMFG::optionPrefix; ?>fileSizeLimit" value="<?php echo get_option(TMFG::optionPrefix.'fileSizeLimit', TMFGHelper::getDefaultMaxFileSizeLimit()); ?>" /> kByte
				<br/><span class="description">Max. value is the PHP upload limit (<?php echo TMFGHelper::getMaxFileSizeFromPHPINI(); ?> kByte).</span>
			</td>
		</tr>
	</tbody>
</table>
<table width="100%" cellspacing="2" cellpadding="5" class="form-table table-seperator">
	<tbody>
		<tr>
			<th>
				<input type="radio" id="batchUploadFlash" name="<?php echo TMFG::optionPrefix; ?>batchUpload" value="flash" <?php checked('flash', get_option(TMFG::optionPrefix.'batchUpload', TMFGHelper::getDefaultBatchUpload())); ?> />
				<label for="batchUploadFlash"><?php _e('Flash Batch Upload', TMFG::i18nDomain); ?></label>
			</th>
			<td>
				<?php $batchUploadFlashOptions = get_option(TMFG::optionPrefix.'batchUploadFlashOptions', TMFGHelper::getDefaultBatchUploadFlashOptions()); ?>
				<input type="checkbox" name="<?php echo TMFG::optionPrefix; ?>batchUploadFlashOptions[debug]" value="1" <?php checked('1', $batchUploadFlashOptions['debug']); ?> /> 
				<span class="description"><?php _e('Debug', TMFG::i18nDomain); ?></span>
				<br/><input type="text" dir="rtl" name="?php echo TMFG::optionPrefix; ?>batchUploadFlashOptions[queueLimit]" value="<?php echo ($batchUploadFlashOptions['queueLimit'] == '')? '0':$batchUploadFlashOptions['queueLimit']; ?>" size="4" /> 
				<span class="description"><?php _e('Defines the number of files allowed to be uploaded. The value of 0 (zero) is interpreted as unlimited.', TMFG::i18nDomain); ?></span>
			</td>
		</tr>
		<tr>
			<th>
				<input type="radio" id="batchUploadAjax" name="<?php echo TMFG::optionPrefix; ?>batchUpload" value="ajax" <?php checked('ajax', get_option(TMFG::optionPrefix.'batchUpload', TMFGHelper::getDefaultBatchUpload())); ?> />
				<label for="batchUploadAjax"><?php _e('Ajax Upload', TMFG::i18nDomain); ?></label>
			</th>
			<td>
				<span class="description"><?php _e('Is not implemented at the moment.', TMFG::i18nDomain); ?></span>
			</td>
		</tr>
	</tbody>
</table>
<table width="100%" cellspacing="2" cellpadding="5" class="form-table">
	<tbody>
		<tr>
			<th>
				<input type="radio" name="<?php echo TMFG::optionPrefix; ?>manageView" id="manageViewList" value="list" <?php checked('list', get_option(TMFG::optionPrefix.'manageView', TMFGHelper::getDefaultManageView())); ?> /><label for="manageViewList">List view</label>
			</th>
			<td>
				<?php $manageViewList = get_option(TMFG::optionPrefix.'manageViewList', TMFGHelper::getDefaultManageViewList()); ?>
				<input type="text" dir="rtl" name="<?php echo TMFG::optionPrefix; ?>manageViewList[items]" size="4" value="<?php echo $manageViewList['items']; ?>" /> <span class="description"><?php _e('Select the number of items you would display on one page', TMFG::i18nDomain); ?></span>
			</td>
		</tr>
		<tr>
			<th>
				<input type="radio" name="<?php echo TMFG::optionPrefix; ?>manageView" id="manageViewGallery" value="gallery" <?php checked('gallery', get_option(TMFG::optionPrefix.'manageView', TMFGHelper::getDefaultManageView())); ?> /><label for="manageViewGallery">Gallery view</label>		
			</th>
			<td>
				<?php $manageViewGallery = get_option(TMFG::optionPrefix.'manageViewGallery', TMFGHelper::getDefaultManageViewGallery()); ?>
				<input type="text" dir="rtl" name="<?php echo TMFG::optionPrefix; ?>manageViewGallery[items]" size="4" value="<?php echo $manageViewGallery['items']; ?>" /> <span class="description"><?php _e('Select the number of items you would display on one page', TMFG::i18nDomain); ?></span>
			</td>
		</tr>
		<tr>
			<th><?php _e('Display sub photos', TMFG::i18nDomain); ?></th>
			<td>
				<input type="checkbox" name="<?php echo TMFG::optionPrefix; ?>disp_subphotos" value="1" <?php checked('1', get_option(TMFG::optionPrefix.'disp_subphotos')); ?> />
				<span class="description"><?php _e('Display also the photos of the sub galleries (recursively). Duplicate photos are filtered out.', TMFG::i18nDomain); ?></span>
			</td>
		</tr>
	</tbody>
</table>