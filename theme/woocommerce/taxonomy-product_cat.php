<?php
/**
 * The Template for displaying products in a product category.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 4.7.0
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

// Get the current category
$category = get_queried_object();
$thumbnail_id = get_term_meta($category->term_id, 'thumbnail_id', true);
$image = wp_get_attachment_url($thumbnail_id);
?>

<div class="bg-base-100 min-h-screen">
    <!-- Category Header -->
    <div class="relative bg-base-200 py-12">
        <div class="container mx-auto px-4">
            <div class="flex flex-col md:flex-row items-center gap-8">
                <?php if ($image) : ?>
                    <div class="w-full md:w-1/3">
                        <div class="aspect-square rounded-lg overflow-hidden shadow-lg">
                            <img src="<?php echo esc_url($image); ?>" alt="<?php echo esc_attr($category->name); ?>" class="w-full h-full object-cover">
                        </div>
                    </div>
                <?php endif; ?>
                
                <div class="flex-1 text-center md:text-left">
                    <nav class="mb-4 text-sm breadcrumbs">
                        <ul>
                            <li><a href="<?php echo esc_url(home_url()); ?>"><?php esc_html_e('Αρχική', 'tw'); ?></a></li>
                            <li><a href="<?php echo esc_url(get_permalink(wc_get_page_id('shop'))); ?>"><?php esc_html_e('Κατάστημα', 'tw'); ?></a></li>
                            <li><?php echo esc_html($category->name); ?></li>
                        </ul>
                    </nav>
                    
                    <?php if (apply_filters('woocommerce_show_page_title', true)) : ?>
                        <h1 class="text-4xl font-bold mb-4"><?php woocommerce_page_title(); ?></h1>
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
                    
                    <div class="stats shadow">
                        <div class="stat">
                            <div class="stat-title"><?php esc_html_e('Προϊόντα', 'tw'); ?></div>
                            <div class="stat-value"><?php echo esc_html($category->count); ?></div>
                        </div>
                    </div>
                </div>
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