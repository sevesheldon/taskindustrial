<?php

$args = array(
	'animation_type' => '',
	'hover_animation' => '',
	'border_color' => '',
	'border_width' => '',
	'animation_time' => '2',
//	'transition_delay' => '',
	'holder_padding' => ''
);

extract(shortcode_atts($args, $atts));

$border_color = esc_attr($border_color);
$border_width = esc_attr($border_width);
$animation_time = esc_attr($animation_time);
$holder_padding = esc_attr($holder_padding);

$animated_elements_holder_style = '' ;
$border_style = '';
$animation_hover_class = '';

$border_style = 'border: ';

if ($border_width !== '') {
	$border_style .= $border_width. 'px';
}
else if($animation_type !== ''){
	$border_style .= '2px';
}

$border_style .= ' solid ';

if ($border_color !== '') {
	$border_style .= $border_color . ';';

}
else if ($animation_type !== ''){
	$border_style .= '#000;';
}

if ($animation_type !== ''){
	$border_style .= 'display: none;';
}

if ($hover_animation == 'edgt_box_scale_in'){
	$animation_hover_class .= 'edgt_scale_in';
}

if ($holder_padding !== '') {
	$animated_elements_holder_style = "padding: " .$holder_padding. ";";
}

$html = '';

$html = '<div class="edgt_animated_elements_holder '.esc_attr($animation_hover_class).'" style="' .$animated_elements_holder_style. '" data-animation="' .$animation_type. '" data-animation-time="' .$animation_time. '" data-border-color="' .$border_color. '" data-border-width="' .$border_width. '">';
$html .= '<div class="edgt_animated_elements_holder_border" '.edgt_get_inline_style($border_style).'></div>';
$html .= do_shortcode($content);
$html .= '</div>';

print $html;