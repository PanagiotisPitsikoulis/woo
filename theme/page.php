<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default. Please note that
 * this is the WordPress construct of pages: specifically, posts with a post
 * type of `page`.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
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
			<article class="max-w-4xl mx-auto">
				<header class="mb-8 text-center">
					<h1 class="text-4xl font-bold mb-4"><?php the_title(); ?></h1>
				</header>

				<?php if (has_post_thumbnail()) : ?>
					<figure class="mb-8">
						<?php the_post_thumbnail('large', ['class' => 'w-full rounded-lg shadow-md']); ?>
					</figure>
				<?php endif; ?>

				<div class="prose prose-lg max-w-none mb-10">
					<?php the_content(); ?>
				</div>
			</article>

			<?php
			// If comments are open or we have at least one comment, load up the comment template.
			if (comments_open() || get_comments_number()) :
			?>
				<div class="max-w-4xl mx-auto mt-16">
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
