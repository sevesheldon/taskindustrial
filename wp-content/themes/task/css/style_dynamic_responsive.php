<?php
$root = dirname(dirname(dirname(dirname(dirname(__FILE__)))));
if ( file_exists( $root.'/wp-load.php' ) ) {
    require_once( $root.'/wp-load.php' );
//    require_once( $root.'/wp-config.php' );
} else {
	$root = dirname(dirname(dirname(dirname(dirname(dirname(__FILE__))))));
	if ( file_exists( $root.'/wp-load.php' ) ) {
    require_once( $root.'/wp-load.php' );
//    require_once( $root.'/wp-config.php' );
	}
}
header("Content-type: text/css; charset=utf-8");
?>

@media only screen and (max-width:1400px){
	
	<?php
	if (isset($edgt_options['portfolio_masonry_with_padding_width']) && $edgt_options['portfolio_masonry_with_padding_width'] > 20) { ?>
	.projects_masonry_holder.masonry_with_padding .portfolio_masonry_item {
		padding: 20px;
	}
	.projects_masonry_holder.masonry_with_padding{
		margin: 0 -20px;
	}
	<?php } ?>
}

@media only screen and (max-width: 1100px){

	<?php if (isset($edgt_options['portfolio_box']) && $edgt_options['portfolio_box'] == 'no') { ?>
		.portfolio_single.big-slider .portfolio_container,
		.portfolio_single.big-images .portfolio_container,
		.portfolio_single.gallery .portfolio_container{
			padding: 35px 0;
		}
	<?php } ?>
}

@media only screen and (max-width: 1000px){
	
	<?php if (!empty($edgt_options['header_background_color'])) { ?>
	.header_bottom {
		background-color: <?php echo esc_attr($edgt_options['header_background_color']);  ?>;
	}
	<?php } ?>
	<?php if (!empty($edgt_options['mobile_background_color'])) { ?>
		.header_bottom,
		nav.mobile_menu{
				background-color: <?php echo esc_attr($edgt_options['mobile_background_color']);  ?> !important;
		}
	<?php } ?>
	
	 <?php if (isset($edgt_options['page_subtitle_fontsize']) && ($edgt_options['page_subtitle_fontsize']) < 28 && ($edgt_options['page_subtitle_fontsize']) !== '') { ?>
		.subtitle{
			font-size: <?php echo esc_attr($edgt_options['page_subtitle_fontsize']) *0.8;  ?>px;
		}
	 <?php }?>
		
	<?php if(isset($edgt_options['h1_fontsize']) && ($edgt_options['h1_fontsize'])>80) { ?>
		.title h1,
		.title h1.title_like_separator .vc_text_separator.full .separator_content{
			font-size:<?php echo esc_attr($edgt_options['h1_fontsize'])*0.8; ?>px;			
		}
	<?php } ?>
	<?php if(isset($edgt_options['page_title_fontsize']) && ($edgt_options['page_title_fontsize'])>80) { ?>
		.title.title_size_small h1,
		.title.title_size_small h1.title_like_separator .vc_text_separator.full .separator_content{
			font-size:<?php echo esc_attr($edgt_options['page_title_fontsize'])*0.8; ?>px;
		}
	<?php } ?>
	<?php if(isset($edgt_options['page_title_medium_fontsize']) && ($edgt_options['page_title_medium_fontsize'])>80) { ?>
		.title.title_size_medium h1,
		.title.title_size_medium h1.title_like_separator .vc_text_separator.full .separator_content{
			font-size:<?php echo esc_attr($edgt_options['page_title_medium_fontsize'])*0.8; ?>px;
		}
	<?php } ?>
	<?php if(isset($edgt_options['page_title_large_fontsize']) && ($edgt_options['page_title_large_fontsize'])>80) { ?>
		.title.title_size_large h1,
		.title.title_size_large h1.title_like_separator .vc_text_separator.full .separator_content{
			font-size:<?php echo esc_attr($edgt_options['page_title_large_fontsize'])*0.8; ?>px;
		}
	<?php } ?>
	<?php if(isset($edgt_options['h2_fontsize']) && ($edgt_options['h2_fontsize'])>70) { ?>
		.content h2{
			font-size:<?php echo esc_attr($edgt_options['h2_fontsize'])*0.8; ?>px;
		}
	<?php } ?>
	<?php if(isset($edgt_options['h3_fontsize']) && ($edgt_options['h3_fontsize'])>70) { ?>
		.content h3{
			font-size:<?php echo esc_attr($edgt_options['h3_fontsize'])*0.8; ?>px;
		}
	<?php } ?>
	<?php if(isset($edgt_options['h4_fontsize']) && ($edgt_options['h4_fontsize'])>70) { ?>
		.content h4{
			font-size:<?php echo esc_attr($edgt_options['h4_fontsize'])*0.8; ?>px;
		}
	<?php } ?>
	<?php if(isset($edgt_options['h5_fontsize']) && ($edgt_options['h5_fontsize'])>70) { ?>
		.content h5{
			font-size:<?php echo esc_attr($edgt_options['h5_fontsize'])*0.8; ?>px;
		}
	<?php } ?>
	<?php if(isset($edgt_options['h6_fontsize']) && ($edgt_options['h6_fontsize'])>70) { ?>
		.content h6{
			font-size:<?php echo esc_attr($edgt_options['h6_fontsize'])*0.8; ?>px;
		}
	<?php } ?>

	<?php if(isset($edgt_options['portfolio_list_filter_height']) && $edgt_options['portfolio_list_filter_height'] !== '') { ?>
		.filter_outer.filter_portfolio{
			line-height: 2em;
		}
	<?php } ?>
}

