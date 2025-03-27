<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package _tw
 */

get_header();
?>

<div class="min-h-screen bg-base-100">
	<div class="container mx-auto py-12 px-4">
		<!-- Search Header with improved styling -->
		<?php if (have_posts()) : ?>
			<header class="mb-12 text-center max-w-3xl mx-auto">
				<h1 class="text-4xl font-bold mb-4 relative inline-block">
					<?php
					printf(
						/* translators: %s: search query. */
						esc_html__('Search Results for: %s', 'tw'),
						'<span class="text-primary">' . get_search_query() . '</span>'
					);
					?>
					<span class="absolute -bottom-2 left-0 right-0 h-1 bg-primary rounded-full"></span>
				</h1>
				
				<div class="mt-8 max-w-lg mx-auto">
					<?php get_search_form(); ?>
				</div>
				
				<div class="stats shadow mt-8 bg-base-200 inline-flex flex-wrap">
					<div class="stat">
						<div class="stat-title"><?php esc_html_e('Results Found', 'tw'); ?></div>
						<div class="stat-value text-primary"><?php echo number_format_i18n($wp_query->found_posts); ?></div>
					</div>
				</div>
			</header>
		<?php else : ?>
			<header class="mb-12 text-center">
				<h1 class="text-4xl font-bold mb-6">
					<?php esc_html_e('Nothing Found', 'tw'); ?>
				</h1>
				<p class="mb-6 text-lg max-w-2xl mx-auto">
					<?php esc_html_e('Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'tw'); ?>
				</p>
				
				<div class="max-w-lg mx-auto">
					<?php get_search_form(); ?>
				</div>
			</header>
		<?php endif; ?>

		<!-- Search Results with improved styling -->
		<?php if (have_posts()) : ?>
			<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
				<?php
				// Start the Loop.
				while (have_posts()) :
					the_post();
					?>
					<div class="card bg-base-100 shadow-xl hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-1 overflow-hidden h-full">
						<?php if (has_post_thumbnail()) : ?>
							<figure class="relative">
								<?php the_post_thumbnail('medium', ['class' => 'w-full h-48 object-cover']); ?>
								<div class="absolute top-0 right-0 m-2">
									<div class="badge badge-primary">
										<?php 
										if (get_post_type() === 'post') {
											echo esc_html__('Blog', 'tw');
										} elseif (get_post_type() === 'product') {
											echo esc_html__('Product', 'tw');
										} else {
											echo get_post_type_object(get_post_type())->labels->singular_name;
										}
										?>
									</div>
								</div>
							</figure>
						<?php endif; ?>
						<div class="card-body">
							<h2 class="card-title">
								<a href="<?php the_permalink(); ?>" class="hover:text-primary transition-colors duration-200">
									<?php the_title(); ?>
								</a>
							</h2>
							<div class="flex items-center text-sm opacity-70 mb-3">
								<span><?php echo get_the_date(); ?></span>
								<?php if (get_post_type() === 'post' && has_category()) : ?>
									<span class="mx-2">•</span>
									<span><?php echo get_the_category_list(', '); ?></span>
								<?php endif; ?>
							</div>
							<div class="text-sm mb-4">
								<?php the_excerpt(); ?>
							</div>
							<div class="card-actions justify-end mt-auto">
								<a href="<?php the_permalink(); ?>" class="btn btn-sm">
									<?php 
									if (get_post_type() === 'product') {
										esc_html_e('View Product', 'tw');
									} else {
										esc_html_e('Read More', 'tw');
									}
									?>
									<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4 ml-1">
										<path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
									</svg>
								</a>
							</div>
						</div>
					</div>
				<?php
				endwhile;
				?>
			</div>

			<!-- Improved pagination -->
			<div class="mt-12 flex justify-center">
				<?php
				// Custom pagination with improved DaisyUI styling
				$total_pages = $wp_query->max_num_pages;
				$current_page = max(1, get_query_var('paged'));
				
				if ($total_pages > 1) :
					echo '<div class="join">';
					
					// Previous button
					if ($current_page > 1) {
						$prev_link = get_previous_posts_page_link();
						echo '<a href="' . esc_url($prev_link) . '" class="join-item btn">';
						echo '<svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" /></svg>';
						echo '</a>';
					} else {
						echo '<button class="join-item btn btn-disabled">';
						echo '<svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" /></svg>';
						echo '</button>';
					}
					
					// Page numbers
					$start_page = max(1, $current_page - 2);
					$end_page = min($total_pages, $current_page + 2);
					
					for ($i = $start_page; $i <= $end_page; $i++) {
						$active_class = ($i == $current_page) ? 'btn-active' : '';
						echo '<a href="' . esc_url(get_pagenum_link($i)) . '" class="join-item btn ' . $active_class . '">' . $i . '</a>';
					}
					
					// Next button
					if ($current_page < $total_pages) {
						$next_link = get_next_posts_page_link();
						echo '<a href="' . esc_url($next_link) . '" class="join-item btn">';
						echo '<svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" /></svg>';
						echo '</a>';
					} else {
						echo '<button class="join-item btn btn-disabled">';
						echo '<svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" /></svg>';
						echo '</button>';
					}
					
					echo '</div>';
				endif;
				?>
			</div>

		<?php else : ?>
			<!-- Improved empty results layout -->
			<div class="max-w-xl mx-auto">
				<div class="card bg-base-200 shadow-lg">
					<div class="card-body">
						<h2 class="card-title text-xl mb-4"><?php esc_html_e('Suggestions', 'tw'); ?></h2>
						<ul class="list-disc list-inside space-y-2 mb-6">
							<li><?php esc_html_e('Check your spelling', 'tw'); ?></li>
							<li><?php esc_html_e('Try more general keywords', 'tw'); ?></li>
							<li><?php esc_html_e('Try different keywords', 'tw'); ?></li>
						</ul>
						
						<div class="card-actions justify-center">
							<a href="<?php echo esc_url(home_url('/')); ?>" class="btn">
								<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mr-2">
									<path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
								</svg>
								<?php esc_html_e('Back to Homepage', 'tw'); ?>
							</a>
						</div>
					</div>
				</div>
			</div>
		<?php endif; ?>
	</div>
</div>

<?php
get_footer();
