<div id="image-formats-list-options">
<?php 
	$arrayImageFormat = get_option(TMFG::optionPrefix.'image_formats', TMFGHelper::getDefaultImageFormats());
	if(is_array($arrayImageFormat)){
		foreach($arrayImageFormat as $imageFormatKey => $imageFormatValue){
?>
<?php if($imageFormatKey == 'original' || $imageFormatKey == 'system-thumbnail'){ ?>
	<input type="hidden" name="<?php echo TMFG::optionPrefix; ?>image_formats[<?php echo $imageFormatKey; ?>][name]" value="<?php echo $imageFormatValue['name']; ?>" />
	<input type="hidden" name="<?php echo TMFG::optionPrefix; ?>image_formats[<?php echo $imageFormatKey; ?>][action]" value="<?php echo $imageFormatValue['action']; ?>" />
	<input type="hidden" name="<?php echo TMFG::optionPrefix; ?>image_formats[<?php echo $imageFormatKey; ?>][scale][X]" value="<?php echo $imageFormatValue['scale']['X']; ?>" />
	<input type="hidden" name="<?php echo TMFG::optionPrefix; ?>image_formats[<?php echo $imageFormatKey; ?>][scale][Y]" value="<?php echo $imageFormatValue['scale']['Y']; ?>" />
	<table width="100%" cellspacing="2" cellpadding="5" class="form-table table-seperator">
		<tbody>
			<tr>
				<th scope="row"><strong><?php echo $imageFormatValue['name']; ?></strong> <span class="description">(<?php echo $imageFormatKey; ?>)</span></th>
				<td></td>
			</tr>
		</tbody>
	</table>
<?php }else{ ?>
	<table width="100%" cellspacing="2" cellpadding="5" class="form-table table-seperator">
		<tbody>
			<tr>
				<th scope="row"><input type="text" name="<?php echo TMFG::optionPrefix; ?>image_formats[<?php echo $imageFormatKey; ?>][name]" value="<?php echo $imageFormatValue['name']; ?>" /> <span class="description">(<?php echo $imageFormatKey; ?>)</span></th>
				<td></td>
			</tr>
			<tr>
				<th scope="row">
					<input type="radio" id="imageFormatCrop-<?php echo $imageFormatKey; ?>" name="<?php echo TMFG::optionPrefix; ?>image_formats[<?php echo $imageFormatKey; ?>][action]" value="crop" <?php checked('crop', $imageFormatValue['action']); ?> />
					<label for="imageFormatCrop-<?php echo $imageFormatKey; ?>"><?php _e('Crop Image', TMFG::i18nDomain); ?></label>
				</th>
				<td>
					<strong>X:</strong><input type="text" size="4" dir="rtl" name="<?php echo TMFG::optionPrefix; ?>image_formats[<?php echo $imageFormatKey; ?>][crop][X]" value="<?php echo $imageFormatValue['crop']['X']; ?>" />px 
					<strong>Y:</strong><input type="text" size="4" dir="rtl" name="<?php echo TMFG::optionPrefix; ?>image_formats[<?php echo $imageFormatKey; ?>][crop][Y]" value="<?php echo $imageFormatValue['crop']['Y']; ?>" />px
				</td>
			</tr>
			<tr>
				<th scope="row">
					<input type="radio" id="imageFormatScale-<?php echo $imageFormatKey; ?>" name="<?php echo TMFG::optionPrefix; ?>image_formats[<?php echo $imageFormatKey; ?>][action]" value="scale" <?php checked('scale', $imageFormatValue['action']); ?> />
					<label for="imageFormatScale-<?php echo $imageFormatKey; ?>"><?php _e('Scale Image', TMFG::i18nDomain); ?></label>
				</th>
				<td>
					<strong>X:</strong><input type="text" size="4" dir="rtl" name="<?php echo TMFG::optionPrefix; ?>image_formats[<?php echo $imageFormatKey; ?>][scale][X]" value="<?php echo $imageFormatValue['scale']['X']; ?>" />px 
					<strong>Y:</strong><input type="text" size="4" dir="rtl" name="<?php echo TMFG::optionPrefix; ?>image_formats[<?php echo $imageFormatKey; ?>][scale][Y]" value="<?php echo $imageFormatValue['scale']['Y']; ?>" />px
				</td>
			</tr>
			<tr>
				<th scope="row">
					<input type="radio" id="imageFormatScaleX-<?php echo $imageFormatKey; ?>" name="<?php echo TMFG::optionPrefix; ?>image_formats[<?php echo $imageFormatKey; ?>][action]" value="scaleX" <?php checked('scaleX', $imageFormatValue['action']); ?> />
					<label for="imageFormatScaleX-<?php echo $imageFormatKey; ?>"><?php _e('Scale Image X', TMFG::i18nDomain); ?></label>
				</th>
				<td>
					<strong>X:</strong><input type="text" size="4" dir="rtl" name="<?php echo TMFG::optionPrefix; ?>image_formats[<?php echo $imageFormatKey; ?>][scaleX]" value="<?php echo $imageFormatValue['scaleX']; ?>" />px
				</td>
			</tr>
			<tr>
				<th scope="row">
					<input type="radio" id="imageFormatScaleY-<?php echo $imageFormatKey; ?>" name="<?php echo TMFG::optionPrefix; ?>image_formats[<?php echo $imageFormatKey; ?>][action]" value="scaleY" <?php checked('scaleY', $imageFormatValue['action']); ?> />
					<label for="imageFormatScaleY-<?php echo $imageFormatKey; ?>"><?php _e('Scale Image Y', TMFG::i18nDomain); ?></label>
				</th>
				<td>
					<strong>Y:</strong><input type="text" size="4" dir="rtl" name="<?php echo TMFG::optionPrefix; ?>image_formats[<?php echo $imageFormatKey; ?>][scaleY]" value="<?php echo $imageFormatValue['scaleY']; ?>" />px
				</td>
			</tr>
			<tr>
				<th scope="row">
					<input type="radio" id="imageFormatNone-<?php echo $imageFormatKey; ?>" name="<?php echo TMFG::optionPrefix; ?>image_formats[<?php echo $imageFormatKey; ?>][action]" value="no" <?php checked('no', $imageFormatValue['action']); ?> />
					<label for="imageFormatNone-<?php echo $imageFormatKey; ?>"><?php _e('No', TMFG::i18nDomain); ?></label>
				</th>
				<td>
					no
				</td>
			</tr>
		</tbody>
	</table>
<?php } ?>
<?php
		}
	}
?>
	<div id="tmfg-image-format-add" style="text-align: right;">
		<br/>
		<input type="text" id="tmfg-image-format-add-short" value="" /> 
		<a id="tmfg-image-format-add-button" href="#" class="button"><?php _e('Add Image Format', TMFG::i18nDomain); ?></a>
	</div>
</div>