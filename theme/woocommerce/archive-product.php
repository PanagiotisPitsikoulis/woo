<?php
/**
 * The Template for displaying product archives, including the main shop page.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 8.6.0
 */

defined('ABSPATH') || exit;

get_header();

/**
 * Hook: woocommerce_before_main_content.
 *
 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
 * @hooked woocommerce_breadcrumb - 20
 * @hooked WC_Structured_Data::generate_website_data() - 30
 */
do_action('woocommerce_before_main_content');
?>

<div class="bg-base-100 min-h-screen">
    <!-- Shop Header -->
    <div class="relative bg-base-200 py-12">
        <div class="container mx-auto px-4">
            <div class="text-center">
                <?php if (apply_filters('woocommerce_show_page_title', true)) : ?>
                    <h1 class="text-4xl font-bold mb-4">
                        <?php if (is_shop()) : ?>
                            <?php woocommerce_page_title(); ?>
                        <?php elseif (is_search()) : ?>
                            <?php printf(esc_html__('Αποτελέσματα αναζήτησης για: %s', 'tw'), '<span>' . get_search_query() . '</span>'); ?>
                        <?php endif; ?>
                    </h1>
                <?php endif; ?>
                
                <?php if (is_shop() && get_option('woocommerce_shop_page_id')) : ?>
                    <?php $shop_page_id = get_option('woocommerce_shop_page_id'); ?>
                    <?php if (get_post_field('post_content', $shop_page_id)) : ?>
                        <div class="prose max-w-2xl mx-auto mb-6">
                            <?php echo apply_filters('the_content', get_post_field('post_content', $shop_page_id)); ?>
                        </div>
                    <?php endif; ?>
                <?php endif; ?>
                
                <?php
                /**
                 * Hook: woocommerce_archive_description.
                 *
                 * @hooked woocommerce_taxonomy_archive_description - 10
                 * @hooked woocommerce_product_archive_description - 10
                 */
                do_action('woocommerce_archive_description');
                ?>
            </div>
        </div>
    </div>

    <!-- Products Section -->
    <div class="container mx-auto px-4 py-12">
        <?php
        if (woocommerce_product_loop()) {
            /**
             * Hook: woocommerce_before_shop_loop.
             *
             * @hooked woocommerce_output_all_notices - 10
             * @hooked woocommerce_result_count - 20
             * @hooked woocommerce_catalog_ordering - 30
             */
            ?>
            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-8">
                <?php do_action('woocommerce_before_shop_loop'); ?>
            </div>

            <?php
            woocommerce_product_loop_start();

            if (wc_get_loop_prop('total')) {
                while (have_posts()) {
                    the_post();

                    /**
                     * Hook: woocommerce_shop_loop.
                     */
                    do_action('woocommerce_shop_loop');

                    wc_get_template_part('content', 'product');
                }
            }

            woocommerce_product_loop_end();

            /**
             * Hook: woocommerce_after_shop_loop.
             *
             * @hooked woocommerce_pagination - 10
             */
            do_action('woocommerce_after_shop_loop');
        } else {
            /**
             * Hook: woocommerce_no_products_found.
             *
             * @hooked wc_no_products_found - 10
             */
            do_action('woocommerce_no_products_found');
        }
        ?>
    </div>
</div>

<?php
/**
 * Hook: woocommerce_after_main_content.
 *
 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
 */
do_action('woocommerce_after_main_content');

get_footer(); 