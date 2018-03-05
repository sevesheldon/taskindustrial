<?php

$args = array(
    'columns'     		=> 'four_columns',
	'arrows_between'		=> '',
	'line_color'		=> '',
	'process_width'		=> '',
	'process_height'	=> '',
);

$html 					= '';
$styles 				= array();
$circle_holder_class 	= array();

extract(shortcode_atts($args, $atts));

$arrows_between = esc_attr($arrows_between);

$circle_holder_class[] = $columns;

if(isset($arrows_between)) {
	switch ($arrows_between) {
		case 'yes' :
			$circle_holder_class[] = 'with_arrows';
			break;
		case 'lines' :
			$circle_holder_class[] = 'with_lines';
			if(isset($line_color) && $line_color != '') {
				$styles[] = 'border-color: '.$line_color;
			}
			break;
	}
}

$data_attr = "";

if($process_height != ""){
	$data_attr .= "data-proces-height='" . $process_height. "'";
}
if($process_width != ""){
	$data_attr .= " data-proces-width='" . $process_width. "'";
}

$html = '<div class="edgt_circles_shortcode">';
if($arrows_between == 'lines'){
	$html .= '<div class = "circle_line_holder '.implode(' ', $circle_holder_class).'" '.edgt_get_inline_style($styles).'></div>';
}

$html .= '<ul class="edgt_circles_holder '.implode(' ', $circle_holder_class).'" '.$data_attr.'>';

$html .= do_shortcode($content);

$html .= '</ul>';

$html .= '</div>'; //close div.edgt_circles_shortcode

print $html;