<?php
/**
 * The template for displaying product content in the single-product.php template
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.6.0
 */

defined('ABSPATH') || exit;

global $product;

/**
 * Hook: woocommerce_before_single_product.
 *
 * @hooked woocommerce_output_all_notices - 10
 */
do_action('woocommerce_before_single_product');

if (post_password_required()) {
    echo get_the_password_form(); // WPCS: XSS ok.
    return;
}
?>

<div id="product-<?php the_ID(); ?>" <?php wc_product_class('max-w-7xl mx-auto', $product); ?>>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
        <div class="product-images card bg-base-100 overflow-hidden">
            <?php
            /**
             * Hook: woocommerce_before_single_product_summary.
             *
             * @hooked woocommerce_show_product_sale_flash - 10
             * @hooked woocommerce_show_product_images - 20
             */
            do_action('woocommerce_before_single_product_summary');
            ?>
        </div>

        <div class="product-summary">
            <div class="card bg-base-100 shadow-xl">
                <div class="card-body">
                    <h1 class="card-title text-3xl mb-4"><?php the_title(); ?></h1>
                    
                    <?php if ($product->get_price_html()) : ?>
                    <div class="text-2xl font-bold text-primary mb-6">
                        <?php echo $product->get_price_html(); ?>
                    </div>
                    <?php endif; ?>
                    
                    <?php if ($product->get_short_description()) : ?>
                    <div class="prose mb-8">
                        <?php echo apply_filters('woocommerce_short_description', $product->get_short_description()); ?>
                    </div>
                    <?php endif; ?>
                    
                    <div class="card-actions">
                        <?php
                        /**
                         * Hook: woocommerce_single_product_summary.
                         *
                         * @hooked woocommerce_template_single_rating - 10
                         * @hooked woocommerce_template_single_add_to_cart - 30
                         * @hooked woocommerce_template_single_meta - 40
                         * @hooked woocommerce_template_single_sharing - 50
                         */
                        remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_title', 5);
                        remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_price', 10);
                        remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20);
                        do_action('woocommerce_single_product_summary');
                        ?>
                    </div>
                </div>
            </div>
            
            <?php if (wc_get_product_category_list($product->get_id()) || wc_get_product_tag_list($product->get_id())) : ?>
            <div class="card bg-base-100 shadow-xl mt-6">
                <div class="card-body">
                    <h3 class="card-title text-lg">Product Details</h3>
                    
                    <?php if (wc_get_product_category_list($product->get_id())) : ?>
                    <div class="flex gap-2">
                        <span class="font-semibold">Categories:</span>
                        <span><?php echo wc_get_product_category_list($product->get_id()); ?></span>
                    </div>
                    <?php endif; ?>
                    
                    <?php if (wc_get_product_tag_list($product->get_id())) : ?>
                    <div class="flex gap-2">
                        <span class="font-semibold">Tags:</span>
                        <span><?php echo wc_get_product_tag_list($product->get_id()); ?></span>
                    </div>
                    <?php endif; ?>
                    
                    <?php if ($product->get_sku()) : ?>
                    <div class="flex gap-2">
                        <span class="font-semibold">SKU:</span>
                        <span><?php echo esc_html($product->get_sku()); ?></span>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
            <?php endif; ?>
        </div>
    </div>

    <div class="mt-12">
        <div class="card bg-base-100 shadow-xl">
            <div class="card-body">
                <?php
                /**
                 * Hook: woocommerce_after_single_product_summary.
                 *
                 * @hooked woocommerce_output_product_data_tabs - 10
                 * @hooked woocommerce_upsell_display - 15
                 * @hooked woocommerce_output_related_products - 20
                 */
                do_action('woocommerce_after_single_product_summary');
                ?>
            </div>
        </div>
    </div>
</div>

<?php do_action('woocommerce_after_single_product'); ?> 