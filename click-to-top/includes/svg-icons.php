<?php
/**
 * SVG Icons for Click to Top
 * 
 * @since 1.2.27
 * @package Click to top
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Get SVG icon markup
 * 
 * @param string $icon_name The icon name
 * @return string SVG markup
 */
function click_to_top_get_svg_icon($icon_name) {
    $icons = array(
        'angle-double-up' => '<svg class="ctt-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512" aria-hidden="true" focusable="false"><path fill="currentColor" d="M177 111L297 231c9.4 9.4 9.4 24.6 0 34s-24.6 9.4-34 0L160 162l-103 103c-9.4 9.4-24.6 9.4-34 0s-9.4-24.6 0-34L143 111c9.4-9.4 24.6-9.4 34 0zm-34 192L23 423c-9.4 9.4-9.4 24.6 0 34s24.6 9.4 34 0l103-103 103 103c9.4 9.4 24.6 9.4 34 0s9.4-24.6 0-34L177 303c-9.4-9.4-24.6-9.4-34 0z"/></svg>',
        
        'angle-up' => '<svg class="ctt-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" aria-hidden="true" focusable="false"><path fill="currentColor" d="M201.4 137.4c12.5-12.5 32.8-12.5 45.3 0l160 160c12.5 12.5 12.5 32.8 0 45.3s-32.8 12.5-45.3 0L224 205.3 86.6 342.6c-12.5 12.5-32.8 12.5-45.3 0s-12.5-32.8 0-45.3l160-160z"/></svg>',
        
        'arrow-circle-o-up' => '<svg class="ctt-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" aria-hidden="true" focusable="false"><path fill="currentColor" d="M256 48a208 208 0 1 1 0 416 208 208 0 1 1 0-416zm0 464A256 256 0 1 0 256 0a256 256 0 1 0 0 512zM135.1 217.4l107.1-99.9c3.8-3.5 8.7-5.5 13.8-5.5s10.1 2 13.8 5.5l107.1 99.9c4.2 3.9 6.1 9.7 5 15.3s-5.1 10.2-10.4 12.1s-11.3 .9-15.5-3l-76-70.8V360c0 13.3-10.7 24-24 24s-24-10.7-24-24V171.1l-76 70.8c-4.3 4-10.2 4.9-15.5 3s-9.4-6.5-10.4-12.1s.8-11.4 5-15.3z"/></svg>',
        
        'arrow-circle-up' => '<svg class="ctt-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" aria-hidden="true" focusable="false"><path fill="currentColor" d="M256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512zM135.1 217.4l107.1-99.9c3.8-3.5 8.7-5.5 13.8-5.5s10.1 2 13.8 5.5l107.1 99.9c4.2 3.9 6.1 9.7 5 15.3s-5.1 10.2-10.4 12.1s-11.3 .9-15.5-3l-76-70.8V360c0 13.3-10.7 24-24 24s-24-10.7-24-24V171.1l-76 70.8c-4.3 4-10.2 4.9-15.5 3s-9.4-6.5-10.4-12.1s.8-11.4 5-15.3z"/></svg>',
        
        'arrow-up' => '<svg class="ctt-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512" aria-hidden="true" focusable="false"><path fill="currentColor" d="M214.6 41.4c-12.5-12.5-32.8-12.5-45.3 0l-160 160c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L160 141.2V448c0 17.7 14.3 32 32 32s32-14.3 32-32V141.2L329.4 246.6c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3l-160-160z"/></svg>',
        
        'caret-square-o-up' => '<svg class="ctt-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" aria-hidden="true" focusable="false"><path fill="currentColor" d="M64 80c-8.8 0-16 7.2-16 16V416c0 8.8 7.2 16 16 16H384c8.8 0 16-7.2 16-16V96c0-8.8-7.2-16-16-16H64zM0 96C0 60.7 28.7 32 64 32H384c35.3 0 64 28.7 64 64V416c0 35.3-28.7 64-64 64H64c-35.3 0-64-28.7-64-64V96zm224 64c6.7 0 13 2.8 17.6 7.7l104 112c6.5 7 8.2 17.2 4.4 25.9s-12.5 14.4-22 14.4H120c-9.5 0-18.2-5.7-22-14.4s-2.1-18.9 4.4-25.9l104-112c4.5-4.9 10.9-7.7 17.6-7.7z"/></svg>',
        
        'caret-up' => '<svg class="ctt-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512" aria-hidden="true" focusable="false"><path fill="currentColor" d="M182.6 137.4c-12.5-12.5-32.8-12.5-45.3 0l-128 128c-9.2 9.2-11.9 22.9-6.9 34.9s16.6 19.8 29.6 19.8H288c12.9 0 24.6-7.8 29.6-19.8s2.2-25.7-6.9-34.9l-128-128z"/></svg>',
        
        'chevron-circle-up' => '<svg class="ctt-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" aria-hidden="true" focusable="false"><path fill="currentColor" d="M256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512zM135.1 313l113-113c9.4-9.4 24.6-9.4 33.9 0l113 113c9.4 9.4 9.4 24.6 0 33.9s-24.6 9.4-33.9 0l-96-96-96 96c-9.4 9.4-24.6 9.4-33.9 0s-9.4-24.6 0-33.9z"/></svg>',
        
        'chevron-up' => '<svg class="ctt-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" aria-hidden="true" focusable="false"><path fill="currentColor" d="M233.4 105.4c12.5-12.5 32.8-12.5 45.3 0l192 192c12.5 12.5 12.5 32.8 0 45.3s-32.8 12.5-45.3 0L256 173.3 86.6 342.6c-12.5 12.5-32.8 12.5-45.3 0s-12.5-32.8 0-45.3l192-192z"/></svg>',
        
        'hand-o-up' => '<svg class="ctt-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" aria-hidden="true" focusable="false"><path fill="currentColor" d="M128 40c0-22.1 17.9-40 40-40s40 17.9 40 40V188.2c8.5-7.6 19.7-12.2 32-12.2c25.3 0 46 19.5 47.9 44.3c8.5-7.7 19.8-12.3 32.1-12.3c25.3 0 46 19.5 47.9 44.3c8.5-7.7 19.8-12.3 32.1-12.3c26.5 0 48 21.5 48 48v48 16 48c0 70.7-57.3 128-128 128l-16 0H240l-.1 0h-5.2c-5 0-9.9-.3-14.7-1c-55.3-5.6-106.2-34-140-79L80 448c-10.3-14.4-6.9-34.4 7.4-44.6s34.4-6.9 44.6 7.4l21.7 30.4c8.5 11.8 21.4 19.6 35.7 22.1c.4 0 .8 .1 1.2 .1H240h16c35.3 0 64-28.7 64-64V336 288 240c0-8.8-7.2-16-16-16s-16 7.2-16 16v48c0 17.7-14.3 32-32 32s-32-14.3-32-32V240c0-8.8-7.2-16-16-16s-16 7.2-16 16v48c0 17.7-14.3 32-32 32s-32-14.3-32-32V176 40z"/></svg>',
        
        'hand-pointer-o' => '<svg class="ctt-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" aria-hidden="true" focusable="false"><path fill="currentColor" d="M128 40c0-22.1 17.9-40 40-40s40 17.9 40 40V188.2c8.5-7.6 19.7-12.2 32-12.2c20.6 0 38.2 13 45 31.2c8.8-9.3 21.2-15.2 35-15.2c25.3 0 46 19.5 47.9 44.3c8.5-7.7 19.8-12.3 32.1-12.3c26.5 0 48 21.5 48 48v48 16 48c0 70.7-57.3 128-128 128l-16 0H240l-.1 0h-5.2c-5 0-9.9-.3-14.7-1c-55.3-5.6-106.2-34-140-79L80 448c-10.3-14.4-6.9-34.4 7.4-44.6s34.4-6.9 44.6 7.4l21.7 30.4c8.5 11.8 21.4 19.6 35.7 22.1c.4 0 .8 .1 1.2 .1H240h16c35.3 0 64-28.7 64-64V336 288 272c0-8.8-7.2-16-16-16s-16 7.2-16 16v16c0 17.7-14.3 32-32 32s-32-14.3-32-32V256 240c0-8.8-7.2-16-16-16s-16 7.2-16 16v16c0 17.7-14.3 32-32 32s-32-14.3-32-32V176 40z"/></svg>',
        
        'long-arrow-up' => '<svg class="ctt-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512" aria-hidden="true" focusable="false"><path fill="currentColor" d="M182.6 9.4c-12.5-12.5-32.8-12.5-45.3 0l-96 96c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L128 109.3V480c0 17.7 14.3 32 32 32s32-14.3 32-32V109.3l41.4 41.4c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3l-96-96z"/></svg>',
        
        'toggle-up' => '<svg class="ctt-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512" aria-hidden="true" focusable="false"><path fill="currentColor" d="M169.4 137.4c12.5-12.5 32.8-12.5 45.3 0l160 160c12.5 12.5 12.5 32.8 0 45.3s-32.8 12.5-45.3 0L192 205.3 54.6 342.6c-12.5 12.5-32.8 12.5-45.3 0s-12.5-32.8 0-45.3l160-160z"/></svg>',
    );

    $icon_name = sanitize_text_field($icon_name);
    
    if (isset($icons[$icon_name])) {
        return $icons[$icon_name];
    }
    
    // Default fallback to angle-up
    return $icons['angle-up'];
}

