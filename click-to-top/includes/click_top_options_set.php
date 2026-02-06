<?php
/*
 * @link              https://wpthemespace.com/
 * @since             1.0.0
 * @package           Click to top
 *
 * @wordpress-plugin
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Generate dynamic CSS based on plugin options
 * 
 * @since 1.2.27
 * @return string CSS string
 */
function click_to_top_get_dynamic_css() {
    $options = get_option('click_top_basic', array());
    $sstyle = get_option('click_top_style', array());
    
    // Basic options
    $scroll_position = isset($options['scroll_position']) ? $options['scroll_position'] : 'right';
    $selected_position = isset($options['selected_position']) ? absint($options['selected_position']) : 5;
    $bottom_position = isset($options['bottom_position']) ? absint($options['bottom_position']) : 5;
    
    // Mobile visibility option
    $mobile_visibility = isset($options['mobile_visibility']) ? $options['mobile_visibility'] : 'show';
    
    // Tablet visibility option
    $tablet_visibility = isset($options['tablet_visibility']) ? $options['tablet_visibility'] : 'show';
    
    // Responsive button sizes
    $desktop_button_size = isset($options['desktop_button_size']) ? absint($options['desktop_button_size']) : 45;
    $tablet_button_size = isset($options['tablet_button_size']) ? absint($options['tablet_button_size']) : 35;
    $mobile_button_size = isset($options['mobile_button_size']) ? absint($options['mobile_button_size']) : 30;
    
    // Touch-friendly tap area
    $touch_tap_area = isset($options['touch_tap_area']) ? $options['touch_tap_area'] : 'enable';
    $tap_area_size = isset($options['tap_area_size']) ? absint($options['tap_area_size']) : 10;
    
    // Progress indicator options
    $progress_indicator = isset($options['progress_indicator']) ? $options['progress_indicator'] : 'enable';
    $progress_color = isset($options['progress_color']) ? sanitize_hex_color($options['progress_color']) : '#3498db';
    $progress_width = isset($options['progress_width']) ? absint($options['progress_width']) : 3;
    
    // Style options
    $btn_type = isset($sstyle['btn_type']) ? $sstyle['btn_type'] : 'icon';
    $scroll_padding = isset($sstyle['scroll_padding']) ? absint($sstyle['scroll_padding']) : 5;
    $btn_style = isset($sstyle['btn_style']) ? $sstyle['btn_style'] : 'square';
    $icon_color = isset($sstyle['icon_color']) ? sanitize_hex_color($sstyle['icon_color']) : '#000000';
    $bg_color = isset($sstyle['bg_color']) ? sanitize_hex_color($sstyle['bg_color']) : '#cccccc';
    $bg_hover_color = isset($sstyle['bg_hover_color']) ? sanitize_hex_color($sstyle['bg_hover_color']) : '#555555';
    $hover_color = isset($sstyle['hover_color']) ? sanitize_hex_color($sstyle['hover_color']) : '#ffffff';
    $scroll_opacity = isset($sstyle['scroll_opacity']) ? absint($sstyle['scroll_opacity']) : 99;
    $font_size = isset($sstyle['font_size']) ? absint($sstyle['font_size']) : 16;
    
    // Border radius based on style
    $border_radius = ($btn_style == 'round') ? '30px' : '0';
    
    // Min dimensions for icon type
    $min_dimensions = ($btn_type == 'icon') ? 'min-height: 34px; min-width: 35px;' : '';
    
    $css = "
        a#clickTop {
            background: {$bg_color} none repeat scroll 0 0;
            border-radius: {$border_radius};
            bottom: {$bottom_position}%;
            color: {$icon_color};
            padding: {$scroll_padding}px;
            {$scroll_position}: {$selected_position}%;
            {$min_dimensions}
            font-size: {$font_size}px;
            opacity: 0.{$scroll_opacity};
        }
        a#clickTop i {
            color: {$icon_color};
        }
        a#clickTop svg,
        a#clickTop .ctt-icon {
            fill: {$icon_color};
        }
        a#clickTop:hover,
        a#clickTop:hover i,
        a#clickTop:hover svg,
        a#clickTop:hover .ctt-icon,
        a#clickTop:active,
        a#clickTop:focus {
            color: {$hover_color};
            fill: {$hover_color};
        }
        .hvr-fade:hover,
        .hvr-fade:focus,
        .hvr-fade:active,
        .hvr-back-pulse:hover,
        .hvr-back-pulse:focus,
        .hvr-back-pulse:active,
        a#clickTop.hvr-shrink:hover,
        a#clickTop.hvr-grow:hover,
        a#clickTop.hvr-pulse:hover,
        a#clickTop.hvr-pulse-grow:hover,
        a#clickTop.hvr-pulse-shrink:hover,
        a#clickTop.hvr-push:hover,
        a#clickTop.hvr-pop:hover,
        a#clickTop.hvr-bounce-in:hover,
        a#clickTop.hvr-bounce-out:hover,
        a#clickTop.hvr-float:hover,
        a#clickTop.hvr-fade:hover,
        a#clickTop.hvr-back-pulse:hover,
        a#clickTop.hvr-bob:hover,
        a#clickTop.hvr-buzz:hover,
        a#clickTop.hvr-shadow:hover,
        a#clickTop.hvr-grow-shadow:hover,
        a#clickTop.hvr-float-shadow:hover,
        a#clickTop.hvr-glow:hover,
        a#clickTop.hvr-shadow-radial:hover,
        a#clickTop.hvr-box-shadow-outset:hover,
        a#clickTop.hvr-box-shadow-inset:hover,
        a#clickTop.hvr-bubble-top:hover,
        a#clickTop.hvr-bubble-float-top:hover,
        .hvr-radial-out:before,
        .hvr-radial-in:before,
        .hvr-bounce-to-right:before,
        .hvr-bounce-to-left:before,
        .hvr-bounce-to-bottom:before,
        .hvr-bounce-to-top:before,
        .hvr-rectangle-in:before,
        .hvr-rectangle-out:before,
        .hvr-shutter-in-horizontal:before,
        .hvr-shutter-out-horizontal:before,
        .hvr-shutter-in-vertical:before,
        .hvr-sweep-to-right:before,
        .hvr-sweep-to-left:before,
        .hvr-sweep-to-bottom:before,
        .hvr-sweep-to-top:before,
        .hvr-shutter-out-vertical:before,
        .hvr-underline-from-left:before,
        .hvr-underline-from-center:before,
        .hvr-underline-from-right:before,
        .hvr-overline-from-left:before,
        .hvr-overline-from-center:before,
        .hvr-overline-from-right:before,
        .hvr-underline-reveal:before,
        .hvr-overline-reveal:before {
            background-color: {$bg_hover_color};
            color: {$hover_color};
            border-radius: {$border_radius};
        }
        @-webkit-keyframes hvr-back-pulse {
            50% { background-color: {$bg_color}; }
        }
        @keyframes hvr-back-pulse {
            50% { background-color: {$bg_color}; }
        }
        .hvr-radial-out,
        .hvr-radial-in,
        .hvr-rectangle-in,
        .hvr-rectangle-out,
        .hvr-shutter-in-horizontal,
        .hvr-shutter-out-horizontal,
        .hvr-shutter-in-vertical,
        .hvr-shutter-out-vertical {
            background-color: {$bg_color};
        }
        .hvr-bubble-top::before,
        .hvr-bubble-float-top::before {
            border-color: transparent transparent {$bg_color};
        }
    ";
    
    // Add mobile visibility CSS
    if ($mobile_visibility === 'hide') {
        $css .= "
        @media screen and (max-width: 767px) {
            a#clickTop,
            #clickTop-progress-wrap {
                display: none !important;
            }
        }
        ";
    }
    
    // Add tablet visibility CSS
    if ($tablet_visibility === 'hide') {
        $css .= "
        @media screen and (min-width: 768px) and (max-width: 1024px) {
            a#clickTop,
            #clickTop-progress-wrap {
                display: none !important;
            }
        }
        ";
    }
    
    // Add responsive button sizes CSS
    $css .= "
        /* Desktop button size */
        @media screen and (min-width: 1025px) {
            a#clickTop {
                min-width: {$desktop_button_size}px !important;
                min-height: {$desktop_button_size}px !important;
                display: flex;
                align-items: center;
                justify-content: center;
            }
            a#clickTop svg,
            a#clickTop .ctt-icon {
                width: " . ($desktop_button_size * 0.5) . "px;
                height: " . ($desktop_button_size * 0.5) . "px;
            }
            /* Progress indicator desktop size */
            #clickTop-progress-wrap {
                width: {$desktop_button_size}px !important;
                height: {$desktop_button_size}px !important;
            }
            #clickTop-progress-wrap .ctt-progress-icon svg {
                width: " . ($desktop_button_size * 0.4) . "px;
                height: " . ($desktop_button_size * 0.4) . "px;
            }
        }
        
        /* Tablet button size */
        @media screen and (min-width: 768px) and (max-width: 1024px) {
            a#clickTop {
                min-width: {$tablet_button_size}px !important;
                min-height: {$tablet_button_size}px !important;
                display: flex;
                align-items: center;
                justify-content: center;
            }
            a#clickTop svg,
            a#clickTop .ctt-icon {
                width: " . ($tablet_button_size * 0.5) . "px;
                height: " . ($tablet_button_size * 0.5) . "px;
            }
            /* Progress indicator tablet size */
            #clickTop-progress-wrap {
                width: {$tablet_button_size}px !important;
                height: {$tablet_button_size}px !important;
            }
            #clickTop-progress-wrap .ctt-progress-icon svg {
                width: " . ($tablet_button_size * 0.4) . "px;
                height: " . ($tablet_button_size * 0.4) . "px;
            }
        }
        
        /* Mobile button size */
        @media screen and (max-width: 767px) {
            a#clickTop {
                min-width: {$mobile_button_size}px !important;
                min-height: {$mobile_button_size}px !important;
                display: flex;
                align-items: center;
                justify-content: center;
            }
            a#clickTop svg,
            a#clickTop .ctt-icon {
                width: " . ($mobile_button_size * 0.5) . "px;
                height: " . ($mobile_button_size * 0.5) . "px;
            }
            /* Progress indicator mobile size */
            #clickTop-progress-wrap {
                width: {$mobile_button_size}px !important;
                height: {$mobile_button_size}px !important;
            }
            #clickTop-progress-wrap .ctt-progress-icon svg {
                width: " . ($mobile_button_size * 0.4) . "px;
                height: " . ($mobile_button_size * 0.4) . "px;
            }
        }
    ";
    
    // Add touch-friendly tap area CSS
    if ($touch_tap_area === 'enable') {
        $css .= "
        /* Touch-friendly tap area for mobile and tablet */
        @media screen and (max-width: 1024px) {
            a#clickTop {
                position: relative;
            }
            a#clickTop::before {
                content: '';
                position: absolute;
                top: -{$tap_area_size}px;
                left: -{$tap_area_size}px;
                right: -{$tap_area_size}px;
                bottom: -{$tap_area_size}px;
                background: transparent;
            }
            #clickTop-progress-wrap {
                position: relative;
            }
            #clickTop-progress-wrap::before {
                content: '';
                position: absolute;
                top: -{$tap_area_size}px;
                left: -{$tap_area_size}px;
                right: -{$tap_area_size}px;
                bottom: -{$tap_area_size}px;
                background: transparent;
                z-index: 1;
            }
        }
        ";
    }
    
    // Add progress indicator CSS
    if ($progress_indicator === 'enable') {
        $progress_size = 50 + ($scroll_padding * 2);
        $css .= "
        #clickTop-progress-wrap {
            position: fixed;
            {$scroll_position}: {$selected_position}%;
            bottom: {$bottom_position}%;
            height: {$progress_size}px;
            width: {$progress_size}px;
            cursor: pointer;
            display: block;
            border-radius: 50%;
            box-shadow: inset 0 0 0 2px rgba(0,0,0,0.1);
            z-index: 2147483646;
            opacity: 0;
            visibility: hidden;
            transform: translateY(15px);
            transition: all 200ms linear;
        }
        #clickTop-progress-wrap.ctt-progress-active {
            opacity: 0.{$scroll_opacity};
            visibility: visible;
            transform: translateY(0);
        }
        #clickTop-progress-wrap::after {
            position: absolute;
            content: '';
            background-color: {$bg_color};
            left: {$progress_width}px;
            top: {$progress_width}px;
            right: {$progress_width}px;
            bottom: {$progress_width}px;
            border-radius: 50%;
            display: block;
            z-index: -1;
        }
        #clickTop-progress-wrap:hover::after {
            background-color: {$bg_hover_color};
        }
        #clickTop-progress-wrap svg.ctt-progress-circle path {
            fill: none;
        }
        #clickTop-progress-wrap svg.ctt-progress-circle path.ctt-progress-bar {
            stroke: {$progress_color};
            stroke-width: {$progress_width};
            box-sizing: border-box;
            transition: all 200ms linear;
        }
        #clickTop-progress-wrap .ctt-progress-icon {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            font-size: {$font_size}px;
            color: {$icon_color};
            fill: {$icon_color};
        }
        #clickTop-progress-wrap:hover .ctt-progress-icon {
            color: {$hover_color};
            fill: {$hover_color};
        }
        #clickTop-progress-wrap .ctt-progress-icon svg {
            width: 1em;
            height: 1em;
            display: block;
        }
        ";
    }
    
    return $css;
}

