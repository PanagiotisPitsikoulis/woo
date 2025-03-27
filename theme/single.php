<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package _tw
 */

get_header();
?>

<div class="min-h-screen bg-base-100">
	<div class="container mx-auto py-10 px-4">
		<?php
		/* Start the Loop */
		while (have_posts()) :
			the_post();
		?>
			<article class="max-w-3xl mx-auto">
				<header class="mb-6">
					<h1 class="text-4xl font-bold mb-4"><?php the_title(); ?></h1>
					<div class="flex flex-wrap gap-4 items-center text-sm mb-6">
						<span>
							<?php echo get_the_date(); ?>
						</span>
						<div class="badge badge-primary"><?php echo get_the_category_list(', '); ?></div>
						<?php if (has_tag()) : ?>
							<div class="badge badge-outline"><?php the_tags('', ', '); ?></div>
						<?php endif; ?>
					</div>
					
					<?php if (has_post_thumbnail()) : ?>
						<figure class="mb-6">
							<?php the_post_thumbnail('large', ['class' => 'w-full rounded-lg shadow-md']); ?>
						</figure>
					<?php endif; ?>
				</header>

				<div class="prose prose-lg max-w-none mb-10">
					<?php the_content(); ?>
				</div>

				<?php if (is_singular('post')) : ?>
					<div class="divider my-10"></div>
					
					<div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
						<?php
						$prev_post = get_previous_post();
						$next_post = get_next_post();
						?>
						
						<?php if (!empty($prev_post)) : ?>
							<a href="<?php echo esc_url(get_permalink($prev_post->ID)); ?>" class="btn btn-outline">
								<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mr-2">
									<path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
								</svg>
								<?php echo esc_html(get_the_title($prev_post->ID)); ?>
							</a>
						<?php else : ?>
							<div></div>
						<?php endif; ?>
						
						<?php if (!empty($next_post)) : ?>
							<a href="<?php echo esc_url(get_permalink($next_post->ID)); ?>" class="btn btn-outline">
								<?php echo esc_html(get_the_title($next_post->ID)); ?>
								<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 ml-2">
									<path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
								</svg>
							</a>
						<?php else : ?>
							<div></div>
						<?php endif; ?>
					</div>
				<?php endif; ?>
			</article>

			<?php
			// If comments are open or we have at least one comment, load up the comment template.
			if (comments_open() || get_comments_number()) :
			?>
				<div class="max-w-3xl mx-auto mt-16">
					<?php comments_template(); ?>
				</div>
			<?php
			endif;
		endwhile; // End of the loop.
		?>
	</div>
</div>

<?php
get_footer();
