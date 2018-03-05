<?php

if(!function_exists('edgt_loading_spinners')) {
    function edgt_loading_spinners($return = false) {
        global $edgt_options;

        $spinner_html = '';
        if(isset($edgt_options['loading_animation_spinner'])){


            switch ($edgt_options['loading_animation_spinner']) {
                case "pulse":
                    $spinner_html = edgt_loading_spinner_pulse();
                break;
                case "double_pulse":
                    $spinner_html =  edgt_loading_spinner_double_pulse();
                break;
                case "cube":
                    $spinner_html =  edgt_loading_spinner_cube();
                break;
                case "rotating_cubes":
                    $spinner_html =  edgt_loading_spinner_rotating_cubes();
                break;
                case "stripes":
                    $spinner_html =  edgt_loading_spinner_stripes();
                break;
                case "wave":
                    $spinner_html =  edgt_loading_spinner_wave();
                break;
                case "two_rotating_circles":
                    $spinner_html =  edgt_loading_spinner_two_rotating_circles();
                break;
                case "five_rotating_circles":
                    $spinner_html =  edgt_loading_spinner_five_rotating_circles();
                break;
				case "atom":
                    $spinner_html = edgt_loading_spinner_atom();
                break;
				case "clock":
                    $spinner_html = edgt_loading_spinner_clock();
                break;
				case "mitosis":
                    $spinner_html = edgt_loading_spinner_mitosis();
                break;
				case "lines":
                    $spinner_html = edgt_loading_spinner_lines();
                break;
				case "fussion":
                    $spinner_html = edgt_loading_spinner_fussion();
                break;
				case "wave_circles":
                    $spinner_html = edgt_loading_spinner_wave_circles();
                break;
				case "pulse_circles":
                    $spinner_html = edgt_loading_spinner_pulse_circles();
                break;
				case "line":
                    $spinner_html = edgt_loading_spinner_line();
                break;
				case "wide_line":
                    $spinner_html = edgt_loading_spinner_wide_line();
                break;
            }
        }else{
            $spinner_html = edgt_loading_spinner_pulse();
        }

        if($return === true) {
            return $spinner_html;
        }

        echo wp_kses($spinner_html, array(
            'div' => array(
                'class' => true,
                'style' => true,
                'id' => true
            )
        ));
    }
}

if(!function_exists('edgt_loading_spinner_pulse')) {
    function edgt_loading_spinner_pulse() {
        $html = '';
        $html .= '<div class="pulse"></div>';
        return $html;
    }
}

if(!function_exists('edgt_loading_spinner_double_pulse')) {
    function edgt_loading_spinner_double_pulse() {
        $html = '';
        $html .= '<div class="double_pulse">';
        $html .= '<div class="double-bounce1"></div>';
        $html .= '<div class="double-bounce2"></div>';
        $html .= '</div>';

        return $html;
    }
}

if(!function_exists('edgt_loading_spinner_cube')) {
    function edgt_loading_spinner_cube() {
        $html = '';
        $html .= '<div class="cube"></div>';
        return $html;
    }
}

if(!function_exists('edgt_loading_spinner_rotating_cubes')) {
    function edgt_loading_spinner_rotating_cubes() {
        $html = '';
        $html .= '<div class="rotating_cubes">';
        $html .= '<div class="cube1"></div>';
        $html .= '<div class="cube2"></div>';
        $html .= '</div>';

        return $html;
    }
}

if(!function_exists('edgt_loading_spinner_stripes')) {
    function edgt_loading_spinner_stripes() {
        $html = '';
        $html .= '<div class="stripes">';
        $html .= '<div class="rect1"></div>';
        $html .= '<div class="rect2"></div>';
        $html .= '<div class="rect3"></div>';
        $html .= '<div class="rect4"></div>';
        $html .= '<div class="rect5"></div>';
        $html .= '</div>';
        return $html;
    }
}

if(!function_exists('edgt_loading_spinner_wave')) {
    function edgt_loading_spinner_wave() {
        $html = '';
        $html .= '<div class="wave">';
        $html .= '<div class="bounce1"></div>';
        $html .= '<div class="bounce2"></div>';
        $html .= '<div class="bounce3"></div>';
        $html .= '</div>';

        return $html;
    }
}

if(!function_exists('edgt_loading_spinner_two_rotating_circles')) {
    function edgt_loading_spinner_two_rotating_circles() {
        $html = '';
        $html .= '<div class="two_rotating_circles">';
        $html .= '<div class="dot1"></div>';
        $html .= '<div class="dot2"></div>';
        $html .= '</div>';

        return $html;
    }
}

