<?php

add_action('after_setup_theme', 'edgt_meta_boxes_map_init', 1);
function edgt_meta_boxes_map_init() {
	global $edgt_options;
	global $edgtFramework;
	global $edgt_options_fontstyle;
	global $edgt_options_fontweight;
	global $edgt_options_texttransform;
	global $edgt_options_fontdecoration;
	global $edgt_options_arrows_type;
	require_once("page/map.inc");
	require_once("portfolio/map.inc");
	require_once("slides/map.inc");
	require_once("post/map.inc");
	require_once("testimonials/map.inc");
	require_once("carousels/map.inc");
	require_once("masonry_gallery/map.inc");
}