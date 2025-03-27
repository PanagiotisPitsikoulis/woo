<?php
/**
 * Single Product Image
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.5.1
 */

defined('ABSPATH') || exit;

// Note: `wc_get_gallery_image_html` was added in WC 3.3.2 and did not exist prior. This check protects against theme overrides being used on older versions of WC.
if (!function_exists('wc_get_gallery_image_html')) {
    return;
}

global $product;

$columns           = apply_filters('woocommerce_product_thumbnails_columns', 4);
$post_thumbnail_id = $product->get_image_id();
$wrapper_classes   = apply_filters(
    'woocommerce_single_product_image_gallery_classes',
    array(
        'woocommerce-product-gallery',
        'woocommerce-product-gallery--' . ($post_thumbnail_id ? 'with-images' : 'without-images'),
        'woocommerce-product-gallery--columns-' . absint($columns),
        'images',
    )
);
?>
<div class="<?php echo esc_attr(implode(' ', array_map('sanitize_html_class', $wrapper_classes))); ?>" data-columns="<?php echo esc_attr($columns); ?>" style="opacity: 0; transition: opacity .25s ease-in-out;">
    <figure class="woocommerce-product-gallery__wrapper">
        <?php
        if ($post_thumbnail_id) {
            $html = wc_get_gallery_image_html($post_thumbnail_id, true);
        } else {
            $html  = '<div class="woocommerce-product-gallery__image--placeholder">';
            $html .= sprintf('<img src="%s" alt="%s" class="wp-post-image" />', esc_url(wc_placeholder_img_src('woocommerce_single')), esc_html__('Awaiting product image', 'woocommerce'));
            $html .= '</div>';
        }

        echo apply_filters('woocommerce_single_product_image_thumbnail_html', $html, $post_thumbnail_id); // phpcs:disable WordPress.XSS.EscapeOutput.OutputNotEscaped

        do_action('woocommerce_product_thumbnails');
        ?>
    </figure>
</div>

<style>
    .woocommerce-product-gallery {
        position: relative;
        margin-bottom: 2rem;
    }
    
    .woocommerce-product-gallery .woocommerce-product-gallery__trigger {
        position: absolute;
        top: 1rem;
        right: 1rem;
        z-index: 10;
        width: 2.5rem;
        height: 2.5rem;
        background: hsl(var(--b1));
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        text-decoration: none;
        color: hsl(var(--bc));
        border: 1px solid hsl(var(--bc) / 0.2);
    }
    
    .woocommerce-product-gallery .woocommerce-product-gallery__trigger:hover {
        background: hsl(var(--b2));
    }
    
    .woocommerce-product-gallery .woocommerce-product-gallery__wrapper {
        margin: 0;
        overflow: hidden;
        border-radius: var(--rounded-box, 1rem);
    }
    
    .woocommerce-product-gallery .woocommerce-product-gallery__image {
        margin-bottom: 0;
    }
    
    .woocommerce-product-gallery .woocommerce-product-gallery__image img {
        width: 100%;
        height: auto;
        display: block;
        object-fit: contain;
        background: hsl(var(--b1));
    }
    
    .woocommerce-product-gallery .flex-control-thumbs {
        display: grid;
        grid-template-columns: repeat(<?php echo esc_attr($columns); ?>, 1fr);
        gap: 0.75rem;
        margin-top: 1rem;
        padding: 0;
        list-style: none;
    }
    
    .woocommerce-product-gallery .flex-control-thumbs li {
        width: 100%;
        padding: 0;
        margin: 0;
        float: none;
    }
    
    .woocommerce-product-gallery .flex-control-thumbs li img {
        width: 100%;
        height: auto;
        display: block;
        opacity: 0.6;
        cursor: pointer;
        transition: all 0.3s ease;
        border-radius: 0.5rem;
        border: 1px solid transparent;
    }
    
    .woocommerce-product-gallery .flex-control-thumbs li img.flex-active,
    .woocommerce-product-gallery .flex-control-thumbs li img:hover {
        opacity: 1;
        border-color: hsl(var(--p));
    }
</style> 