@media only screen and (min-width: 480px) and (max-width: 768px){

	<?php if(isset($edgt_options['overlapping_content']) && $edgt_options['overlapping_content'] == 'yes' && isset($edgt_options['overlapping_top_content_amount']) && $edgt_options['overlapping_top_content_amount'] > 30){ ?>
	.overlapping_content .content .content_inner > .container .overlapping_content,
	.overlapping_content .content .content_inner > .full_width .full_width_inner{
		margin-top: -30px;
	}

	.overlapping_content .title .title_holder .container{
		padding-bottom: 30px;
	}
	
	.animate_overlapping_content .overlapping_content,
	.animate_overlapping_content .full_width {
		-webkit-transform: translateY(30px);
		transform: translateY(30px);
	}
	<?php }	?>
}

@media only screen and (min-width: 600px) and (max-width: 768px){
	<?php if(isset($edgt_options['h1_fontsize']) && $edgt_options['h1_fontsize'] != '') {
		$title_font_size = $edgt_options['h1_fontsize'];
		if (($edgt_options['h1_fontsize'])>80) {
			$title_font_size *= 0.5;
		}
		elseif (($edgt_options['h1_fontsize'])>65) {
		 	$title_font_size *= 0.6;
		}
		elseif (($edgt_options['h1_fontsize'])>50) {
		 	$title_font_size *= 0.7;
		}
		elseif (($edgt_options['h1_fontsize'])>35) {
		 	$title_font_size *= 0.8;
		} ?>
		.title h1,
		.title h1.title_like_separator .vc_text_separator.full .separator_content{
			font-size:<?php echo esc_attr($title_font_size); ?>px;
		}
	<?php } ?>
	<?php if(isset($edgt_options['page_title_fontsize']) && ($edgt_options['page_title_fontsize']) !== "") {
		$page_title_font_size = $edgt_options['page_title_fontsize'];
		if (($edgt_options['page_title_fontsize'])>80) {
			$page_title_font_size *= 0.5;
		}
		elseif (($edgt_options['page_title_fontsize'])>65) {
		 	$page_title_font_size *= 0.6;
		}
		elseif (($edgt_options['page_title_fontsize'])>50) {
		 	$page_title_font_size *= 0.7;
		}
		elseif (($edgt_options['page_title_fontsize'])>35) {
		 	$page_title_font_size *= 0.8;
		} ?>
		.title.title_size_small h1,
		.title.title_size_small h1.title_like_separator .vc_text_separator.full .separator_content{
			font-size:<?php echo esc_attr($page_title_font_size); ?>px;
		}
	<?php } ?>
	<?php if(isset($edgt_options['page_title_medium_fontsize']) && ($edgt_options['page_title_medium_fontsize']) !== "") {
		$page_title_font_size = $edgt_options['page_title_medium_fontsize'];
		if (($edgt_options['page_title_medium_fontsize'])>80) {
			$page_title_font_size *= 0.5;
		}
		elseif (($edgt_options['page_title_medium_fontsize'])>65) {
		 	$page_title_font_size *= 0.6;
		}
		elseif (($edgt_options['page_title_medium_fontsize'])>50) {
		 	$page_title_font_size *= 0.7;
		}
		elseif (($edgt_options['page_title_medium_fontsize'])>35) {
		 	$page_title_font_size *= 0.8;
		} ?>
		.title.title_size_medium h1,
		.title.title_size_medium h1.title_like_separator .vc_text_separator.full .separator_content{
			font-size:<?php echo esc_attr($page_title_font_size); ?>px;
		}
	<?php } ?>
	<?php if(isset($edgt_options['page_title_large_fontsize']) && ($edgt_options['page_title_large_fontsize']) !== "") {
		$page_title_font_size = $edgt_options['page_title_large_fontsize'];
		if (($edgt_options['page_title_large_fontsize'])>80) {
			$page_title_font_size *= 0.5;
		}
		elseif (($edgt_options['page_title_large_fontsize'])>65) {
		 	$page_title_font_size *= 0.6;
		}
		elseif (($edgt_options['page_title_large_fontsize'])>50) {
		 	$page_title_font_size *= 0.7;
		}
		elseif (($edgt_options['page_title_large_fontsize'])>35) {
		 	$page_title_font_size *= 0.8;
		} ?>
		.title.title_size_large h1,
		.title.title_size_large h1.title_like_separator .vc_text_separator.full .separator_content{
			font-size:<?php echo esc_attr($page_title_font_size); ?>px;
		}
	<?php } ?>
	<?php if(isset($edgt_options['h2_fontsize']) && ($edgt_options['h2_fontsize'])>35) { ?>
		.content h2{
			font-size:<?php echo esc_attr($edgt_options['h2_fontsize'])*0.7; ?>px;
		}
	<?php } ?>
	<?php if(isset($edgt_options['h3_fontsize']) && ($edgt_options['h3_fontsize'])>35) { ?>
		.content h3{
			font-size:<?php echo esc_attr($edgt_options['h3_fontsize'])*0.7; ?>px;
		}
	<?php } ?>
	<?php if(isset($edgt_options['h4_fontsize']) && ($edgt_options['h4_fontsize'])>35) { ?>
		.content h4{
			font-size:<?php echo esc_attr($edgt_options['h4_fontsize'])*0.7; ?>px;
		}
	<?php } ?>
	<?php if(isset($edgt_options['h5_fontsize']) && ($edgt_options['h5_fontsize'])>35) { ?>
		.content h5{
			font-size:<?php echo esc_attr($edgt_options['h5_fontsize'])*0.7; ?>px;
		}
	<?php } ?>
	<?php if(isset($edgt_options['h6_fontsize']) && ($edgt_options['h6_fontsize'])>35) { ?>
		.content h6{
			font-size:<?php echo esc_attr($edgt_options['h6_fontsize'])*0.7; ?>px;
		}
	<?php } ?>
	
	<?php if (isset($edgt_options['page_subtitle_fontsize']) && ($edgt_options['page_subtitle_fontsize']) < 28 && ($edgt_options['page_subtitle_fontsize']) !== '') { ?>
		.subtitle{
			font-size: <?php echo esc_attr($edgt_options['page_subtitle_fontsize']) *0.8;  ?>px;
		}
	 <?php } ?>
}

