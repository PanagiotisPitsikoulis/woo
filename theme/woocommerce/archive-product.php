<?php
/**
 * The Template for displaying product archives, including the main shop page.
 *
 * @package _tw
 */

get_header();
?>

<div class="bg-base-100 min-h-screen">
    <!-- Shop Header -->
    <div class="relative bg-base-200 py-12">
        <div class="container mx-auto px-4">
            <div class="text-center">
                <h1 class="text-4xl font-bold mb-4">
                    <?php if (is_shop()) : ?>
                        <?php woocommerce_page_title(); ?>
                    <?php elseif (is_search()) : ?>
                        <?php printf(esc_html__('Search Results for: %s', 'tw'), '<span>' . get_search_query() . '</span>'); ?>
                    <?php endif; ?>
                </h1>
                
                <?php if (is_shop() && get_option('woocommerce_shop_page_id')) : ?>
                    <?php $shop_page_id = get_option('woocommerce_shop_page_id'); ?>
                    <?php if (get_post_field('post_content', $shop_page_id)) : ?>
                        <div class="prose max-w-2xl mx-auto mb-6">
                            <?php echo apply_filters('the_content', get_post_field('post_content', $shop_page_id)); ?>
                        </div>
                    <?php endif; ?>
                <?php endif; ?>
                
                <?php if (function_exists('woocommerce_output_all_notices')) : ?>
                    <div class="mb-6">
                        <?php woocommerce_output_all_notices(); ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- Products Section -->
    <div class="container mx-auto px-4 py-12">
        <?php if (woocommerce_product_loop()) : ?>
            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-8">
                <div>
                    <?php if (function_exists('woocommerce_result_count')) : ?>
                        <?php woocommerce_result_count(); ?>
                    <?php endif; ?>
                </div>
                
                <div class="flex flex-col sm:flex-row gap-4">
                    <?php if (function_exists('woocommerce_catalog_ordering')) : ?>
                        <div class="form-control">
                            <?php woocommerce_catalog_ordering(); ?>
                        </div>
                    <?php endif; ?>
                    
                    <?php if (function_exists('woocommerce_product_filter_widget') && is_active_sidebar('shop-filters')) : ?>
                        <button class="btn btn-outline btn-sm flex items-center gap-2" type="button" data-toggle="collapse" data-target="#shop-filters">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                                <path d="M6 10.5a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 0 1h-3a.5.5 0 0 1-.5-.5zm-2-3a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5zm-2-3a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5z"/>
                            </svg>
                            <?php esc_html_e('Filter', 'tw'); ?>
                        </button>
                    <?php endif; ?>
                </div>
            </div>
            
            <div class="products-grid grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                <?php
                if (wc_get_loop_prop('total')) {
                    while (have_posts()) {
                        the_post();
                        do_action('woocommerce_shop_loop');
                        wc_get_template_part('content', 'product');
                    }
                }
                ?>
            </div>
            
            <div class="mt-12">
                <?php if (function_exists('woocommerce_pagination')) : ?>
                    <?php woocommerce_pagination(); ?>
                <?php endif; ?>
            </div>

        <?php else : ?>
            <div class="alert alert-info p-8 max-w-xl mx-auto text-center">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="w-12 h-12 mx-auto mb-4 stroke-current">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <p class="text-lg"><?php esc_html_e('No products were found matching your selection.', 'tw'); ?></p>
                <div class="mt-6">
                    <a href="<?php echo esc_url(get_permalink(wc_get_page_id('shop'))); ?>" class="btn btn-primary">
                        <?php esc_html_e('View All Products', 'tw'); ?>
                    </a>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>

<?php
get_footer(); 