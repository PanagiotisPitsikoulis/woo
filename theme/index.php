<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no `home.php` file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package _tw
 */

get_header();
?>

<div class="min-h-screen bg-base-100">
	<div class="container mx-auto py-10 px-4">
		<?php if (is_home() && !is_front_page()) : ?>
			<header class="mb-10 text-center">
				<h1 class="text-4xl font-bold"><?php single_post_title(); ?></h1>
			</header>
		<?php endif; ?>

		<?php if (have_posts()) : ?>
			<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
				<?php
				// Start the Loop.
				while (have_posts()) :
					the_post();
					?>
					<div class="card bg-base-100 shadow-xl">
						<?php if (has_post_thumbnail()) : ?>
							<figure>
								<?php the_post_thumbnail('medium', ['class' => 'w-full h-48 object-cover']); ?>
							</figure>
						<?php endif; ?>
						<div class="card-body">
							<h2 class="card-title">
								<a href="<?php the_permalink(); ?>" class="hover:text-primary">
									<?php the_title(); ?>
								</a>
							</h2>
							<div class="text-sm mb-2">
								<?php echo get_the_date(); ?> • <?php echo get_the_category_list(', '); ?>
							</div>
							<p><?php the_excerpt(); ?></p>
							<div class="card-actions justify-end">
								<a href="<?php the_permalink(); ?>" class="btn btn-sm">
									<?php esc_html_e('Read More', 'tw'); ?>
								</a>
							</div>
						</div>
					</div>
				<?php
				endwhile;
				?>
			</div>

			<div class="mt-10 flex justify-center">
				<?php
				// Custom pagination with DaisyUI styling
				$prev_text = '<button class="btn btn-outline">' . __('Previous', 'tw') . '</button>';
				$next_text = '<button class="btn btn-outline">' . __('Next', 'tw') . '</button>';
				
				echo '<div class="join">';
				echo get_previous_posts_link($prev_text);
				echo get_next_posts_link($next_text);
				echo '</div>';
				?>
			</div>

		<?php else : ?>
			<div class="card bg-base-100 shadow-xl max-w-lg mx-auto">
				<div class="card-body">
					<h2 class="card-title"><?php esc_html_e('Nothing Found', 'tw'); ?></h2>
					<p><?php esc_html_e('It seems we can\'t find what you\'re looking for.', 'tw'); ?></p>
					<div class="card-actions">
						<a href="<?php echo esc_url(home_url('/')); ?>" class="btn">
							<?php esc_html_e('Back to Homepage', 'tw'); ?>
						</a>
					</div>
				</div>
			</div>
		<?php endif; ?>
	</div>
</div>

<?php
get_footer();
