<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package _tw
 */

get_header();
?>

<div class="min-h-screen bg-base-100">
	<div class="container mx-auto py-12 px-4">
		<!-- Archive Header with improved styling -->
		<header class="mb-12 text-center relative">
			<?php 
			// Get archive title and display it with fancy styling
			$title = get_the_archive_title();
			$subtitle = '';
			
			// Parse date archives to make them more readable
			if (is_date()) {
				if (is_year()) {
					$year = get_query_var('year');
					$title = sprintf(__('Archive for %s', 'tw'), $year);
				} elseif (is_month()) {
					$title = sprintf(__('Archive for %s', 'tw'), get_the_date('F Y'));
				} elseif (is_day()) {
					$title = sprintf(__('Archive for %s', 'tw'), get_the_date('F j, Y'));
				}
			} elseif (is_author()) {
				$title = sprintf(__('Posts by %s', 'tw'), get_the_author());
			} elseif (is_category()) {
				$title = single_cat_title('', false);
				$subtitle = __('Category Archive', 'tw');
			} elseif (is_tag()) {
				$title = sprintf(__('Tag: %s', 'tw'), single_tag_title('', false));
			}
			?>
			
			<?php if ($subtitle) : ?>
				<p class="text-sm uppercase tracking-widest text-primary font-semibold mb-2"><?php echo esc_html($subtitle); ?></p>
			<?php endif; ?>
			
			<h1 class="text-4xl font-bold mb-6 relative inline-block">
				<?php echo esc_html($title); ?>
				<span class="absolute -bottom-2 left-0 right-0 h-1 bg-primary rounded-full"></span>
			</h1>
			
			<?php 
			// Display archive description if available
			$description = get_the_archive_description();
			if ($description) : ?>
				<div class="text-lg max-w-2xl mx-auto mt-4 prose prose-sm">
					<?php echo wp_kses_post($description); ?>
				</div>
			<?php endif; ?>
			
			<!-- Archive stats -->
			<div class="stats shadow mt-8 bg-base-200 inline-flex flex-wrap">
				<div class="stat">
					<div class="stat-title"><?php esc_html_e('Total Posts', 'tw'); ?></div>
					<div class="stat-value text-primary"><?php echo number_format_i18n($wp_query->found_posts); ?></div>
				</div>
			</div>
		</header>

		<?php if (have_posts()) : ?>
			<!-- Archive Content with improved styling -->
			<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
				<?php
				// Start the Loop.
				while (have_posts()) :
					the_post();
					?>
					<article class="card bg-base-100 hover:bg-base-200 shadow-xl hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-1 overflow-hidden h-full">
						<?php if (has_post_thumbnail()) : ?>
							<figure class="relative h-56 overflow-hidden">
								<?php the_post_thumbnail('medium_large', ['class' => 'w-full h-full object-cover transition-all duration-700 hover:scale-110']); ?>
								<?php if (is_sticky()) : ?>
									<div class="absolute top-0 right-0 m-2">
										<div class="badge badge-secondary"><?php esc_html_e('Featured', 'tw'); ?></div>
									</div>
								<?php endif; ?>
							</figure>
						<?php endif; ?>
						<div class="card-body">
							<div class="flex items-center gap-3 mb-3">
								<div class="avatar">
									<div class="w-8 rounded-full ring ring-primary ring-offset-base-100 ring-offset-2">
										<?php echo get_avatar(get_the_author_meta('ID'), 32); ?>
									</div>
								</div>
								<div class="text-sm">
									<p class="font-medium"><?php the_author(); ?></p>
									<p class="opacity-70"><?php echo get_the_date(); ?></p>
								</div>
							</div>
							
							<h2 class="card-title">
								<a href="<?php the_permalink(); ?>" class="hover:text-primary transition-colors duration-200">
									<?php the_title(); ?>
								</a>
							</h2>
							
							<div class="mt-2 mb-4">
								<?php if (has_category()) : ?>
									<div class="flex flex-wrap gap-2">
										<?php 
										$categories = get_the_category();
										$max_cats = 3; // Limit number of categories shown
										$count = 0;
										
										foreach ($categories as $category) {
											if ($count < $max_cats) {
												echo '<span class="badge badge-outline">' . esc_html($category->name) . '</span>';
												$count++;
											}
										}
										
										// If there are more categories, show a +X badge
										$remaining = count($categories) - $max_cats;
										if ($remaining > 0) {
											echo '<span class="badge">+' . $remaining . '</span>';
										}
										?>
									</div>
								<?php endif; ?>
							</div>
							
							<div class="text-sm">
								<?php the_excerpt(); ?>
							</div>
							
							<div class="card-actions justify-end mt-auto pt-4">
								<a href="<?php the_permalink(); ?>" class="btn btn-sm">
									<?php esc_html_e('Read More', 'tw'); ?>
									<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4 ml-1">
										<path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
									</svg>
								</a>
							</div>
						</div>
					</article>
				<?php endwhile; ?>
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
			<div class="card bg-base-200 shadow-lg max-w-lg mx-auto">
				<div class="card-body text-center">
					<div class="mb-6">
						<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-16 h-16 mx-auto text-primary opacity-80">
							<path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z" />
						</svg>
					</div>
					<h2 class="card-title text-xl mb-4 justify-center"><?php esc_html_e('Nothing Found', 'tw'); ?></h2>
					<p class="mb-6"><?php esc_html_e('It seems we can\'t find what you\'re looking for.', 'tw'); ?></p>
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
		<?php endif; ?>
	</div>
</div>

<?php
get_footer();