/**
 * Get all available icons for admin selection
 * 
 * @return array Array of icon options
 */
function click_to_top_get_icon_options() {
    return array(
        'angle-double-up'   => esc_html__('Angle Double Up', 'click-to-top'),
        'angle-up'          => esc_html__('Angle Up', 'click-to-top'),
        'arrow-circle-o-up' => esc_html__('Arrow Circle Outline Up', 'click-to-top'),
        'arrow-circle-up'   => esc_html__('Arrow Circle Up', 'click-to-top'),
        'arrow-up'          => esc_html__('Arrow Up', 'click-to-top'),
        'caret-square-o-up' => esc_html__('Caret Square Outline Up', 'click-to-top'),
        'caret-up'          => esc_html__('Caret Up', 'click-to-top'),
        'chevron-circle-up' => esc_html__('Chevron Circle Up', 'click-to-top'),
        'chevron-up'        => esc_html__('Chevron Up', 'click-to-top'),
        'hand-o-up'         => esc_html__('Hand Up', 'click-to-top'),
        'hand-pointer-o'    => esc_html__('Hand Pointer', 'click-to-top'),
        'long-arrow-up'     => esc_html__('Long Arrow Up', 'click-to-top'),
        'toggle-up'         => esc_html__('Toggle Up', 'click-to-top'),
    );
}
