<?php 



// require BOX_PATH .'/woo/add_extra_fee.php';

function wk_add_text_field() { ?>
    <div class="custom-field-wrap" style="margin: 10px;">
        <label for="custom-field"><?php esc_html_e( 'Quote', 'webkul' ); ?></label>
        <input type="text" name='custom-field' id='custom-field' value=''>
    </div>
    <?php
}
add_action( 'woocommerce_before_add_to_cart_button', 'wk_add_text_field' );

/**
 *No.3 
 **/
function wk_add_to_cart_validation( $passed, $product_id, $quantity, $variation_id = null ) {
    // echo '<pre>';
    // var_dump($_POST);
    // echo '</pre>';
    // die();
    if ( empty( $_POST['custom-field'] ) ) {
        $passed = false;
        wc_add_notice( __( 'Quote is a required field.', 'webkul' ), 'error' );
    }
    return $passed;
}
add_filter( 'woocommerce_add_to_cart_validation', 'wk_add_to_cart_validation', 10, 4 );



/**
 * No.4
 * Add custom cart item data
 */
function wk_add_cart_item_data( $cart_item_data, $product_id, $variation_id ) {
    if ( isset( $_POST['custom-field'] ) ) {
        $cart_item_data['pr_field'] = sanitize_text_field( $_POST['custom-field'] );
    }
    if ( isset( $_POST['delivery_date'] ) ) {
        $cart_item_data['delivery_date'] = sanitize_text_field( $_POST['delivery_date'] );
    }
    return $cart_item_data;
}
add_filter( 'woocommerce_add_cart_item_data', 'wk_add_cart_item_data', 10, 3 );



/**
 * Display custom item data in the cart
 */
function wk_get_item_data( $item_data, $cart_item_data ) {
    if ( isset( $cart_item_data['pr_field'] ) ) {
        $item_data[] = array(
            'key'   => __( 'Quote', 'webkul' ),
            'value' => wc_clean( $cart_item_data['pr_field'] ),
        );
    }

     if ( isset( $cart_item_data['delivery_date'] ) ) {
        $item_data[] = array(
            'key'   => __( 'Delivery Date', 'webkul' ),
            'value' => wc_clean( $cart_item_data['delivery_date'] ),
        );
    }

    
    return $item_data;
}
add_filter( 'woocommerce_get_item_data', 'wk_get_item_data', 10, 2 );




/**
 * Add custom meta to order
 */
function wk_checkout_create_order_line_item( $item, $cart_item_key, $values, $order ) {
    if ( isset( $values['pr_field'] ) ) {
        $item->add_meta_data(
            __( 'Quote', 'webkul' ),
            $values['pr_field'],
            true
        );
    }
    if ( isset( $values['delivery_date'] ) ) {
        $item->add_meta_data(
            __( 'Delivery date', 'webkul' ),
            $values['delivery_date'],
            true
        );
    }
}
add_action( 'woocommerce_checkout_create_order_line_item', 'wk_checkout_create_order_line_item', 10, 4 );