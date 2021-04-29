<?php

/*
// Lets check if product is in cart
*/

function webroom_product_in_cart($product_id){

	$product_cart_id = WC()->cart->generate_cart_id( $product_id );
    $in_cart = WC()->cart->find_product_in_cart( $product_cart_id );
 
    if ( $in_cart ) {
        return true;
    }
	return false;
}

// Lets change the product price in cart

add_action( 'woocommerce_after_calculate_totals', 'webroom_change_price_of_product' );

function webroom_change_price_of_product( $cart_object ) {	
    $target_product_id = 48617; // CHANGE THIS WITH YOUR PRODUCT ID original price: 149 EUR
	$cart_total = WC()->cart->total;
	if(webroom_product_in_cart(48617)) {
	
	// Product is already in cart
	 if ( $cart_total > 89 ) {	
		foreach ( $cart_object->get_cart() as $key => $value ) {
			if ( $value['product_id'] == $target_product_id ) {
				$value['data']->set_price(0); // CHANGE THIS: set the new price
				$new_price = $value['data']->get_price();
			}
		}
	}
	}
}
