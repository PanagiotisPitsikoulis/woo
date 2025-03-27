<?php
/**
 * Related Products
 *
 * @see         https://docs.woocommerce.com/document/template-structure/
 * @package     WooCommerce\Templates
 * @version     3.9.0
 */

if (!defined('ABSPATH')) {
    exit;
}

if ($related_products) : ?>

    <section class="related products mt-12 pt-8 border-t border-base-300">
        <?php
        $heading = apply_filters('woocommerce_product_related_products_heading', __('Related products', 'woocommerce'));

        if ($heading) :
            ?>
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-2xl font-bold"><?php echo esc_html($heading); ?></h2>
            </div>
        <?php endif; ?>
        
        <?php woocommerce_product_loop_start(); ?>

            <?php foreach ($related_products as $related_product) : ?>

                    <?php
                    $post_object = get_post($related_product->get_id());

                    setup_postdata($GLOBALS['post'] =& $post_object); // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited, Squiz.PHP.DisallowMultipleAssignments.Found

                    wc_get_template_part('content', 'product');
                    ?>

            <?php endforeach; ?>

        <?php woocommerce_product_loop_end(); ?>

    </section>
    <?php
endif;

wp_reset_postdata(); 