/**
 * Generate dynamic JS configuration based on plugin options
 * 
 * @since 1.2.27
 * @return string JS string
 */
function click_to_top_get_dynamic_js() {
    $options = get_option('click_top_basic', array());
    $sstyle = get_option('click_top_style', array());
    
    // Basic options
    $scroll_distance = isset($options['scroll_Distance']) ? absint($options['scroll_Distance']) : 300;
    $scroll_speed = isset($options['scroll_Speed']) ? absint($options['scroll_Speed']) : 300;
    $easing_type = isset($options['easing_Type']) ? sanitize_text_field($options['easing_Type']) : 'linear';
    $animation = isset($options['ani_mation']) ? sanitize_text_field($options['ani_mation']) : 'fade';
    $animation_speed = isset($options['animation_Speed']) ? absint($options['animation_Speed']) : 200;
    
    // Progress indicator option
    $progress_indicator = isset($options['progress_indicator']) ? $options['progress_indicator'] : 'enable';
    
    // Style options
    $hover_affect = isset($sstyle['hover_affect']) ? sanitize_text_field($sstyle['hover_affect']) : 'bubble-top';
    $btn_type = isset($sstyle['btn_type']) ? $sstyle['btn_type'] : 'icon';
    $select_icon = isset($sstyle['select_icon']) ? sanitize_text_field($sstyle['select_icon']) : 'angle-up';
    $btn_text = isset($sstyle['btn_text']) ? sanitize_text_field($sstyle['btn_text']) : esc_html__('Click to top', 'click-to-top');
    
    // Get scroll text (SVG icon or text)
    if ($btn_type == 'icon' && function_exists('click_to_top_get_svg_icon')) {
        $scroll_text = click_to_top_get_svg_icon($select_icon);
    } else {
        $scroll_text = esc_html($btn_text);
    }
    
    // Escape for JS
    $scroll_text = str_replace("'", "\\'", $scroll_text);
    $scroll_text = str_replace(array("\n", "\r"), '', $scroll_text);
    
    // Check if progress indicator is enabled
    if ($progress_indicator === 'enable') {
        // Progress indicator JS - hides default scrollUp button
        $js = "(function($) {
            'use strict';
            $(document).ready(function() {
                // Create progress indicator HTML
                var progressHTML = '<div id=\"clickTop-progress-wrap\"><svg class=\"ctt-progress-circle\" width=\"100%\" height=\"100%\" viewBox=\"-1 -1 102 102\"><path class=\"ctt-progress-bar\" d=\"M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98\" style=\"transition: stroke-dashoffset 10ms linear; stroke-dasharray: 307.919, 307.919; stroke-dashoffset: 307.919;\"></path></svg><span class=\"ctt-progress-icon\">{$scroll_text}</span></div>';
                $('body').append(progressHTML);
                
                var progressWrap = $('#clickTop-progress-wrap');
                var progressPath = progressWrap.find('.ctt-progress-bar');
                var pathLength = progressPath.get(0).getTotalLength();
                
                progressPath.css({
                    'stroke-dasharray': pathLength + ' ' + pathLength,
                    'stroke-dashoffset': pathLength
                });
                
                // Update progress on scroll
                $(window).on('scroll', function() {
                    var scroll = $(window).scrollTop();
                    var height = $(document).height() - $(window).height();
                    var progress = pathLength - (scroll * pathLength / height);
                    progressPath.css('stroke-dashoffset', progress);
                    
                    // Show/hide based on scroll distance
                    if (scroll > {$scroll_distance}) {
                        progressWrap.addClass('ctt-progress-active');
                    } else {
                        progressWrap.removeClass('ctt-progress-active');
                    }
                });
                
                // Scroll to top on click
                progressWrap.on('click', function(e) {
                    e.preventDefault();
                    $('html, body').animate({scrollTop: 0}, {$scroll_speed}, '{$easing_type}');
                    return false;
                });
            });
        }(jQuery));";
    } else {
        // Standard scrollUp JS
        $js = "(function($) {
            'use strict';
            $(document).ready(function() {
                $.scrollUp({
                    scrollName: 'clickTop',
                    scrollDistance: {$scroll_distance},
                    scrollFrom: 'top',
                    scrollSpeed: {$scroll_speed},
                    easingType: '{$easing_type}',
                    animation: '{$animation}',
                    animationSpeed: {$animation_speed},
                    scrollText: '{$scroll_text}',
                    activeOverlay: false,
                    zIndex: 2147483647
                });
                \$('a#clickTop').addClass('hvr-{$hover_affect}');
            });
        }(jQuery));";
    }
    
    return $js;
}

/**
 * Add inline CSS using wp_add_inline_style
 * 
 * @since 1.2.27
 */
function click_to_top_enqueue_dynamic_css() {
    $css = click_to_top_get_dynamic_css();
    wp_add_inline_style('click-to-top-style', $css);
}
add_action('wp_enqueue_scripts', 'click_to_top_enqueue_dynamic_css', 20);

/**
 * Add inline JS using wp_add_inline_script
 * 
 * @since 1.2.27
 */
function click_to_top_enqueue_dynamic_js() {
    $js = click_to_top_get_dynamic_js();
    wp_add_inline_script('click-to-top-scrollUp', $js);
}
add_action('wp_enqueue_scripts', 'click_to_top_enqueue_dynamic_js', 20);
