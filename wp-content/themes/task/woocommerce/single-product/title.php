<?php
/**
 * Single Product title
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $edgt_options;

?>
<h2 itemprop="name" class="product_title entry-title"><?php the_title(); ?></h2>
<?php if (isset($edgt_options['woo_single_product_title_separator']) && $edgt_options['woo_single_product_title_separator'] == "yes"){ ?>
	<div class="single_product_title_separator_holder"><span class="single_product_title_separator separator medium"></span></div>
<?php } ?>

