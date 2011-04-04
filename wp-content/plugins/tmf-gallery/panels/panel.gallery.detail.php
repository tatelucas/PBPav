<div id="tmfg-gallery-detail" style="display:none;">
	<input type="hidden" name="action" value="" />
	<input type="hidden" name="id" value="" />
	<input type="hidden" name="parent" value="" />
	<table width="100%" cellspacing="2" cellpadding="5" class="form-table">
		<tbody>
			<tr>
				<th scope="row"><?php _e('Name', TMFG::i18nDomain); ?></th>
				<td>
					<input name="name" type="text" size="30" style="width: 100%;" value="" />
				</td>
			</tr>
			<tr>
				<th scope="row">
					<?php _e('Description', TMFG::i18nDomain); ?>
					<span class="description">(<?php _e('optional', TMFG::i18nDomain); ?>)</span>
				</th>
				<td>
					<textarea name="tmfg-content" style="width: 100%;"></textarea>
				</td>
			</tr>
			<tr>
				<th scope="row"><?php _e('Parent', TMFG::i18nDomain); ?></th>
				<td>
					<span id="tmfg-gallery-parent-name"></span>
					<span id="tmfg-gallery-parent-id" class="description"></span>
				</td>
			</tr>
		</tbody>
	</table>
	<div id="major-publishing-actions">
		<div id="publishing-action">
			<input type="button" name="tmfg-create" id="tmfg-gallery-button-create" value="<?php _e('Create Gallery', TMFG::i18nDomain); ?>" class="button-primary" style="display: none;" />
			<input type="button" name="tmfg-save" id="tmfg-gallery-button-save" value="<?php _e('Save Gallery', TMFG::i18nDomain); ?>" class="button-primary" style="display: none;" />
			<input type="button" name="tmfg-delete" id="tmfg-gallery-button-delete" value="<?php _e('Delete Gallery', TMFG::i18nDomain); ?>" class="button-primary" style="display: none;" />
		</div>
		<div class="clear"></div>
	</div>
</div>