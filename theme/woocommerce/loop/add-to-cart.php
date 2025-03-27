<?php
/**
 * Loop Add to Cart
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/loop/add-to-cart.php.
 *
 * @see         https://docs.woocommerce.com/document/template-structure/
 * @package     WooCommerce\Templates
 * @version     9.2.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $product;

// Map WooCommerce classes to DaisyUI classes
$classes = array(
	'button'                => 'btn btn-primary btn-sm',
	'product_type_simple'   => '',
	'add_to_cart_button'    => '',
	'ajax_add_to_cart'      => '',
	'product_type_variable' => 'btn-outline',
	'product_type_external' => 'btn-secondary',
	'product_type_grouped'  => 'btn-accent',
);

// Get existing classes and replace with DaisyUI classes
$button_classes = array();
foreach ( explode( ' ', $args['class'] ) as $class ) {
	if ( isset( $classes[ $class ] ) && ! empty( $classes[ $class ] ) ) {
		$button_classes[] = $classes[ $class ];
	}
}

$button_text = '';
if ( $product->is_type( 'variable' ) ) {
	$button_text = esc_html__( 'Επιλογή Παραλλαγών', 'tw' );
} elseif ( $product->is_type( 'grouped' ) ) {
	$button_text = esc_html__( 'Προβολή Προϊόντων', 'tw' );
} else {
	$button_text = esc_html__( 'Προσθήκη στο Καλάθι', 'tw' );
}

echo apply_filters(
	'woocommerce_loop_add_to_cart_link',
	sprintf(
		'<a href="%s" data-quantity="%s" class="%s" %s>%s <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4 ml-1"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 00-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 00-16.536-1.84M7.5 14.25L5.106 5.272M6 20.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zm12.75 0a.75.75 0 11-1.5 0 .75.75 0 011.5 0z" /></svg></a>',
		esc_url( $product->add_to_cart_url() ),
		esc_attr( isset( $args['quantity'] ) ? $args['quantity'] : 1 ),
		esc_attr( implode( ' ', $button_classes ) ),
		isset( $args['attributes'] ) ? wc_implode_html_attributes( $args['attributes'] ) : '',
		$button_text
	),
	$product,
	$args
); 