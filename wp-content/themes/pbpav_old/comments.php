<?php // Do not delete these lines
	if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME'])) {
		die ( __('Please do not load this page directly. Thanks!','gravy') );
	}
	
	if ( post_password_required() ) {
?>
<?php
		return;
	}

	// Show the comments
	if ( have_comments() ) {
?>

<h3 id="comments">
  <?php comments_number('0', '1', '%' );?>
  <?php _e('Responses','gravy'); ?>
  <a href="#respond" title="<?php _e('Leave a comment','gravy'); ?>">&raquo;</a></h3>
<ol class="commentlist" id="singlecomments">
  <?php wp_list_comments('type=comment&callback=mytheme_comment'); ?>
</ol>
<div id="comment_pagination">
  <div id="older">
    <?php previous_comments_link(__('&laquo;Older Comments','gravy')); ?>
  </div>
  <div id="newer">
    <?php next_comments_link(__('Newer Comments&raquo;','gravy')); ?>
  </div>
</div>
<?php
		} else {
			// this is displayed if there are no comments so far
			if ('open' == $post->comment_status) {
			} else {
				if(!is_page()) {
?>
<p class="nocomments">
  <?php _e('Comments are closed.','gravy'); ?>
</p>
<?php
				}
			}
		}
	
		if ('open' == $post-> comment_status) {
?>
<?php
		// Begin Trackbacks 
		foreach ($comments as $comment) {
			if ($comment->comment_type == "trackback" || $comment->comment_type == "pingback" || ereg("<pingback />", $comment->comment_content) || ereg("<trackback />", $comment->comment_content)) {
				if (!$runonce) { $runonce = true;
?>
<h3 id="trackbacks">
  <?php _e('Trackbacks','gravy'); ?>
</h3>
<ol id="trackbacklist">
  <?php
				}
?>
  <li class="<?php echo $oddcomment; ?>" id="comment-<?php comment_ID() ?>"> <cite>
    <?php comment_author_link() ?>
    </cite> </li>
  <?php
			}
		}
		if ($runonce) {
?>
</ol>
<?php
		}
		// End Trackbacks
?>
<div id="respond">
  <h3>
    <?php _e('Leave a Response','gravy'); ?>
  </h3>
  <p id="cancel-comment-reply">
    <?php cancel_comment_reply_link(__('Cancel Reply','gravy')); ?>
  </p>
  <?php
		if ( get_option('comment_registration') && !$user_ID ) {
			_e('You must be','gravy');
?>
  <a href="<?php echo get_option('siteurl'); ?>/wp-login.php?redirect_to=<?php echo urlencode(get_permalink()); ?>">
  <?php _e('logged in','gravy'); ?>
  </a>
  <?php
			_e('to post a comment.','gravy');
		} else {
?>
  <form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform">
    <?php
			if ( $user_ID ) {
?>
    <p>
      <?php _e('Logged in as','gravy'); ?>
      <a href="<?php echo get_option('siteurl'); ?>/wp-admin/profile.php"><?php echo $user_identity; ?></a> &bull; <a href="<?php echo wp_logout_url($redirect); ?>">
      <?php _e('Log out','gravy'); ?>
      &raquo;</a> </p>
    <?php
			} else {
?>
    <p>
      <input class="field" type="text" name="author" id="author" value="<?php echo $comment_author; ?>" tabindex="1" />
      <label for="author">
      <?php _e('Name','gravy'); ?>
      <?php if ($req) { ?>
      <span class="required">
      <?php _e('(required)','gravy'); ?>
      </span>
      <?php } ?>
      </label>
    </p>
    <p>
      <input type="text" name="email" id="email" value="<?php echo $comment_author_email; ?>" tabindex="2" class="field" />
      <label for="email">
      <?php _e('Mail (will not be published)','gravy'); ?>
      <?php if ($req) { ?>
      <span class="required">
      <?php _e('(required)','gravy'); ?>
      </span>
      <?php } ?>
      </label>
    </p>
    <p>
      <input type="text" name="url" id="url" value="<?php echo $comment_author_url; ?>" tabindex="3" class="field" />
      <label for="url">
      <?php _e('Website','gravy'); ?>
      </label>
    </p>
    <?php
		 	}
			comment_id_fields();
?>
    <input type="hidden" name="redirect_to" value="<?php echo htmlspecialchars($_SERVER["REQUEST_URI"]); ?>" />
    <p>
      <textarea name="comment" class="field" id="comment" cols="10" rows="10" tabindex="4"></textarea>
    </p>
    <?php
			if (get_option("comment_moderation") == "1") {
?>
    <p>
      <?php _e('Please note: comment moderation is enabled and may delay your comment. There is no need to resubmit your comment.','gravy'); ?>
    </p>
    <?php
			}
?>
    <p>
      <input name="submit" type="submit" id="submit" class="button" tabindex="5" value="<?php _e('Submit Comment','gravy'); ?>" />
    </p>
    <?php
			do_action('comment_form', $post->ID);
?>
  </form>
</div>
<?php } } ?>
