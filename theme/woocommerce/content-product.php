<?php
/**
 * The template for displaying product content within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product.php.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 9.4.0
 */

defined('ABSPATH') || exit;

global $product;

// Ensure visibility.
if (empty($product) || !$product->is_visible()) {
	return;
}

// Extra post classes
$classes = array('card', 'bg-base-100', 'shadow-xl', 'overflow-hidden', 'h-full');
?>

<li <?php wc_product_class($classes, $product); ?>>
	<?php
	/**
	 * Hook: woocommerce_before_shop_loop_item.
	 */
	do_action('woocommerce_before_shop_loop_item');
	?>

	<figure class="px-4 pt-4">
		<?php if ($product->is_on_sale()) : ?>
			<div class="absolute top-6 right-6 z-10">
				<span class="badge badge-secondary"><?php esc_html_e('Προσφορά!', 'tw'); ?></span>
			</div>
		<?php endif; ?>
		
		<?php
		/**
		 * Hook: woocommerce_before_shop_loop_item_title.
		 *
		 * @hooked woocommerce_show_product_loop_sale_flash - 10
		 * @hooked woocommerce_template_loop_product_thumbnail - 10
		 */
		do_action('woocommerce_before_shop_loop_item_title');
		?>
	</figure>
	
	<div class="card-body">
		<h2 class="card-title">
			<a href="<?php echo esc_url($product->get_permalink()); ?>" class="hover:text-primary transition-colors">
				<?php
				/**
				 * Hook: woocommerce_shop_loop_item_title.
				 *
				 * @hooked woocommerce_template_loop_product_title - 10
				 */
				do_action('woocommerce_shop_loop_item_title');
				?>
			</a>
		</h2>
		
		<?php if ($product->get_average_rating()) : ?>
			<div class="rating rating-sm mb-2">
				<?php
				$rating = $product->get_average_rating();
				$full_stars = floor($rating);
				$half_star = ($rating - $full_stars) >= 0.5;
				
				for ($i = 1; $i <= 5; $i++) {
					if ($i <= $full_stars) {
						echo '<input type="radio" class="mask mask-star-2 bg-warning" disabled checked />';
					} elseif ($i == $full_stars + 1 && $half_star) {
						echo '<input type="radio" class="mask mask-star-2 bg-warning" style="mask-size: 50%;" disabled checked />';
					} else {
						echo '<input type="radio" class="mask mask-star-2 bg-warning" disabled />';
					}
				}
				?>
			</div>
		<?php endif; ?>
		
		<div class="mt-2 mb-4">
			<?php
			/**
			 * Hook: woocommerce_after_shop_loop_item_title.
			 *
			 * @hooked woocommerce_template_loop_rating - 5
			 * @hooked woocommerce_template_loop_price - 10
			 */
			do_action('woocommerce_after_shop_loop_item_title');
			?>
		</div>
		
		<div class="card-actions justify-end mt-4">
			<?php
			/**
			 * Hook: woocommerce_after_shop_loop_item.
			 *
			 * @hooked woocommerce_template_loop_product_link_close - 5
			 * @hooked woocommerce_template_loop_add_to_cart - 10
			 */
			remove_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5);
			do_action('woocommerce_after_shop_loop_item');
			?>
			<a href="<?php echo esc_url($product->add_to_cart_url()); ?>" data-quantity="1" class="btn btn-primary btn-sm <?php echo $product->is_purchasable() && $product->is_in_stock() ? 'add_to_cart_button ajax_add_to_cart' : ''; ?>" <?php echo $product->is_purchasable() && $product->is_in_stock() ? 'data-product_id="' . esc_attr($product->get_id()) . '"' : ''; ?>>
				<?php 
				if ($product->is_type('variable')) {
					esc_html_e('Επιλογή Παραλλαγών', 'tw');
				} elseif ($product->is_type('grouped')) {
					esc_html_e('Προβολή Προϊόντων', 'tw');
				} else {
					esc_html_e('Προσθήκη στο Καλάθι', 'tw');
				}
				?>
				<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4 ml-1">
					<path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 00-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 00-16.536-1.84M7.5 14.25L5.106 5.272M6 20.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zm12.75 0a.75.75 0 11-1.5 0 .75.75 0 011.5 0z" />
				</svg>
			</a>
		</div>
	</div>
</li> 