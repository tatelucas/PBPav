<?php $hookName = TMFGAdminPages::$hookName['about']; ?>
<script type="text/javascript">
	//<![CDATA[
	jQuery(document).ready( function($) {
		// close postboxes that should be closed
		$('.if-js-closed').removeClass('if-js-closed').addClass('closed');
		// postboxes setup
		postboxes.add_postbox_toggles('<?php echo $hookName; ?>');
	});
	//]]>
</script>

<?php
wp_nonce_field( 'closedpostboxes', 'closedpostboxesnonce', false );
wp_nonce_field( 'meta-box-order', 'meta-box-order-nonce', false );
?>

<div class="wrap">
	<?php screen_icon(); ?>
	<h2>TMF Gallery - <?php _e('About', TMFG::i18nDomain) ?></h2>
	
	<div id="tmfg-messagebox"></div>
	
	<?php global $screen_layout_columns; ?>
	
	<div id="poststuff" class="metabox-holder<?php echo ($screen_layout_columns == 2)? ' has-right-sidebar' : ''; ?>">
		<div id="side-info-column" class="inner-sidebar">
			<?php do_meta_boxes($hookName, 'side', array()); ?>
		</div>
		<div id="post-body">
			<div id="post-body-content">
				<?php do_meta_boxes($hookName, 'normal', array()); ?>
			</div>
		</div>
		<br class="clear" />
	</div>
	
</div>