if(!function_exists('edgt_loading_spinner_five_rotating_circles')) {
    function edgt_loading_spinner_five_rotating_circles() {
        $html = '';
        $html .= '<div class="five_rotating_circles">';
        $html .= '<div class="spinner-container container1">';
        $html .= '<div class="circle1"></div>';
        $html .= '<div class="circle2"></div>';
        $html .= '<div class="circle3"></div>';
        $html .= '<div class="circle4"></div>';
        $html .= '</div>';
        $html .= '<div class="spinner-container container2">';
        $html .= '<div class="circle1"></div>';
        $html .= '<div class="circle2"></div>';
        $html .= '<div class="circle3"></div>';
        $html .= '<div class="circle4"></div>';
        $html .= '</div>';
        $html .= '<div class="spinner-container container3">';
        $html .= '<div class="circle1"></div>';
        $html .= '<div class="circle2"></div>';
        $html .= '<div class="circle3"></div>';
        $html .= '<div class="circle4"></div>';
        $html .= '</div>';
        $html .= '</div>';
        return $html;
    }
}

if(!function_exists('edgt_loading_spinner_atom')) {
    function edgt_loading_spinner_atom(){
        $html = '';
        $html .= '<div class="atom">';
        $html .= '<div class="ball ball-1"></div>';
		$html .= '<div class="ball ball-2"></div>';
		$html .= '<div class="ball ball-3"></div>';
		$html .= '<div class="ball ball-4"></div>';
        $html .= '</div>';
        return $html;
    }
}

if(!function_exists('edgt_loading_spinner_clock')) {
    function edgt_loading_spinner_clock(){
        $html = '';
        $html .= '<div class="clock">';
        $html .= '<div class="ball ball-1"></div>';
		$html .= '<div class="ball ball-2"></div>';
		$html .= '<div class="ball ball-3"></div>';
		$html .= '<div class="ball ball-4"></div>';
        $html .= '</div>';
        return $html;
    }
}

if(!function_exists('edgt_loading_spinner_mitosis')) {
    function edgt_loading_spinner_mitosis(){
        $html = '';
        $html .= '<div class="mitosis">';
        $html .= '<div class="ball ball-1"></div>';
		$html .= '<div class="ball ball-2"></div>';
		$html .= '<div class="ball ball-3"></div>';
		$html .= '<div class="ball ball-4"></div>';
        $html .= '</div>';
        return $html;
    }
}

if(!function_exists('edgt_loading_spinner_lines')) {
    function edgt_loading_spinner_lines(){
        $html = '';
        $html .= '<div class="lines">';
        $html .= '<div class="line1"></div>';
		$html .= '<div class="line2"></div>';
		$html .= '<div class="line3"></div>';
		$html .= '<div class="line4"></div>';
        $html .= '</div>';
        return $html;
    }
}

if(!function_exists('edgt_loading_spinner_fussion')) {
    function edgt_loading_spinner_fussion(){
        $html = '';
        $html .= '<div class="fussion">';
        $html .= '<div class="ball ball-1"></div>';
		$html .= '<div class="ball ball-2"></div>';
		$html .= '<div class="ball ball-3"></div>';
		$html .= '<div class="ball ball-4"></div>';
        $html .= '</div>';
        return $html;
    }
}

if(!function_exists('edgt_loading_spinner_wave_circles')) {
    function edgt_loading_spinner_wave_circles(){
        $html = '';
        $html .= '<div class="wave_circles">';
        $html .= '<div class="ball ball-1"></div>';
		$html .= '<div class="ball ball-2"></div>';
		$html .= '<div class="ball ball-3"></div>';
		$html .= '<div class="ball ball-4"></div>';
        $html .= '</div>';
        return $html;
    }
}

if(!function_exists('edgt_loading_spinner_pulse_circles')) {
    function edgt_loading_spinner_pulse_circles(){
        $html = '';
        $html .= '<div class="pulse_circles">';
        $html .= '<div class="ball ball-1"></div>';
		$html .= '<div class="ball ball-2"></div>';
		$html .= '<div class="ball ball-3"></div>';
		$html .= '<div class="ball ball-4"></div>';
        $html .= '</div>';
        return $html;
    }
}


if(!function_exists('edgt_loading_spinner_line')) {
    function edgt_loading_spinner_line(){
        $html = '';
        $html .= '<div class="line_loader">';
        $html .= '</div>';
        return $html;
    }
}

if(!function_exists('edgt_loading_spinner_wide_line')) {
    function edgt_loading_spinner_wide_line(){
        $html = '';
        $html .= '<div class="wide_line_loader">';
        $html .= '</div>';
        return $html;
    }
}