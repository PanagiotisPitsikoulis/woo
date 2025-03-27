<?php
/**
 * The Template for displaying products in a product category.
 *
 * @package _tw
 */

get_header();

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
                            <li><a href="<?php echo esc_url(home_url()); ?>"><?php esc_html_e('Home', 'tw'); ?></a></li>
                            <li><a href="<?php echo esc_url(get_permalink(wc_get_page_id('shop'))); ?>"><?php esc_html_e('Shop', 'tw'); ?></a></li>
                            <li><?php echo esc_html($category->name); ?></li>
                        </ul>
                    </nav>
                    
                    <h1 class="text-4xl font-bold mb-4"><?php echo esc_html($category->name); ?></h1>
                    
                    <?php if ($category->description) : ?>
                        <div class="prose max-w-none mb-6">
                            <?php echo wp_kses_post($category->description); ?>
                        </div>
                    <?php endif; ?>
                    
                    <div class="stats shadow">
                        <div class="stat">
                            <div class="stat-title"><?php esc_html_e('Products', 'tw'); ?></div>
                            <div class="stat-value"><?php echo esc_html($category->count); ?></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Products Section -->
    <div class="container mx-auto px-4 py-12">
        <?php if (woocommerce_product_loop()) : ?>
            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-8">
                <?php
                /**
                 * Hook: woocommerce_before_shop_loop.
                 *
                 * @hooked woocommerce_output_all_notices - 10
                 * @hooked woocommerce_result_count - 20
                 * @hooked woocommerce_catalog_ordering - 30
                 */
                do_action('woocommerce_before_shop_loop');
                ?>
            </div>

            <div class="products-grid">
                <?php
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
                ?>
            </div>

            <?php
            /**
             * Hook: woocommerce_after_shop_loop.
             *
             * @hooked woocommerce_pagination - 10
             */
            do_action('woocommerce_after_shop_loop');
            ?>

        <?php else : ?>
            <div class="alert alert-info">
                <?php esc_html_e('No products were found matching your selection.', 'tw'); ?>
            </div>
        <?php endif; ?>
    </div>

    <?php
    /**
     * Hook: woocommerce_after_main_content.
     */
    do_action('woocommerce_after_main_content');
    ?>
</div>

<?php
get_footer(); 