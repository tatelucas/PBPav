jQuery(document).ready( function($) {
	$('#tmfg-image-format-add-button').click(function(){
		newShort = $('#tmfg-image-format-add-short').val();
		
		if(newShort == ''){
			alert('Please enter first the short name!');
		}else{
			$('#tmfg-image-format-add').before(getCopy(newShort, newShort));
			$('#tmfg-image-format-add-short').val('');
		}
		return false;
	});
});

function getCopy(name, key){
	return '<table width="100%" cellspacing="2" cellpadding="5" class="form-table table-seperator">' +
		'<tbody>' +
		'	<tr>' +
		'		<th scope="row"><input type="text" name="'+tmfgSettingsL10n.optionPrefix+'image_formats['+key+'][name]" value="'+name+'" /> <span class="description">('+key+')</span></th>' +
		'		<td></td>' +
		'	</tr>' +
		'	<tr>' +
		'		<th scope="row">' +
		'			<input type="radio" id="imageFormatCrop-'+key+'" name="'+tmfgSettingsL10n.optionPrefix+'image_formats['+key+'][action]" value="crop" checked="checked" />' +
		'			<label for="imageFormatCrop-'+key+'">'+tmfgSettingsL10n.cropImage+'</label>' +
		'		</th>' +
		'		<td>' +
		'			<strong>X:</strong><input type="text" size="4" dir="rtl" name="'+tmfgSettingsL10n.optionPrefix+'image_formats['+key+'][crop][X]" value="100" />px' + 
		'			<strong>Y:</strong><input type="text" size="4" dir="rtl" name="'+tmfgSettingsL10n.optionPrefix+'image_formats['+key+'][crop][Y]" value="100" />px' +
		'		</td>' +
		'	</tr>' +
		'	<tr>' +
		'		<th scope="row">' +
		'			<input type="radio" id="imageFormatScale-'+key+'" name="'+tmfgSettingsL10n.optionPrefix+'image_formats['+key+'][action]" value="scale" />' +
		'			<label for="imageFormatScale-'+key+'">'+tmfgSettingsL10n.scaleImage+'</label>' +
		'		</th>' +
		'		<td>' +
		'			<strong>X:</strong><input type="text" size="4" dir="rtl" name="'+tmfgSettingsL10n.optionPrefix+'image_formats['+key+'][scale][X]" value="100" />px' + 
		'			<strong>Y:</strong><input type="text" size="4" dir="rtl" name="'+tmfgSettingsL10n.optionPrefix+'image_formats['+key+'][scale][Y]" value="100" />px' +
		'		</td>' +
		'	</tr>' +
		'	<tr>' +
		'		<th scope="row">' +
		'			<input type="radio" id="imageFormatScaleX-'+key+'" name="'+tmfgSettingsL10n.optionPrefix+'image_formats['+key+'][action]" value="scaleX" />' +
		'			<label for="imageFormatScaleX-'+key+'">'+tmfgSettingsL10n.scaleXImage+'</label>' +
		'		</th>' +
		'		<td>' +
		'			<strong>X:</strong><input type="text" size="4" dir="rtl" name="'+tmfgSettingsL10n.optionPrefix+'image_formats['+key+'][scaleX]" value="100" />px' + 
		'		</td>' +
		'	</tr>' +
		'	<tr>' +
		'		<th scope="row">' +
		'			<input type="radio" id="imageFormatScaleY-'+key+'" name="'+tmfgSettingsL10n.optionPrefix+'image_formats['+key+'][action]" value="scaleY" />' +
		'			<label for="imageFormatScaleY-'+key+'">'+tmfgSettingsL10n.scaleYImage+'</label>' +
		'		</th>' +
		'		<td>' +
		'			<strong>Y:</strong><input type="text" size="4" dir="rtl" name="'+tmfgSettingsL10n.optionPrefix+'image_formats['+key+'][scaleY]" value="100" />px' +
		'		</td>' +
		'	</tr>' +
		'	<tr>' +
		'		<th scope="row">' +
		'			<input type="radio" id="imageFormatNone-'+key+'" name="'+tmfgSettingsL10n.optionPrefix+'image_formats['+key+'][action]" value="no" />' +
		'			<label for="imageFormatNone-'+key+'">'+tmfgSettingsL10n.no+'</label>' +
		'		</th>' +
		'		<td>' +
		'			no' +
		'		</td>' +
		'	</tr>' +
		'</tbody>' +
		'</table>';
}