@media only screen and (min-width: 480px) and (max-width: 768px){
	<?php if (isset($edgt_options['parallax_minheight']) && !empty($edgt_options['parallax_minheight'])) { ?>
        section.parallax_section_holder{
		height: auto !important;
		min-height: <?php echo esc_attr($edgt_options['parallax_minheight']); ?>px !important;
	}
	<?php } ?>
	
	<?php if (isset($edgt_options['header_background_color_mobile']) &&  !empty($edgt_options['header_background_color_mobile'])) { ?>
	header
	{
		 background-color: <?php echo esc_attr($edgt_options['header_background_color_mobile']);  ?> !important;
		 background-image:none;
	}
	<?php } ?>
}

@media only screen and (max-width: 600px){
	<?php if(isset($edgt_options['h1_fontsize']) && $edgt_options['h1_fontsize'] !== '') {
		$title_font_size = $edgt_options['h1_fontsize'];
		if (($edgt_options['h1_fontsize'])>80) {
			$title_font_size *= 0.4;
		}
		elseif (($edgt_options['h1_fontsize'])>65) {
		 	$title_font_size *= 0.5;
		}
		elseif (($edgt_options['h1_fontsize'])>50) {
		 	$title_font_size *= 0.6;
		}
		elseif (($edgt_options['h1_fontsize'])>35) {
		 	$title_font_size *= 0.7;
		} ?>
		.title h1,
		.title h1.title_like_separator .vc_text_separator.full .separator_content{
			font-size:<?php echo esc_attr($title_font_size); ?>px;
		}
	<?php } ?>
	<?php if(isset($edgt_options['page_title_fontsize']) && ($edgt_options['page_title_fontsize']) !== '') {
		$page_title_font_size = $edgt_options['page_title_fontsize'];
		if (($edgt_options['page_title_fontsize'])>80) {
			$page_title_font_size *= 0.4;
		}
		elseif (($edgt_options['page_title_fontsize'])>65) {
		 	$page_title_font_size *= 0.5;
		}
		elseif (($edgt_options['page_title_fontsize'])>50) {
		 	$page_title_font_size *= 0.6;
		}
		elseif (($edgt_options['page_title_fontsize'])>35) {
		 	$page_title_font_size *= 0.7;
		} ?>
		.title.title_size_small h1,
		.title.title_size_small h1.title_like_separator .vc_text_separator.full .separator_content{
			font-size:<?php echo esc_attr($page_title_font_size); ?>px;
		}
	<?php } ?>
	<?php if(isset($edgt_options['page_title_medium_fontsize']) && ($edgt_options['page_title_medium_fontsize']) !== "") {
		$page_title_font_size = $edgt_options['page_title_medium_fontsize'];
		if (($edgt_options['page_title_medium_fontsize'])>80) {
			$page_title_font_size *= 0.4;
		}
		elseif (($edgt_options['page_title_medium_fontsize'])>65) {
		 	$page_title_font_size *= 0.5;
		}
		elseif (($edgt_options['page_title_medium_fontsize'])>50) {
		 	$page_title_font_size *= 0.6;
		}
		elseif (($edgt_options['page_title_medium_fontsize'])>35) {
		 	$page_title_font_size *= 0.7;
		} ?>
		.title.title_size_medium h1,
		.title.title_size_medium h1.title_like_separator .vc_text_separator.full .separator_content{
			font-size:<?php echo esc_attr($page_title_font_size); ?>px;
		}
	<?php } ?>
	<?php if(isset($edgt_options['page_title_large_fontsize']) && ($edgt_options['page_title_large_fontsize']) !== "") {
		$page_title_font_size = $edgt_options['page_title_large_fontsize'];
		if (($edgt_options['page_title_large_fontsize'])>80) {
			$page_title_font_size *= 0.4;
		}
		elseif (($edgt_options['page_title_large_fontsize'])>65) {
		 	$page_title_font_size *= 0.5;
		}
		elseif (($edgt_options['page_title_large_fontsize'])>50) {
		 	$page_title_font_size *= 0.6;
		}
		elseif (($edgt_options['page_title_large_fontsize'])>35) {
		 	$page_title_font_size *= 0.7;
		} ?>
		.title.title_size_large h1,
		.title.title_size_large h1.title_like_separator .vc_text_separator.full .separator_content{
			font-size:<?php echo esc_attr($page_title_font_size); ?>px;
		}
	<?php } ?>
	<?php if(isset($edgt_options['h2_fontsize']) && ($edgt_options['h2_fontsize'])>35) { ?>
			.content h2{
				font-size:<?php echo esc_attr($edgt_options['h2_fontsize'])*0.5; ?>px;
			}
	<?php } ?>
	<?php if(isset($edgt_options['h3_fontsize']) && ($edgt_options['h3_fontsize'])>35) { ?>
		.content h3{
			font-size:<?php echo esc_attr($edgt_options['h3_fontsize'])*0.5; ?>px;
		}
	<?php } ?>
	<?php if(isset($edgt_options['h4_fontsize']) && ($edgt_options['h4_fontsize'])>35) { ?>
		.content h4{
			font-size:<?php echo esc_attr($edgt_options['h4_fontsize'])*0.5; ?>px;
		}
	<?php } ?>
	<?php if(isset($edgt_options['h5_fontsize']) && ($edgt_options['h5_fontsize'])>35) { ?>
		.content h5{
			font-size:<?php echo esc_attr($edgt_options['h5_fontsize'])*0.5; ?>px;
		}
	<?php } ?>
	<?php if(isset($edgt_options['h6_fontsize']) && ($edgt_options['h6_fontsize'])>35) { ?>
		.content h6{
			font-size:<?php echo esc_attr($edgt_options['h6_fontsize'])*0.5; ?>px;
		}
	<?php } ?>
	<?php if(isset($edgt_options['title_span_background_color']) && !empty($edgt_options['title_span_background_color'])) { ?>
		.title h1 span{
			padding: 0 5px;
		}
	<?php } ?>

	<?php if(isset($edgt_options['portfolio_list_filter_height']) && $edgt_options['portfolio_list_filter_height'] !== '') { ?>
		.filter_outer.filter_portfolio{
			height:auto;
		}
	<?php } ?>

	<?php if (isset($edgt_options['portfolio_box']) && $edgt_options['portfolio_box'] == 'no') { ?>
		.portfolio_single.big-slider .portfolio_container,
		.portfolio_single.big-images .portfolio_container,
		.portfolio_single.gallery .portfolio_container{
			padding: 25px 0;
		}
	<?php } ?>
}

