<?php

$args = array(
'background_color' => '',
'border_color' => '',
'padding' => '',
'active' => 'no',
'active_text_color' => '',
'active_background_color' => '',
'hide_last_element' => ''
);

extract(shortcode_atts($args, $atts));

$html = "";

$ribbon_holder_class = '';
$ribbon_holder_style = array();
$ribbon_corner_style = array();
$ribbon_active_text_style = array();


if($background_color != ""){
    $ribbon_holder_style[] ="background-color:". $background_color;
    $ribbon_corner_style[] ="fill:". $background_color;
}

if($border_color != ""){
    $ribbon_holder_style[] ="border-color:". $border_color;
    $ribbon_corner_style[] ="stroke:". $border_color;
}

if($padding != ""){
    $ribbon_holder_style[] ="padding:". $padding;
}

if($active_text_color != ""){
    $ribbon_active_text_style[] ="color:". $active_text_color;
}

if($border_color != ""){
    $ribbon_active_text_style[] ="border-right-color:". $active_background_color;
}

if($hide_last_element == "yes"){
    $ribbon_holder_class .= 'hide_last_element';
}

$html .= '<div class="edgt_ribbon_holder '.$ribbon_holder_class.'" data-opened-height="70" data-closed-height="48" >';
    $html .= '<div class="edgt_ribbon_holder_base" '.edgt_get_inline_style($ribbon_holder_style).'>';
        $html .= '<div class="edgt_ribbon_holder_base_inner">';

            if($active == "yes") {
                $html .= '<div class="ribbon_new_holder" '.edgt_get_inline_style($ribbon_active_text_style).'><span>' . __('Open', 'edgt') . '</span></div>';
            }

            $html .= do_shortcode($content);

        $html .= '</div>'; // closed edgt_ribbon_holder_base_inner
    $html .= '</div>'; // closed edgt_ribbon_holder_base

    $html .= '<svg class="ribbon_corner svg-top" preserveAspectRatio="none" viewBox="0 0 100 100" width="100%" height="48">';
        $html .= '<polygon points="-1,0 50,99 101,0" ' .edgt_get_inline_style($ribbon_corner_style) . ' />';
        /* cordinates are lake this, because of stroke */
    $html .= '</svg>';

$html .= '</div>'; // closed edgt_ribbon_holder

print $html;
