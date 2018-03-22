<?php
/**
 * Shop breadcrumb
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/global/breadcrumb.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.3.0
 * @see         woocommerce_breadcrumb()
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! empty( $breadcrumb ) ) {

	$breadcrumb0 = $breadcrumb[0];
    $shop_txt = __( 'Shop', 'woocommerce' );
    $products_txt = __( 'Products', 'woocommerce' );
    $products_url = home_url( '/shop' );
    $breadcrumb10 = array( $products_txt );
    $breadcrumb11 = array( $products_txt, $products_url );
    if(is_product() || is_shop() || is_product_category() || is_product_tag() ){
        if( $breadcrumb[1][0] == $shop_txt ){
            if( ! empty( $breadcrumb[1][1] ) )
                $breadcrumb[1] = $breadcrumb11;
            else
                $breadcrumb[1] = $breadcrumb10;
        } else {
            unset($breadcrumb[0]);
            array_unshift($breadcrumb, $breadcrumb0, $breadcrumb11);
        }
    }



	echo $wrap_before;

	foreach ( $breadcrumb as $key => $crumb ) {

		echo $before;

		if ( ! empty( $crumb[1] ) && sizeof( $breadcrumb ) !== $key + 1 ) {
			echo '<a href="' . esc_url( $crumb[1] ) . '">' . esc_html( $crumb[0] ) . '</a>';
		} else {
			echo esc_html( $crumb[0] );
		}

		echo $after;

		if ( sizeof( $breadcrumb ) !== $key + 1 ) {
			echo $delimiter;
		}
	}

	echo $wrap_after;

}