@media only screen and (max-width: 480px){

	<?php if(isset($edgt_options['h1_fontsize']) && $edgt_options['h1_fontsize'] !== '') {
		$title_font_size = $edgt_options['h1_fontsize'];
		if (($edgt_options['h1_fontsize'])>55) {
		 	$title_font_size *= 0.3;
		}
		elseif (($edgt_options['h1_fontsize'])>45) {
		 	$title_font_size *= 0.5;
		}
		elseif (($edgt_options['h1_fontsize'])>35) {
		 	$title_font_size *= 0.6;
		} ?>
		.title h1,
		.title h1.title_like_separator .vc_text_separator.full .separator_content{
			font-size:<?php echo esc_attr($title_font_size); ?>px;
		}
	<?php } ?>
	<?php if(isset($edgt_options['page_title_fontsize']) && ($edgt_options['page_title_fontsize']) !== '') {
		$page_title_font_size = $edgt_options['page_title_fontsize'];
		if (($edgt_options['page_title_fontsize'])>55) {
		 	$page_title_font_size *= 0.3;
		}
		elseif (($edgt_options['page_title_fontsize'])>45) {
		 	$page_title_font_size *= 0.5;
		}
		elseif (($edgt_options['page_title_fontsize'])>35) {
		 	$page_title_font_size *= 0.6;
		} ?>
		.title.title_size_small h1,
		.title.title_size_small h1.title_like_separator .vc_text_separator.full .separator_content{
			font-size:<?php echo esc_attr($page_title_font_size); ?>px;
		}
	<?php } ?>
	<?php if(isset($edgt_options['page_title_medium_fontsize']) && ($edgt_options['page_title_medium_fontsize']) !== '') {
		$page_title_font_size = $edgt_options['page_title_medium_fontsize'];
		if (($edgt_options['page_title_medium_fontsize'])>55) {
		 	$page_title_font_size *= 0.3;
		}
		elseif (($edgt_options['page_title_medium_fontsize'])>45) {
		 	$page_title_font_size *= 0.5;
		}
		elseif (($edgt_options['page_title_medium_fontsize'])>35) {
		 	$page_title_font_size *= 0.6;
		} ?>
		.title.title_size_medium h1,
		.title.title_size_medium h1.title_like_separator .vc_text_separator.full .separator_content{
			font-size:<?php echo esc_attr($page_title_font_size); ?>px;
		}
	<?php } ?>
	<?php if(isset($edgt_options['page_title_large_fontsize']) && ($edgt_options['page_title_large_fontsize']) !== '') {
		$page_title_font_size = $edgt_options['page_title_large_fontsize'];
		if (($edgt_options['page_title_large_fontsize'])>55) {
		 	$page_title_font_size *= 0.3;
		}
		elseif (($edgt_options['page_title_large_fontsize'])>45) {
		 	$page_title_font_size *= 0.5;
		}
		elseif (($edgt_options['page_title_large_fontsize'])>35) {
		 	$page_title_font_size *= 0.6;
		} ?>
		.title.title_size_large h1,
		.title.title_size_large h1.title_like_separator .vc_text_separator.full .separator_content{
			font-size:<?php echo esc_attr($page_title_font_size); ?>px;
		}
	<?php } ?>
	<?php if(isset($edgt_options['h2_fontsize']) && ($edgt_options['h2_fontsize'])>35) { ?>
			.content h2{
				font-size:<?php echo esc_attr($edgt_options['h2_fontsize'])*0.4; ?>px;
			}
	<?php } ?>
	<?php if(isset($edgt_options['h3_fontsize']) && ($edgt_options['h3_fontsize'])>35) { ?>
		.content h3{
			font-size:<?php echo esc_attr($edgt_options['h3_fontsize'])*0.4; ?>px;
		}
	<?php } ?>
	<?php if(isset($edgt_options['h4_fontsize']) && ($edgt_options['h4_fontsize'])>35) { ?>
		.content h4{
			font-size:<?php echo esc_attr($edgt_options['h4_fontsize'])*0.4; ?>px;
		}
	<?php } ?>
	<?php if(isset($edgt_options['h5_fontsize']) && ($edgt_options['h5_fontsize'])>35) { ?>
		.content h5{
			font-size:<?php echo esc_attr($edgt_options['h5_fontsize'])*0.4; ?>px;
		}
	<?php } ?>
	<?php if(isset($edgt_options['h6_fontsize']) && ($edgt_options['h6_fontsize'])>35) { ?>
		.content h6{
			font-size:<?php echo esc_attr($edgt_options['h6_fontsize'])*0.4; ?>px;
		}
	<?php } ?>
		
	<?php if (isset($edgt_options['parallax_minheight']) && !empty($edgt_options['parallax_minheight'])) { ?>
	section.parallax_section_holder{
		height: auto !important;
		min-height: <?php echo esc_attr($edgt_options['parallax_minheight']); ?>px !important;
	}
	<?php } ?>
	
	
	<?php if (isset($edgt_options['header_background_color_mobile']) &&  !empty($edgt_options['header_background_color_mobile'])) { ?>
	header
	{
		 background-color: <?php echo esc_attr($edgt_options['header_background_color_mobile']);  ?> !important;
		 background-image:none;
	}
	<?php } ?>

	<?php
		if(isset($edgt_options['masonry_gallery_square_big_title_font_size']) && ($edgt_options['masonry_gallery_square_big_title_font_size']) > 30) { ?>
		        .masonry_gallery_item.square_big h3 {
	        		font-size: <?php echo esc_attr($edgt_options['masonry_gallery_square_big_title_font_size'])*0.7; ?>px;
					line-height: 1.3em;
	    		}
		<?php }
	?>
}