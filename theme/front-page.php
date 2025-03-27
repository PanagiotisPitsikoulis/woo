<?php
/**
 * The template for displaying the front page
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package _tw
 */

get_header();
?>

<div class="min-h-screen bg-base-100">
	<!-- Hero Section with background image and overlay -->
	<?php 
	// Get hero section content from customizer
	$hero_title = get_theme_mod('tw_hero_title', get_bloginfo('name'));
	$hero_description = get_theme_mod('tw_hero_description', get_bloginfo('description'));
	$hero_button_text = get_theme_mod('tw_hero_button_text', __('Shop Now', 'tw'));
	$hero_button_url = get_theme_mod('tw_hero_button_url', get_permalink(wc_get_page_id('shop')));
	$hero_image = get_theme_mod('tw_hero_image');
	
	// If no hero image set, try to use the site logo
	if (!$hero_image) {
		$custom_logo_id = get_theme_mod('custom_logo');
		if ($custom_logo_id) {
			$hero_image = wp_get_attachment_url($custom_logo_id);
		}
	}
	?>
	
	<div class="hero min-h-[80vh] relative" style="<?php echo $hero_image ? 'background-image: url(' . esc_url($hero_image) . ');' : ''; ?> background-size: cover; background-position: center;">
		<!-- Overlay -->
		<div class="hero-overlay opacity-60 absolute inset-0 bg-neutral"></div>
		
		<div class="hero-content text-center text-neutral-content relative z-10 px-4">
			<div class="max-w-xl">
				<h1 class="mb-6 text-5xl font-bold"><?php echo esc_html($hero_title); ?></h1>
				<p class="mb-8 text-lg"><?php echo esc_html($hero_description); ?></p>
				<a href="<?php echo esc_url($hero_button_url); ?>" class="btn btn-lg"><?php echo esc_html($hero_button_text); ?></a>
			</div>
		</div>
	</div>

	<!-- Featured Categories with improved styling -->
	<div class="py-16 px-4 bg-base-200">
		<div class="container mx-auto">
			<h2 class="text-4xl font-bold text-center mb-12 relative">
				<span class="inline-block relative">
					<?php echo esc_html(get_theme_mod('tw_featured_categories_title', __('Featured Categories', 'tw'))); ?>
					<span class="absolute -bottom-2 left-1/2 transform -translate-x-1/2 w-24 h-1 bg-primary rounded-full"></span>
				</span>
			</h2>
			
			<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
				<?php
				// Get all product categories
				$args = array(
					'taxonomy'   => 'product_cat',
					'hide_empty' => false,
					'orderby'    => 'count',
					'order'      => 'DESC',
				);
				
				$product_categories = get_terms($args);
				
				if (!empty($product_categories) && !is_wp_error($product_categories)) {
					foreach ($product_categories as $category) {
						// Skip the 'Uncategorized' category
						if ($category->slug === 'uncategorized') {
							continue;
						}
						
						// Get category image
						$thumbnail_id = get_term_meta($category->term_id, 'thumbnail_id', true);
						$image = wp_get_attachment_url($thumbnail_id);
						?>
						<div class="card hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 overflow-hidden group">
							<figure class="relative h-48">
								<?php if ($image) : ?>
									<img src="<?php echo esc_url($image); ?>" alt="<?php echo esc_attr($category->name); ?>" class="h-full w-full object-cover transition-transform duration-500 group-hover:scale-105" />
								<?php else : ?>
									<div class="bg-base-300 h-full w-full flex items-center justify-center">
										<span class="text-2xl font-bold"><?php echo esc_html($category->name); ?></span>
									</div>
								<?php endif; ?>
								<div class="absolute inset-0 bg-neutral bg-opacity-0 group-hover:bg-opacity-30 transition-all duration-300"></div>
							</figure>
							<div class="card-body p-4">
								<h3 class="card-title text-lg mb-1"><?php echo esc_html($category->name); ?></h3>
								<?php if ($category->count > 0) : ?>
									<p class="text-sm text-base-content/70 mb-3">
										<?php printf(_n('%s Product', '%s Products', $category->count, 'tw'), number_format_i18n($category->count)); ?>
									</p>
								<?php endif; ?>
								<div class="card-actions justify-end mt-auto">
									<a href="<?php echo esc_url(get_term_link($category)); ?>" class="btn btn-sm btn-outline">
										<?php esc_html_e('Browse', 'tw'); ?>
										<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 ml-1">
											<path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
										</svg>
									</a>
								</div>
							</div>
						</div>
						<?php
					}
				} else {
					// Fallback if no product categories exist
					echo '<div class="col-span-full text-center alert alert-info p-6">' . esc_html__('No product categories found. Add some in your WooCommerce settings.', 'tw') . '</div>';
				}
				?>
			</div>
		</div>
	</div>

	<!-- Featured Products with improved styling -->
	<div class="py-16 px-4 bg-base-100">
		<div class="container mx-auto">
			<h2 class="text-4xl font-bold text-center mb-12 relative">
				<span class="inline-block relative">
					<?php echo esc_html(get_theme_mod('tw_featured_products_title', __('Featured Products', 'tw'))); ?>
					<span class="absolute -bottom-2 left-1/2 transform -translate-x-1/2 w-24 h-1 bg-primary rounded-full"></span>
				</span>
			</h2>
			
			<div class="woocommerce products-grid">
				<?php
				if (class_exists('WooCommerce')) {
					// Get featured products shortcode settings from theme mods
					$products_per_page = get_theme_mod('tw_featured_products_count', 4);
					$products_columns = get_theme_mod('tw_featured_products_columns', 4);
					$products_orderby = get_theme_mod('tw_featured_products_orderby', 'popularity');
					
					echo do_shortcode('[products limit="' . esc_attr($products_per_page) . '" columns="' . esc_attr($products_columns) . '" orderby="' . esc_attr($products_orderby) . '" class="products-grid"]');
				} else {
					echo '<div class="text-center alert alert-warning p-6">' . esc_html__('WooCommerce is not active. Please install and activate WooCommerce to display products.', 'tw') . '</div>';
				}
				?>
			</div>
			
			<div class="text-center mt-12">
				<?php if (class_exists('WooCommerce')) : ?>
					<a href="<?php echo esc_url(get_permalink(wc_get_page_id('shop'))); ?>" class="btn btn-lg">
						<?php echo esc_html(get_theme_mod('tw_view_all_products_text', __('View All Products', 'tw'))); ?>
						<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 ml-1">
							<path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
						</svg>
					</a>
				<?php endif; ?>
			</div>
		</div>
	</div>
</div>

<?php
get_footer(); 