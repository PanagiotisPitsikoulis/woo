<?php
/**
 * Single Product tabs
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.8.0
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Filter tabs and allow third parties to add their own.
 *
 * Each tab is an array containing title, callback and priority.
 *
 * @see woocommerce_default_product_tabs()
 */
$product_tabs = apply_filters('woocommerce_product_tabs', array());

if (!empty($product_tabs)) : ?>

<div class="woocommerce-tabs wc-tabs-wrapper">
    <div class="tabs tabs-boxed mb-6">
        <?php foreach ($product_tabs as $key => $product_tab) : ?>
            <a class="tab <?php echo $key === array_key_first($product_tabs) ? 'tab-active' : ''; ?>" href="#tab-<?php echo esc_attr($key); ?>">
                <?php echo wp_kses_post(apply_filters('woocommerce_product_' . $key . '_tab_title', $product_tab['title'], $key)); ?>
            </a>
        <?php endforeach; ?>
    </div>
    
    <?php foreach ($product_tabs as $key => $product_tab) : ?>
        <div class="woocommerce-Tabs-panel woocommerce-Tabs-panel--<?php echo esc_attr($key); ?> panel entry-content" id="tab-<?php echo esc_attr($key); ?>" role="tabpanel" aria-labelledby="tab-title-<?php echo esc_attr($key); ?>">
            <?php
            if (isset($product_tab['callback'])) {
                call_user_func($product_tab['callback'], $key, $product_tab);
            }
            ?>
        </div>
    <?php endforeach; ?>

    <?php do_action('woocommerce_product_after_tabs'); ?>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Hide all panels except the first one
    const panels = document.querySelectorAll('.woocommerce-Tabs-panel');
    panels.forEach(function(panel, index) {
        if (index !== 0) {
            panel.style.display = 'none';
        }
    });

    // Add click event to tabs
    const tabs = document.querySelectorAll('.tabs-boxed .tab');
    tabs.forEach(function(tab) {
        tab.addEventListener('click', function(e) {
            e.preventDefault();
            
            // Remove active class from all tabs
            tabs.forEach(function(t) {
                t.classList.remove('tab-active');
            });
            
            // Add active class to clicked tab
            this.classList.add('tab-active');
            
            // Hide all panels
            panels.forEach(function(panel) {
                panel.style.display = 'none';
            });
            
            // Show the selected panel
            const panelId = this.getAttribute('href');
            document.querySelector(panelId).style.display = 'block';
        });
    });
});
</script>

<?php endif; ?> 