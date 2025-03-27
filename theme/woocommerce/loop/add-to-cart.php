<?php
/**
 * Loop Add to Cart
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/loop/add-to-cart.php.
 *
 * @see         https://docs.woocommerce.com/document/template-structure/
 * @package     WooCommerce\Templates
 * @version     3.3.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $product;

// Map WooCommerce classes to DaisyUI classes
$classes = array(
	'button'                      => 'btn',
	'product_type_simple'         => '',
	'add_to_cart_button'          => '',
	'ajax_add_to_cart'            => '',
	'product_type_variable'       => 'btn-outline',
	'product_type_external'       => 'btn-secondary',
	'product_type_grouped'        => 'btn-accent',
);

// Get existing classes and replace with DaisyUI classes
$button_classes = array();
foreach ( explode( ' ', $args['class'] ) as $class ) {
	if ( isset( $classes[ $class ] ) && ! empty( $classes[ $class ] ) ) {
		$button_classes[] = $classes[ $class ];
	}
}

echo apply_filters(
	'woocommerce_loop_add_to_cart_link', // WPCS: XSS ok.
	sprintf(
		'<a href="%s" data-quantity="%s" class="%s" %s>%s</a>',
		esc_url( $product->add_to_cart_url() ),
		esc_attr( isset( $args['quantity'] ) ? $args['quantity'] : 1 ),
		esc_attr( implode( ' ', $button_classes ) ),
		isset( $args['attributes'] ) ? wc_implode_html_attributes( $args['attributes'] ) : '',
		esc_html( $product->add_to_cart_text() )
	),
	$product,
	$args
); 