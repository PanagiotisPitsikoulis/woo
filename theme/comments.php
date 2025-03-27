<?php
/**
 * The template for displaying comments
 *
 * This is the template that displays the area of the page that contains both
 * the current comments and the comment form.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package _tw
 */

/*
 * If the current post is protected by a password and the visitor has not yet
 * entered the password we will return early without loading the comments.
 */
if (post_password_required()) {
	return;
}
?>

<div id="comments" class="bg-base-200 p-6 rounded-lg shadow-md">
	<?php if (have_comments()) : ?>
		<h2 class="text-2xl font-bold mb-6">
			<?php
			$tw_comment_count = get_comments_number();
			if ('1' === $tw_comment_count) {
				// phpcs:disable WordPress.Security.EscapeOutput.OutputNotEscaped
				printf(
					/* translators: 1: title. */
					esc_html__('One comment on &ldquo;%1$s&rdquo;', 'tw'),
					get_the_title()
				);
				// phpcs:enable WordPress.Security.EscapeOutput.OutputNotEscaped
			} else {
				// phpcs:disable WordPress.Security.EscapeOutput.OutputNotEscaped
				printf(
					/* translators: 1: comment count number, 2: title. */
					esc_html(_nx('%1$s comment on &ldquo;%2$s&rdquo;', '%1$s comments on &ldquo;%2$s&rdquo;', $tw_comment_count, 'comments title', 'tw')),
					number_format_i18n($tw_comment_count),
					get_the_title()
				);
				// phpcs:enable WordPress.Security.EscapeOutput.OutputNotEscaped
			}
			?>
		</h2>

		<?php the_comments_navigation(); ?>

		<ul class="space-y-6">
			<?php
			wp_list_comments(
				array(
					'style'      => 'ul',
					'short_ping' => true,
					'callback'   => 'tw_daisyui_comment',
				)
			);
			?>
		</ul>

		<?php
		the_comments_navigation();

		// If comments are closed and there are comments, let's leave a little note.
		if (!comments_open()) :
			?>
			<div class="alert my-8">
				<p><?php esc_html_e('Comments are closed.', 'tw'); ?></p>
			</div>
		<?php
		endif;
	endif; // Check for have_comments().

	// Custom comment form with DaisyUI styling.
	$commenter = wp_get_current_commenter();
	$consent = empty($commenter['comment_author_email']) ? '' : ' checked="checked"';
	
	$fields = array(
		'author' => sprintf(
			'<div class="form-control mb-4"><label for="author" class="label"><span class="label-text">%s%s</span></label><input id="author" name="author" type="text" class="input input-bordered w-full" value="%s" /></div>',
			__('Name', 'tw'),
			' <span class="text-error">*</span>',
			esc_attr($commenter['comment_author'])
		),
		'email' => sprintf(
			'<div class="form-control mb-4"><label for="email" class="label"><span class="label-text">%s%s</span></label><input id="email" name="email" type="email" class="input input-bordered w-full" value="%s" /></div>',
			__('Email', 'tw'),
			' <span class="text-error">*</span>',
			esc_attr($commenter['comment_author_email'])
		),
		'url' => sprintf(
			'<div class="form-control mb-4"><label for="url" class="label"><span class="label-text">%s</span></label><input id="url" name="url" type="url" class="input input-bordered w-full" value="%s" /></div>',
			__('Website', 'tw'),
			esc_attr($commenter['comment_author_url'])
		),
		'cookies' => sprintf(
			'<div class="form-control mb-4"><label class="label cursor-pointer"><input id="wp-comment-cookies-consent" name="wp-comment-cookies-consent" type="checkbox" value="yes" class="checkbox checkbox-primary" %s /><span class="label-text ml-2">%s</span></label></div>',
			$consent,
			__('Save my name, email, and website in this browser for the next time I comment.', 'tw')
		),
	);

	$args = array(
		'class_form' => 'mt-8',
		'title_reply' => '<h3 class="text-xl font-bold mb-4">' . __('Leave a Comment', 'tw') . '</h3>',
		'title_reply_before' => '',
		'title_reply_after' => '',
		'fields' => $fields,
		'comment_field' => sprintf(
			'<div class="form-control mb-4"><label for="comment" class="label"><span class="label-text">%s%s</span></label><textarea id="comment" name="comment" class="textarea textarea-bordered h-32" required></textarea></div>',
			__('Comment', 'tw'),
			' <span class="text-error">*</span>'
		),
		'submit_button' => '<button type="submit" class="btn">%s</button>',
		'submit_field' => '<div class="form-control mt-6">%1$s %2$s</div>',
	);

	comment_form($args);
	?>
</div>

<?php
/**
 * Custom comment callback for DaisyUI styling.
 */
function tw_daisyui_comment($comment, $args, $depth) {
	$tag = ('div' === $args['style']) ? 'div' : 'li';
	?>
	<<?php echo $tag; ?> id="comment-<?php comment_ID(); ?>" <?php comment_class(empty($args['has_children']) ? 'card bg-base-100' : 'card bg-base-100 has-children', $comment); ?>>
		<div class="card-body">
			<div class="flex items-start gap-4">
				<div class="avatar">
					<div class="w-12 rounded-full">
						<?php echo get_avatar($comment, 48, '', get_comment_author($comment), array('class' => 'rounded-full')); ?>
					</div>
				</div>
				<div class="flex-1">
					<div class="flex items-center justify-between mb-2">
						<div>
							<h3 class="font-bold"><?php echo get_comment_author_link($comment); ?></h3>
							<div class="text-sm opacity-70">
								<a href="<?php echo esc_url(get_comment_link($comment)); ?>" class="hover:text-primary">
									<time datetime="<?php comment_time('c'); ?>">
										<?php
										printf(
											/* translators: 1: comment date, 2: comment time */
											esc_html__('%1$s at %2$s', 'tw'),
											get_comment_date('', $comment),
											get_comment_time()
										);
										?>
									</time>
								</a>
								<?php edit_comment_link(__('Edit', 'tw'), ' <span class="mx-2">•</span> <span class="edit-link">', '</span>'); ?>
							</div>
						</div>
					</div>
					
					<?php if ('0' == $comment->comment_approved) : ?>
						<div class="alert alert-info mb-4">
							<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="stroke-current shrink-0 w-6 h-6"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
							<span><?php esc_html_e('Your comment is awaiting moderation.', 'tw'); ?></span>
						</div>
					<?php endif; ?>
					
					<div class="prose max-w-none">
						<?php comment_text(); ?>
					</div>
					
					<?php
					comment_reply_link(
						array_merge(
							$args,
							array(
								'add_below' => 'div-comment',
								'depth'     => $depth,
								'max_depth' => $args['max_depth'],
								'before'    => '<div class="mt-4"><span class="btn btn-sm">',
								'after'     => '</span></div>',
							)
						)
					);
					?>
				</div>
			</div>
		</div>
	</<?php echo $tag; ?>>
	<?php
}
