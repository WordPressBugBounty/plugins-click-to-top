<?php

/**
 * @link              https://wpthemespace.com/
 * @since             1.0.0
 * @package           Click to top
 *
 * @author expert-wp
 */
if (!class_exists('click_top_options')) :
    class click_top_options
    {

        private $settings_api;

        function __construct()
        {
            $this->settings_api = new WeDevs_Settings_API;

            add_action('admin_init', array($this, 'admin_init'));
            add_action('admin_menu', array($this, 'admin_menu'));
            
            // AJAX handlers for plugin install/activate
            add_action( 'wp_ajax_ctt_install_plugin', array( $this, 'ajax_install_plugin' ) );
            add_action( 'wp_ajax_ctt_activate_plugin', array( $this, 'ajax_activate_plugin' ) );
        }

        function admin_init()
        {

            //set the settings
            $this->settings_api->set_sections($this->get_settings_sections());
            $this->settings_api->set_fields($this->get_settings_fields());

            //initialize settings
            $this->settings_api->admin_init();
        }

        function admin_menu()
        {
            add_options_page(
                esc_html__('Click to top', 'click-to-top'),
                esc_html__('Click to top', 'click-to-top'),
                'manage_options',
                'click-to-top.php',
                array($this, 'plugin_page')
            );
        }

        function get_settings_sections()
        {
            $sections = array(
                array(
                    'id'    => 'click_top_basic',
                    'title' => esc_html__('Basic Settings', 'click-to-top'),
                    'icon'  => 'dashicons-admin-generic'
                ),
                array(
                    'id'    => 'click_top_style',
                    'title' => esc_html__('Style Settings', 'click-to-top'),
                    'icon'  => 'dashicons-art'
                ),
                array(
                    'id'       => 'click_top_plugins',
                    'title'    => esc_html__('Recommended Plugins', 'click-to-top'),
                    'icon'     => 'dashicons-plugins-checked',
                    'callback' => array( $this, 'render_recommended_plugins_content' )
                )
            );
            return $sections;
        }

        /**
         * Returns all the settings fields
         *
         * @return array settings fields
         */
        function get_settings_fields()
        {
            $settings_fields = array(
                'click_top_basic' => array(
                    array(
                        'name'    => 'scroll_Distance',
                        'label'   => esc_html__('Scroll show distance', 'click-to-top'),
                        'desc'    => esc_html__('Distance from top/bottom before showing element (px)', 'click-to-top'),
                        'type'              => 'number',
                        'default'           => 300,
                        'sanitize_callback' => 'intval'

                    ),
                    array(
                        'name'    => 'scroll_Speed',
                        'label'   => esc_html__('Set scroll speed', 'click-to-top'),
                        'desc'    => esc_html__('Speed back to top (ms)', 'click-to-top'),
                        'type'              => 'number',
                        'default'           => 300,
                        'sanitize_callback' => 'intval'
                    ),
                    array(
                        'name'    => 'easing_Type',
                        'label'   => esc_html__('Select your easing type', 'click-to-top'),
                        'desc'    => esc_html__('Scroll to top easing style set as you choice', 'click-to-top'),
                        'type'    => 'select',
                        'default' => 'linear',
                        'options' => array(
                            'linear' => esc_html__('linear', 'click-to-top'),
                            'easeInSine' => esc_html__('easeInSine', 'click-to-top'),
                            'easeOutSine' => esc_html__('easeOutSine', 'click-to-top'),
                            'easeInOutSine' => esc_html__('easeInOutSine', 'click-to-top'),
                            'easeInQuad' => esc_html__('easeInQuad', 'click-to-top'),
                            'easeOutQuad' => esc_html__('easeOutQuad', 'click-to-top'),
                            'easeInOutQuad' => esc_html__('easeInOutQuad', 'click-to-top'),
                            'easeInCubic' => esc_html__('easeInCubic', 'click-to-top'),
                            'easeOutCubic' => esc_html__('easeOutCubic', 'click-to-top'),
                            'easeInOutCubic' => esc_html__('easeInOutCubic', 'click-to-top'),
                            'easeInQuart' => esc_html__('easeInQuart', 'click-to-top'),
                            'easeOutQuart' => esc_html__('easeOutQuart', 'click-to-top'),
                            'easeInOutQuart' => esc_html__('easeInOutQuart', 'click-to-top'),
                            'easeInQuint' => esc_html__('easeInQuint', 'click-to-top'),
                            'easeOutQuint' => esc_html__('easeOutQuint', 'click-to-top'),
                            'easeInOutQuint' => esc_html__('easeInOutQuint', 'click-to-top'),
                            'easeInExpo' => esc_html__('easeInExpo', 'click-to-top'),
                            'easeOutExpo' => esc_html__('easeOutExpo', 'click-to-top'),
                            'easeInOutExpo' => esc_html__('easeInOutExpo', 'click-to-top'),
                            'easeInCirc' => esc_html__('easeInCirc', 'click-to-top'),
                            'easeOutCirc' => esc_html__('easeOutCirc', 'click-to-top'),
                            'easeInOutCirc' => esc_html__('easeInOutCirc', 'click-to-top'),
                            'easeInBack' => esc_html__('easeInBack', 'click-to-top'),
                            'easeOutBack' => esc_html__('easeOutBack', 'click-to-top'),
                            'easeInOutBack' => esc_html__('easeInOutBack', 'click-to-top'),
                            'easeInElastic' => esc_html__('easeInElastic', 'click-to-top'),
                            'easeOutElastic' => esc_html__('easeOutElastic', 'click-to-top'),
                            'easeInOutElastic' => esc_html__('easeInOutElastic', 'click-to-top'),
                            'easeInBounce' => esc_html__('easeInBounce', 'click-to-top'),
                            'easeOutBounce' => esc_html__('easeOutBounce', 'click-to-top'),
                            'easeInOutBounce' => esc_html__('easeInOutBounce', 'click-to-top'),
                        )
                    ),
                    array(
                        'name'    => 'ani_mation',
                        'label'   => esc_html__('Select animation', 'click-to-top'),
                        'desc'    => esc_html__('Select animation in this box.', 'click-to-top'),
                        'type'    => 'radio',
                        'default' => 'fade',
                        'options' => array(
                            'fade' => esc_html__('Fade', 'click-to-top'),
                            'slide' => esc_html__('slide', 'click-to-top'),
                            'none' => esc_html__('none', 'click-to-top'),
                        )
                    ),
                    array(
                        'name'    => 'animation_Speed',
                        'label'   => esc_html__('Set Animation speed', 'click-to-top'),
                        'desc'    => esc_html__('Set Animation speed by (ms)', 'click-to-top'),
                        'type'              => 'number',
                        'default'           => 200,
                        'sanitize_callback' => 'intval'
                    ),
                    array(
                        'name'    => 'scroll_position',
                        'label'   => esc_html__('scroll position', 'click-to-top'),
                        'desc'    => esc_html__('Select scroll position left or right.', 'click-to-top'),
                        'type'    => 'radio',
                        'default' => 'right',
                        'options' => array(
                            'left' => esc_html__('Left side', 'click-to-top'),
                            'right' => esc_html__('Right side', 'click-to-top')
                        )
                    ),
                    array(
                        'name'    => 'selected_position',
                        'label'   => esc_html__('Set selected position margin', 'click-to-top'),
                        'desc'    => esc_html__('If you select right side set right side margin and if you select left side set left side margin by %.Set 0 to 5 for better view.default is 5', 'click-to-top'),
                        'type'              => 'number',
                        'default'           => 5,
                        'sanitize_callback' => 'intval'
                    ),
                    array(
                        'name'    => 'bottom_position',
                        'label'   => esc_html__('Bottom position', 'click-to-top'),
                        'desc'    => esc_html__('Set scroll bottom position by %.Set 0 to 5 for better view.default is 5', 'click-to-top'),
                        'type'              => 'number',
                        'default'           => 5,
                        'sanitize_callback' => 'intval'
                    ),
                    array(
                        'name'    => 'mobile_visibility',
                        'label'   => esc_html__('Mobile Visibility', 'click-to-top'),
                        'desc'    => esc_html__('Show or hide the scroll button on mobile devices (screen width < 768px).', 'click-to-top'),
                        'type'    => 'radio',
                        'default' => 'show',
                        'options' => array(
                            'show' => esc_html__('Show on Mobile', 'click-to-top'),
                            'hide' => esc_html__('Hide on Mobile', 'click-to-top'),
                        )
                    ),
                    array(
                        'name'    => 'tablet_visibility',
                        'label'   => esc_html__('Tablet Visibility', 'click-to-top'),
                        'desc'    => esc_html__('Show or hide the scroll button on tablet devices (screen width 768px - 1024px).', 'click-to-top'),
                        'type'    => 'radio',
                        'default' => 'show',
                        'options' => array(
                            'show' => esc_html__('Show on Tablet', 'click-to-top'),
                            'hide' => esc_html__('Hide on Tablet', 'click-to-top'),
                        )
                    ),
                    array(
                        'name'    => 'desktop_button_size',
                        'label'   => esc_html__('Desktop Button Size', 'click-to-top'),
                        'desc'    => esc_html__('Set the button size for desktop devices in pixels (default: 40).', 'click-to-top'),
                        'type'              => 'number',
                        'default'           => 45,
                        'sanitize_callback' => 'intval'
                    ),
                    array(
                        'name'    => 'tablet_button_size',
                        'label'   => esc_html__('Tablet Button Size', 'click-to-top'),
                        'desc'    => esc_html__('Set the button size for tablet devices in pixels (default: 45).', 'click-to-top'),
                        'type'              => 'number',
                        'default'           => 35,
                        'sanitize_callback' => 'intval'
                    ),
                    array(
                        'name'    => 'mobile_button_size',
                        'label'   => esc_html__('Mobile Button Size', 'click-to-top'),
                        'desc'    => esc_html__('Set the button size for mobile devices in pixels (default: 50).', 'click-to-top'),
                        'type'              => 'number',
                        'default'           => 30,
                        'sanitize_callback' => 'intval'
                    ),
                    array(
                        'name'    => 'touch_tap_area',
                        'label'   => esc_html__('Touch-Friendly Tap Area', 'click-to-top'),
                        'desc'    => esc_html__('Enable larger tap area on touch devices for easier interaction (adds invisible padding).', 'click-to-top'),
                        'type'    => 'radio',
                        'default' => 'enable',
                        'options' => array(
                            'enable'  => esc_html__('Enable', 'click-to-top'),
                            'disable' => esc_html__('Disable', 'click-to-top'),
                        )
                    ),
                    array(
                        'name'    => 'tap_area_size',
                        'label'   => esc_html__('Tap Area Extra Size', 'click-to-top'),
                        'desc'    => esc_html__('Additional tap area size in pixels around the button on touch devices (default: 10).', 'click-to-top'),
                        'type'              => 'number',
                        'default'           => 10,
                        'sanitize_callback' => 'intval'
                    ),
                    array(
                        'name'    => 'progress_indicator',
                        'label'   => esc_html__('Progress Indicator', 'click-to-top'),
                        'desc'    => esc_html__('Show a circular progress indicator around the button that fills as user scrolls down the page.', 'click-to-top'),
                        'type'    => 'radio',
                        'default' => 'enable',
                        'options' => array(
                            'enable' => esc_html__('Enable', 'click-to-top'),
                            'disable' => esc_html__('Disable', 'click-to-top'),
                        )
                    ),
                    array(
                        'name'    => 'progress_color',
                        'label'   => esc_html__('Progress Indicator Color', 'click-to-top'),
                        'desc'    => esc_html__('Set the color of the progress indicator ring.', 'click-to-top'),
                        'type'    => 'color',
                        'default' => '#3498db',
                    ),
                    array(
                        'name'    => 'progress_width',
                        'label'   => esc_html__('Progress Indicator Width', 'click-to-top'),
                        'desc'    => esc_html__('Set the width of the progress indicator ring in pixels (1-10).', 'click-to-top'),
                        'type'              => 'number',
                        'default'           => 3,
                        'sanitize_callback' => 'intval'
                    ),


                ),
                'click_top_style' => array(
                    array(
                        'name'    => 'btn_style',
                        'label'   => esc_html__('Select scroll button style', 'click-to-top'),
                        'desc'    => esc_html__('Select scroll button style square or round.', 'click-to-top'),
                        'type'    => 'radio',
                        'default' => 'square',
                        'options' => array(
                            'square' => esc_html__('Square', 'click-to-top'),
                            'round' => esc_html__('Round', 'click-to-top'),
                        )
                    ),
                    array(
                        'name'    => 'hover_affect',
                        'label'   => esc_html__('Select scroll hover style.', 'click-to-top'),
                        'desc'    => esc_html__('Select scroll hover style on your choice.', 'click-to-top'),
                        'type'    => 'select',
                        'default' => 'bubble-top',
                        'options' => array(
                            'shrink' => esc_html__('Shrink', 'click-to-top'),
                            'grow'  => esc_html__('Grow', 'click-to-top'),
                            'pulse'  => esc_html__('Pulse', 'click-to-top'),
                            'pulse-grow'  => esc_html__('Pulse grow', 'click-to-top'),
                            'pulse-shrink'  => esc_html__('Pulse shrink', 'click-to-top'),
                            'push'  => esc_html__('Push', 'click-to-top'),
                            'pop'  => esc_html__('pop', 'click-to-top'),
                            'bounce-in'  => esc_html__('Bounce in', 'click-to-top'),
                            'bounce-out'  => esc_html__('Bounce out', 'click-to-top'),
                            'float'  => esc_html__('Float', 'click-to-top'),
                            'bob'  => esc_html__('Bob', 'click-to-top'),
                            'buzz'  => esc_html__('Buzz', 'click-to-top'),
                            'fade'  => esc_html__('Background fade', 'click-to-top'),
                            'back-pulse'  => esc_html__('Background back-pulse', 'click-to-top'),
                            'back-pulse'  => esc_html__('Background back-pulse', 'click-to-top'),
                            'sweep-to-right'  => esc_html__('Background sweep-to-right', 'click-to-top'),
                            'sweep-to-left'  => esc_html__('Background sweep-to-left', 'click-to-top'),
                            'sweep-to-bottom'  => esc_html__('Background sweep-to-bottom', 'click-to-top'),
                            'sweep-to-top'  => esc_html__('Background sweep-to-top', 'click-to-top'),
                            'bounce-to-right'  => esc_html__('Background bounce-to-right', 'click-to-top'),
                            'bounce-to-left'  => esc_html__('Background bounce-to-left', 'click-to-top'),
                            'bounce-to-bottom'  => esc_html__('Background bounce-to-bottom', 'click-to-top'),
                            'bounce-to-top'  => esc_html__('Background bounce-to-top', 'click-to-top'),
                            'radial-out'  => esc_html__('Background radial-out', 'click-to-top'),
                            'radial-in'  => esc_html__('Background radial-in', 'click-to-top'),
                            'rectangle-in'  => esc_html__('Background rectangle-in', 'click-to-top'),
                            'rectangle-out'  => esc_html__('Background rectangle-out', 'click-to-top'),
                            'shutter-in-horizontal'  => esc_html__('Background shutter-in-horizontal', 'click-to-top'),
                            'shutter-out-horizontal'  => esc_html__('Background shutter-out-horizontal', 'click-to-top'),
                            'shutter-in-vertical'  => esc_html__('Background shutter-in-vertical', 'click-to-top'),
                            'shutter-out-vertical'  => esc_html__('Background shutter-out-vertical', 'click-to-top'),
                            'border-fade'  => esc_html__('Border fade', 'click-to-top'),
                            'hollow'  => esc_html__('Border hollow', 'click-to-top'),
                            'trim'  => esc_html__('Border trim', 'click-to-top'),
                            'ripple-out'  => esc_html__('Border ripple-out', 'click-to-top'),
                            'ripple-in'  => esc_html__('Border ripple-in', 'click-to-top'),
                            'outline-out'  => esc_html__('Border outline-out', 'click-to-top'),
                            'outline-in'  => esc_html__('Border outline-in', 'click-to-top'),
                            'round-corners'  => esc_html__('Border round-corners', 'click-to-top'),
                            'underline-from-left'  => esc_html__('Border underline-from-left', 'click-to-top'),
                            'underline-from-center'  => esc_html__('Border underline-from-center', 'click-to-top'),
                            'underline-from-right'  => esc_html__('Border underline-from-right', 'click-to-top'),
                            'reveal'  => esc_html__('Border reveal', 'click-to-top'),
                            'underline-reveal'  => esc_html__('Border underline-reveal', 'click-to-top'),
                            'overline-reveal'  => esc_html__('Border overline-reveal', 'click-to-top'),
                            'overline-from-left'  => esc_html__('Border overline-from-left', 'click-to-top'),
                            'overline-from-center'  => esc_html__('Border overline-from-center', 'click-to-top'),
                            'overline-from-right'  => esc_html__('Border overline-from-right', 'click-to-top'),
                            'shadow'  => esc_html__('Shadow', 'click-to-top'),
                            'grow-shadow'  => esc_html__('Grow-shadow', 'click-to-top'),
                            'float-shadow'  => esc_html__('Float-shadow', 'click-to-top'),
                            'glow'  => esc_html__('Glow-shadow', 'click-to-top'),
                            'shadow-radial'  => esc_html__('Shadow-radial', 'click-to-top'),
                            'box-shadow-outset'  => esc_html__('Box-shadow-outset', 'click-to-top'),
                            'box-shadow-inset'  => esc_html__('Box-shadow-inset', 'click-to-top'),
                            'bubble-top'  => esc_html__('Bubble-top', 'click-to-top'),
                            'bubble-float-top'  => esc_html__('Bubble-float-top', 'click-to-top'),
                        )
                    ),
                    array(
                        'name'    => 'btn_type',
                        'label'   => esc_html__('Select scroll button type', 'click-to-top'),
                        'desc'    => esc_html__('Select scroll button type text or icon.', 'click-to-top'),
                        'type'    => 'radio',
                        'default' => 'icon',
                        'options' => array(
                            'icon' => esc_html__('Icon', 'click-to-top'),
                            'text' => esc_html__('Text', 'click-to-top'),
                        )
                    ),
                    array(
                        'name'    => 'select_icon',
                        'label'   => esc_html__('Select scroll icon', 'click-to-top'),
                        'desc'    => esc_html__('First select button type icon then choose your preferred icon.', 'click-to-top'),
                        'type'    => 'select',
                        'default' => 'angle-up',
                        'options' => function_exists('click_to_top_get_icon_options') ? click_to_top_get_icon_options() : array(
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
                        )
                    ),
                    array(
                        'name'    => 'btn_text',
                        'label'   => esc_html__('Type scroll text', 'click-to-top'),
                        'desc'    => esc_html__('First select button type text then type your text.', 'click-to-top'),
                        'type'    => 'text',
                        'default' => esc_html__('Click to top', 'click-to-top'),

                    ),
                    array(
                        'name'    => 'bg_color',
                        'label'   => esc_html__('Set background color', 'click-to-top'),
                        'desc'    => esc_html__('Set scroll background color.', 'click-to-top'),
                        'type'    => 'color',
                        'default' => '#cccccc',

                    ),
                    array(
                        'name'    => 'icon_color',
                        'label'   => esc_html__('Set icon or text color', 'click-to-top'),
                        'desc'    => esc_html__('Set color text or icon, whatever you select.', 'click-to-top'),
                        'type'    => 'color',
                        'default' => '#000000',

                    ),
                    array(
                        'name'    => 'bg_hover_color',
                        'label'   => esc_html__('Set scroll background hover color', 'click-to-top'),
                        'desc'    => esc_html__('Set scroll background hover color.', 'click-to-top'),
                        'type'    => 'color',
                        'default' => '#555555',

                    ),
                    array(
                        'name'    => 'hover_color',
                        'label'   => esc_html__('Set icon or text hover color', 'click-to-top'),
                        'desc'    => esc_html__('Set scroll selected hover color.', 'click-to-top'),
                        'type'    => 'color',
                        'default' => '#ffffff',

                    ),
                    array(
                        'name'    => 'scroll_opacity',
                        'label'   => esc_html__('Set scroll opacity', 'click-to-top'),
                        'desc'    => esc_html__('Set scroll opacity by 1 to 99.default is 99', 'click-to-top'),
                        'type'              => 'number',
                        'default'           => 99,
                        'sanitize_callback' => 'intval'
                    ),
                    array(
                        'name'    => 'scroll_padding',
                        'label'   => esc_html__('Set scroll padding', 'click-to-top'),
                        'desc'    => esc_html__('Set scroll padding by px.', 'click-to-top'),
                        'type'              => 'number',
                        'default'           => 5,
                        'sanitize_callback' => 'intval'
                    ),
                    array(
                        'name'    => 'font_size',
                        'label'   => esc_html__('Set scroll font size', 'click-to-top'),
                        'desc'    => esc_html__('Set scroll font size by px.', 'click-to-top'),
                        'type'              => 'number',
                        'default'           => 16,
                        'sanitize_callback' => 'intval'
                    ),

                )
            );
            return $settings_fields;
        }
        function plugin_page()
        {
            // Enqueue admin styles
            $this->admin_page_styles();
            ?>
            
            <div class="wrap ctt-admin-wrap">
                 <h1></h1>
                <div class="ctt-admin-header">
                    <div class="ctt-header-content">
                        <h1>
                            <span class="dashicons dashicons-arrow-up-alt"></span>
                            <?php esc_html_e( 'Click to Top', 'click-to-top' ); ?>
                        </h1>
                        <p class="ctt-version">
                            <?php
                            /* translators: %s: Plugin version number */
                            echo esc_html( sprintf( __( 'Version %s', 'click-to-top' ), CLICK_TO_TOP_VERSION ) );
                            ?>
                        </p>
                    </div>
                    <div class="ctt-header-links">
                        <a href="https://wpthemespace.com/pro-services/" target="_blank" class="ctt-header-btn ctt-btn-pro">
                            <span class="dashicons dashicons-star-filled"></span>
                            <?php esc_html_e( 'Pro Services', 'click-to-top' ); ?>
                        </a>
                        <a href="https://wordpress.org/support/plugin/click-to-top/reviews/#new-post" target="_blank" class="ctt-header-btn ctt-btn-review">
                            <span class="dashicons dashicons-heart"></span>
                            <?php esc_html_e( 'Rate Us', 'click-to-top' ); ?>
                        </a>
                    </div>
                </div>
                <div class="ctt-admin-content">
                    <?php
                    $this->settings_api->show_navigation();
                    $this->settings_api->show_forms();
                    ?>
                </div>
                <div class="ctt-admin-footer">
                    <p>
                        <?php
                        printf(
                            /* translators: 1: Heart icon 2: Developer link */
                            esc_html__( 'Made with %1$s by %2$s', 'click-to-top' ),
                            '<span class="dashicons dashicons-heart" style="color:#e25555"></span>',
                            '<a href="https://wpthemespace.com" target="_blank">WP Theme Space</a>'
                        );
                        ?>
                    </p>
                </div>
            </div>
            <?php
        }

        /**
         * Render recommended plugins tab content.
         *
         * @since 1.2.29
         * @return void
         */
        public function render_recommended_plugins_content() {
            $plugins = array(
                array(
                    'name'        => esc_html__( 'Easy Share Solution', 'click-to-top' ),
                    'slug'        => 'easy-share-solution',
                    'description' => esc_html__( 'Add beautiful social share buttons to your posts and pages with customizable styles and positions.', 'click-to-top' ),
                    'icon'        => 'https://ps.w.org/easy-share-solution/assets/icon-128x128.gif',
                    'url'         => 'https://wordpress.org/plugins/easy-share-solution/',
                ),
                array(
                    'name'        => esc_html__( 'Magical Addons For Elementor', 'click-to-top' ),
                    'slug'        => 'magical-addons-for-elementor',
                    'description' => esc_html__( 'Free addons and widgets for Elementor page builder with cards, sliders, content tabs and more.', 'click-to-top' ),
                    'icon'        => 'https://ps.w.org/magical-addons-for-elementor/assets/icon-256x256.png',
                    'url'         => 'https://wordpress.org/plugins/magical-addons-for-elementor/',
                ),
                array(
                    'name'        => esc_html__( 'Magical Blocks', 'click-to-top' ),
                    'slug'        => 'magical-blocks',
                    'description' => esc_html__( 'Beautiful blocks for WordPress block editor with sliders, hero sections and customization options.', 'click-to-top' ),
                    'icon'        => 'https://ps.w.org/magical-blocks/assets/icon-256x256.png',
                    'url'         => 'https://wordpress.org/plugins/magical-blocks/',
                ),
                array(
                    'name'        => esc_html__( 'Magical Posts Display', 'click-to-top' ),
                    'slug'        => 'magical-posts-display',
                    'description' => esc_html__( 'Display your blog posts in beautiful layouts, grids, carousels and sliders with advanced options.', 'click-to-top' ),
                    'icon'        => 'https://ps.w.org/magical-posts-display/assets/icon-128x128.gif',
                    'url'         => 'https://wordpress.org/plugins/magical-posts-display/',
                ),
                array(
                    'name'        => esc_html__( 'Magical Products Display', 'click-to-top' ),
                    'slug'        => 'magical-products-display',
                    'description' => esc_html__( 'Display your WooCommerce products with beautiful grids, carousels, sliders and filtering options.', 'click-to-top' ),
                    'icon'        => 'https://ps.w.org/magical-products-display/assets/icon-128x128.gif',
                    'url'         => 'https://wordpress.org/plugins/magical-products-display/',
                ),
                array(
                    'name'        => esc_html__( 'WP Edit Password Protected', 'click-to-top' ),
                    'slug'        => 'wp-edit-password-protected',
                    'description' => esc_html__( 'Manage password protected pages easily. Protect your pages and change password easily from frontend or backend.', 'click-to-top' ),
                    'icon'        => 'https://ps.w.org/wp-edit-password-protected/assets/icon-128x128.gif',
                    'url'         => 'https://wordpress.org/plugins/wp-edit-password-protected/',
                ),
            );
            
            // Create nonce for AJAX
            $ajax_nonce = wp_create_nonce( 'ctt_plugin_nonce' );
            ?>
            <div class="ctt-plugins-header">
                <h2><?php esc_html_e( 'Recommended Plugins from WP Theme Space', 'click-to-top' ); ?></h2>
                <p><?php esc_html_e( 'Check out our other plugins to enhance your WordPress website.', 'click-to-top' ); ?></p>
            </div>
            <div class="ctt-plugins-grid" data-nonce="<?php echo esc_attr( $ajax_nonce ); ?>">
                <?php
                foreach ( $plugins as $plugin ) :
                    $is_installed = $this->is_plugin_installed( $plugin['slug'] );
                    $is_active    = $this->is_plugin_active( $plugin['slug'] );
                    $plugin_file  = $plugin['slug'] . '/' . $plugin['slug'] . '.php';
                    ?>
                    <div class="ctt-plugin-card <?php echo esc_attr( $is_active ? 'active' : '' ); ?>" data-slug="<?php echo esc_attr( $plugin['slug'] ); ?>" data-file="<?php echo esc_attr( $plugin_file ); ?>">
                        <div class="ctt-plugin-icon">
                            <img src="<?php echo esc_url( $plugin['icon'] ); ?>" alt="<?php echo esc_attr( $plugin['name'] ); ?>" onerror="this.src='<?php echo esc_url( admin_url( 'images/wordpress-logo.svg' ) ); ?>'">
                        </div>
                        <div class="ctt-plugin-info">
                            <h3><?php echo esc_html( $plugin['name'] ); ?></h3>
                            <p><?php echo esc_html( $plugin['description'] ); ?></p>
                        </div>
                        <div class="ctt-plugin-actions">
                            <?php if ( $is_active ) : ?>
                                <span class="ctt-plugin-status active">
                                    <span class="dashicons dashicons-yes-alt"></span>
                                    <?php esc_html_e( 'Active', 'click-to-top' ); ?>
                                </span>
                            <?php elseif ( $is_installed ) : ?>
                                <button type="button" class="button button-primary ctt-activate-btn" data-action="activate">
                                    <span class="ctt-btn-text"><?php esc_html_e( 'Activate', 'click-to-top' ); ?></span>
                                    <span class="ctt-btn-loading" style="display:none;">
                                        <span class="spinner is-active" style="float:none;margin:0;"></span>
                                    </span>
                                </button>
                            <?php else : ?>
                                <button type="button" class="button button-primary ctt-install-btn" data-action="install">
                                    <span class="ctt-btn-text"><?php esc_html_e( 'Install Now', 'click-to-top' ); ?></span>
                                    <span class="ctt-btn-loading" style="display:none;">
                                        <span class="spinner is-active" style="float:none;margin:0;"></span>
                                    </span>
                                </button>
                            <?php endif; ?>
                            <a href="<?php echo esc_url( $plugin['url'] ); ?>" target="_blank" class="button ctt-details-btn">
                                <?php esc_html_e( 'Details', 'click-to-top' ); ?>
                            </a>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            
            <script type="text/javascript">
            jQuery(document).ready(function($) {
                var $grid = $('.ctt-plugins-grid');
                var nonce = $grid.data('nonce');
                
                // Handle Install button click
                $grid.on('click', '.ctt-install-btn', function(e) {
                    e.preventDefault();
                    var $btn = $(this);
                    var $card = $btn.closest('.ctt-plugin-card');
                    var slug = $card.data('slug');
                    
                    if ($btn.hasClass('ctt-processing')) return;
                    
                    $btn.addClass('ctt-processing');
                    $btn.find('.ctt-btn-text').hide();
                    $btn.find('.ctt-btn-loading').show();
                    
                    $.ajax({
                        url: ajaxurl,
                        type: 'POST',
                        data: {
                            action: 'ctt_install_plugin',
                            slug: slug,
                            nonce: nonce
                        },
                        success: function(response) {
                            if (response.success) {
                                // Change to Activate button
                                $btn.removeClass('ctt-install-btn ctt-processing')
                                    .addClass('ctt-activate-btn')
                                    .attr('data-action', 'activate');
                                $btn.find('.ctt-btn-text').text('<?php echo esc_js( __( 'Activate', 'click-to-top' ) ); ?>').show();
                                $btn.find('.ctt-btn-loading').hide();
                            } else {
                                alert(response.data || '<?php echo esc_js( __( 'Installation failed. Please try again.', 'click-to-top' ) ); ?>');
                                $btn.removeClass('ctt-processing');
                                $btn.find('.ctt-btn-text').show();
                                $btn.find('.ctt-btn-loading').hide();
                            }
                        },
                        error: function() {
                            alert('<?php echo esc_js( __( 'Installation failed. Please try again.', 'click-to-top' ) ); ?>');
                            $btn.removeClass('ctt-processing');
                            $btn.find('.ctt-btn-text').show();
                            $btn.find('.ctt-btn-loading').hide();
                        }
                    });
                });
                
                // Handle Activate button click
                $grid.on('click', '.ctt-activate-btn', function(e) {
                    e.preventDefault();
                    var $btn = $(this);
                    var $card = $btn.closest('.ctt-plugin-card');
                    var slug = $card.data('slug');
                    var file = $card.data('file');
                    
                    if ($btn.hasClass('ctt-processing')) return;
                    
                    $btn.addClass('ctt-processing');
                    $btn.find('.ctt-btn-text').hide();
                    $btn.find('.ctt-btn-loading').show();
                    
                    $.ajax({
                        url: ajaxurl,
                        type: 'POST',
                        data: {
                            action: 'ctt_activate_plugin',
                            plugin: file,
                            nonce: nonce
                        },
                        success: function(response) {
                            if (response.success) {
                                // Change to Active status
                                $card.addClass('active');
                                $btn.replaceWith('<span class="ctt-plugin-status active"><span class="dashicons dashicons-yes-alt"></span> <?php echo esc_js( __( 'Active', 'click-to-top' ) ); ?></span>');
                            } else {
                                alert(response.data || '<?php echo esc_js( __( 'Activation failed. Please try again.', 'click-to-top' ) ); ?>');
                                $btn.removeClass('ctt-processing');
                                $btn.find('.ctt-btn-text').show();
                                $btn.find('.ctt-btn-loading').hide();
                            }
                        },
                        error: function() {
                            alert('<?php echo esc_js( __( 'Activation failed. Please try again.', 'click-to-top' ) ); ?>');
                            $btn.removeClass('ctt-processing');
                            $btn.find('.ctt-btn-text').show();
                            $btn.find('.ctt-btn-loading').hide();
                        }
                    });
                });
            });
            </script>
            <?php
        }

        /**
         * Check if a plugin is installed.
         *
         * @since 1.2.29
         * @param string $slug Plugin slug.
         * @return bool True if installed, false otherwise.
         */
        public function is_plugin_installed( $slug ) {
            if ( ! function_exists( 'get_plugins' ) ) {
                require_once ABSPATH . 'wp-admin/includes/plugin.php';
            }
            $installed_plugins = get_plugins();
            foreach ( $installed_plugins as $path => $plugin ) {
                if ( strpos( $path, $slug . '/' ) === 0 ) {
                    return true;
                }
            }
            return false;
        }

        /**
         * Check if a plugin is active.
         *
         * @since 1.2.29
         * @param string $slug Plugin slug.
         * @return bool True if active, false otherwise.
         */
        public function is_plugin_active( $slug ) {
            $active_plugins = get_option( 'active_plugins', array() );
            foreach ( $active_plugins as $path ) {
                if ( strpos( $path, $slug . '/' ) === 0 ) {
                    return true;
                }
            }
            return false;
        }

        /**
         * AJAX handler for installing plugins.
         *
         * @since 1.2.29
         * @return void
         */
        public function ajax_install_plugin() {
            // Check nonce
            if ( ! isset( $_POST['nonce'] ) || ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['nonce'] ) ), 'ctt_plugin_nonce' ) ) {
                wp_send_json_error( __( 'Security check failed.', 'click-to-top' ) );
            }

            // Check capabilities
            if ( ! current_user_can( 'install_plugins' ) ) {
                wp_send_json_error( __( 'You do not have permission to install plugins.', 'click-to-top' ) );
            }

            $slug = isset( $_POST['slug'] ) ? sanitize_text_field( wp_unslash( $_POST['slug'] ) ) : '';

            if ( empty( $slug ) ) {
                wp_send_json_error( __( 'Plugin slug is required.', 'click-to-top' ) );
            }

            // Include required files
            include_once ABSPATH . 'wp-admin/includes/plugin-install.php';
            include_once ABSPATH . 'wp-admin/includes/class-wp-upgrader.php';
            include_once ABSPATH . 'wp-admin/includes/class-wp-ajax-upgrader-skin.php';
            include_once ABSPATH . 'wp-admin/includes/class-plugin-upgrader.php';

            // Get plugin info from WordPress.org
            $api = plugins_api( 'plugin_information', array(
                'slug'   => $slug,
                'fields' => array(
                    'sections' => false,
                ),
            ) );

            if ( is_wp_error( $api ) ) {
                wp_send_json_error( $api->get_error_message() );
            }

            // Install the plugin
            $skin     = new WP_Ajax_Upgrader_Skin();
            $upgrader = new Plugin_Upgrader( $skin );
            $result   = $upgrader->install( $api->download_link );

            if ( is_wp_error( $result ) ) {
                wp_send_json_error( $result->get_error_message() );
            }

            if ( is_wp_error( $skin->result ) ) {
                wp_send_json_error( $skin->result->get_error_message() );
            }

            if ( $skin->get_errors()->has_errors() ) {
                wp_send_json_error( $skin->get_error_messages() );
            }

            if ( is_null( $result ) ) {
                global $wp_filesystem;
                wp_send_json_error( __( 'Unable to connect to the filesystem.', 'click-to-top' ) );
            }

            wp_send_json_success();
        }

        /**
         * AJAX handler for activating plugins.
         *
         * @since 1.2.29
         * @return void
         */
        public function ajax_activate_plugin() {
            // Check nonce
            if ( ! isset( $_POST['nonce'] ) || ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['nonce'] ) ), 'ctt_plugin_nonce' ) ) {
                wp_send_json_error( __( 'Security check failed.', 'click-to-top' ) );
            }

            // Check capabilities
            if ( ! current_user_can( 'activate_plugins' ) ) {
                wp_send_json_error( __( 'You do not have permission to activate plugins.', 'click-to-top' ) );
            }

            $plugin = isset( $_POST['plugin'] ) ? sanitize_text_field( wp_unslash( $_POST['plugin'] ) ) : '';

            if ( empty( $plugin ) ) {
                wp_send_json_error( __( 'Plugin file is required.', 'click-to-top' ) );
            }

            // Include required files
            include_once ABSPATH . 'wp-admin/includes/plugin.php';

            // Activate the plugin
            $result = activate_plugin( $plugin );

            if ( is_wp_error( $result ) ) {
                wp_send_json_error( $result->get_error_message() );
            }

            wp_send_json_success();
        }

        /**
         * Admin page styles
         */
        function admin_page_styles()
        {
            ?>
            <style>
                /* Admin Page Layout */
                .ctt-admin-wrap {
                    max-width: 1200px;
                    margin: 20px 20px 20px 0;
                }
                
                /* Header Styles */
                .ctt-admin-header {
                    background: linear-gradient(135deg, #c1d4f0 0%, #d4fddc 100%);
                    padding: 25px 30px;
                    border-radius: 12px;
                    margin-bottom: 20px;
                    display: flex;
                    justify-content: space-between;
                    align-items: center;
                    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
                    position: relative;
                    z-index: 1;
                    border: 1px solid #e0e4eb;
                }
                .ctt-header-content h1 {
                    color: #1e293b;
                    margin: 0;
                    font-size: 28px;
                    font-weight: 600;
                    display: flex;
                    align-items: center;
                    gap: 10px;
                }
                .ctt-header-content h1 .dashicons {
                    font-size: 32px;
                    width: 32px;
                    height: 32px;
                    color: #667eea;
                }
                .ctt-version {
                    color: #64748b;
                    margin: 5px 0 0;
                    font-size: 13px;
                }
                .ctt-header-links {
                    display: flex;
                    gap: 12px;
                }
                .ctt-header-btn {
                    display: inline-flex;
                    align-items: center;
                    gap: 6px;
                    padding: 10px 18px;
                    border-radius: 6px;
                    text-decoration: none;
                    font-weight: 500;
                    font-size: 13px;
                    transition: all 0.3s ease;
                }
                .ctt-btn-pro {
                    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
                    color: #fff;
                    box-shadow: 0 4px 12px rgba(102, 126, 234, 0.4);
                }
                .ctt-btn-pro:hover {
                    background: linear-gradient(135deg, #5a6fd6 0%, #6a4190 100%);
                    color: #fff;
                    transform: translateY(-2px);
                    box-shadow: 0 6px 16px rgba(102, 126, 234, 0.5);
                }
                .ctt-btn-review {
                    background: linear-gradient(135deg, #f97316 0%, #ea580c 100%);
                    color: #fff;
                    box-shadow: 0 4px 12px rgba(249, 115, 22, 0.4);
                }
                .ctt-btn-review:hover {
                    background: linear-gradient(135deg, #ea580c 0%, #dc2626 100%);
                    color: #fff;
                    transform: translateY(-2px);
                }

                /* Navigation Tabs */
                .ctt-admin-content .nav-tab-wrapper {
                    border-bottom: 2px solid #e0e0e0;
                    padding: 0;
                    margin-bottom: 0;
                    background: #fff;
                    border-radius: 8px 8px 0 0;
                    padding: 10px 10px 0;
                }
                .ctt-admin-content .nav-tab {
                    border: none;
                    background: transparent;
                    color: #555;
                    padding: 12px 20px;
                    margin: 0 5px -2px 0;
                    font-size: 14px;
                    font-weight: 500;
                    border-radius: 6px 6px 0 0;
                    transition: all 0.3s ease;
                }
                .ctt-admin-content .nav-tab:hover {
                    background: #f5f5f5;
                    color: #667eea;
                }
                .ctt-admin-content .nav-tab-active {
                    background: #667eea;
                    color: #fff;
                    border-bottom: 2px solid #667eea;
                }
                .ctt-admin-content .nav-tab-active:hover {
                    background: #5a6fd6;
                    color: #fff;
                }

                /* Form Styles */
                .ctt-admin-content .metabox-holder {
                    background: #fff;
                    border-radius: 0 0 8px 8px;
                    box-shadow: 0 2px 8px rgba(0,0,0,0.05);
                }
                .ctt-admin-content .group {
                    padding: 25px;
                }
                .ctt-admin-content .form-table {
                    border-collapse: separate;
                    border-spacing: 0;
                }
                .ctt-admin-content .form-table th {
                    padding: 20px 15px 20px 0;
                    font-weight: 600;
                    color: #333;
                    width: 220px;
                }
                .ctt-admin-content .form-table td {
                    padding: 15px 0;
                }
                .ctt-admin-content .form-table tr {
                    border-bottom: 1px solid #f0f0f0;
                }
                .ctt-admin-content .form-table tr:last-child {
                    border-bottom: none;
                }
                .ctt-admin-content .form-table input[type="number"],
                .ctt-admin-content .form-table input[type="text"] {
                    padding: 8px 12px;
                    border: 1px solid #ddd;
                    border-radius: 4px;
                    transition: border-color 0.3s ease;
                }
                .ctt-admin-content .form-table input:focus {
                    border-color: #667eea;
                    box-shadow: 0 0 0 2px rgba(102, 126, 234, 0.1);
                    outline: none;
                }
                .ctt-admin-content .form-table select {
                    padding: 8px 12px;
                    border: 1px solid #ddd;
                    border-radius: 4px;
                    min-width: 200px;
                }
                .ctt-admin-content .form-table .description {
                    color: #888;
                    font-style: normal;
                    margin-top: 6px;
                }
                .ctt-admin-content .form-table fieldset label {
                    display: inline-flex;
                    align-items: center;
                    margin-right: 15px;
                    cursor: pointer;
                }
                .ctt-admin-content .form-table fieldset input[type="radio"] {
                    margin-right: 6px;
                }
                .ctt-admin-content .submit {
                    padding: 20px 0 10px;
                    border-top: 1px solid #f0f0f0;
                    margin-top: 10px;
                }
                .ctt-admin-content .submit .button-primary {
                    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
                    border: none;
                    padding: 8px 25px;
                    height: auto;
                    font-size: 14px;
                    border-radius: 5px;
                    transition: all 0.3s ease;
                }
                .ctt-admin-content .submit .button-primary:hover {
                    transform: translateY(-1px);
                    box-shadow: 0 4px 12px rgba(102, 126, 234, 0.4);
                }

                /* Recommended Plugins Tab */
                .ctt-plugins-header {
                    text-align: center;
                    padding: 20px 0 30px;
                }
                .ctt-plugins-header h2 {
                    color: #333;
                    font-size: 24px;
                    margin: 0 0 10px;
                }
                .ctt-plugins-header p {
                    color: #666;
                    font-size: 15px;
                    margin: 0;
                }
                .ctt-plugins-grid {
                    display: grid;
                    grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
                    gap: 20px;
                    padding: 10px 0;
                }
                .ctt-plugin-card {
                    background: #fff;
                    border: 1px solid #e5e5e5;
                    border-radius: 10px;
                    padding: 20px;
                    display: flex;
                    flex-direction: column;
                    transition: all 0.3s ease;
                }
                .ctt-plugin-card:hover {
                    border-color: #667eea;
                    box-shadow: 0 5px 20px rgba(102, 126, 234, 0.15);
                    transform: translateY(-3px);
                }
                .ctt-plugin-card.active {
                    border-color: #46b450;
                    background: linear-gradient(135deg, #f0fff0 0%, #fff 100%);
                }
                .ctt-plugin-icon {
                    width: 64px;
                    height: 64px;
                    margin-bottom: 15px;
                }
                .ctt-plugin-icon img {
                    width: 100%;
                    height: 100%;
                    border-radius: 10px;
                    object-fit: cover;
                }
                .ctt-plugin-info {
                    flex: 1;
                }
                .ctt-plugin-info h3 {
                    margin: 0 0 8px;
                    font-size: 16px;
                    color: #333;
                }
                .ctt-plugin-info p {
                    margin: 0;
                    font-size: 13px;
                    color: #666;
                    line-height: 1.5;
                }
                .ctt-plugin-actions {
                    display: flex;
                    gap: 10px;
                    margin-top: 15px;
                    padding-top: 15px;
                    border-top: 1px solid #f0f0f0;
                }
                .ctt-plugin-status {
                    display: inline-flex;
                    align-items: center;
                    gap: 5px;
                    color: #46b450;
                    font-weight: 500;
                    font-size: 13px;
                }
                .ctt-plugin-status .dashicons {
                    font-size: 18px;
                    width: 18px;
                    height: 18px;
                }
                .ctt-install-btn,
                .ctt-activate-btn {
                    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%) !important;
                    border: none !important;
                    color: #fff !important;
                    min-width: 100px;
                    display: inline-flex;
                    align-items: center;
                    justify-content: center;
                    gap: 5px;
                    height: 32px;
                }
                .ctt-install-btn.ctt-processing,
                .ctt-activate-btn.ctt-processing {
                    opacity: 0.8;
                    pointer-events: none;
                }
                .ctt-btn-loading {
                    display: inline-flex;
                    align-items: center;
                    justify-content: center;
                }
                .ctt-btn-loading .spinner {
                    float: none !important;
                    margin: 0 !important;
                    width: 18px !important;
                    height: 18px !important;
                    background-size: 18px 18px !important;
                    vertical-align: middle;
                }
                .ctt-btn-loading .spinner.is-active {
                    visibility: visible;
                    opacity: 1;
                }
                .ctt-details-btn {
                    border-color: #ddd !important;
                }

                /* Footer */
                .ctt-admin-footer {
                    text-align: center;
                    padding: 20px;
                    color: #888;
                    font-size: 13px;
                }
                .ctt-admin-footer a {
                    color: #667eea;
                    text-decoration: none;
                }
                .ctt-admin-footer .dashicons {
                    font-size: 14px;
                    width: 14px;
                    height: 14px;
                    vertical-align: middle;
                }

                /* Responsive */
                @media screen and (max-width: 782px) {
                    .ctt-admin-header {
                        flex-direction: column;
                        text-align: center;
                        gap: 20px;
                    }
                    .ctt-header-links {
                        flex-wrap: wrap;
                        justify-content: center;
                    }
                    .ctt-admin-content .form-table th {
                        width: 100%;
                        display: block;
                        padding-bottom: 5px;
                    }
                    .ctt-plugins-grid {
                        grid-template-columns: 1fr;
                    }
                }
            </style>
            <?php
        }

        /**
         * Get all the pages
         *
         * @return array page names with key value pairs
         */
        function get_pages()
        {
            $pages = get_pages();
            $pages_options = array();
            if ($pages) {
                foreach ($pages as $page) {
                    $pages_options[$page->ID] = $page->post_title;
                }
            }

            return $pages_options;
        }
    }
endif;
require plugin_dir_path(__FILE__) . '/src/class.settings-api.php';

new click_top_options();



function clickhide_admin_notice()
{

    $hide_date = get_option('click_to_top_shop_info');
    if (!empty($hide_date)) {
        $clickhide = round((time() - strtotime($hide_date)) / 24 / 60 / 60);
        if ($clickhide < 25) {
            return;
        }
    }

    $class = 'notice notice-success is-dismissible';
    $url1 = esc_url('https://wpthemespace.com/product/shop-toolkit-pro/?add-to-cart=11720');
    $message = __('<strong><span style="color:red;">Hi Buddy!! 🔥 Shop Toolkit Pro Theme:</span>  <span style="color:green"> Best online shop theme Now available with 20% early discount! </span> – Use coupon ( mg20off ) & Grab Your Exclusive Offers! </strong>', 'click-to-top');

    printf(
        '<div class="%1$s" style="padding:10px 15px 20px;"><p style="font-size:16px">%2$s <a href="%3$s" target="_blank">%4$s</a>.</p><div style="display:flex;align-items:center;margin-top:25px"><a target="_blank" class="button button-primary" href="%3$s" style="margin-right:10px;padding:10px 20px;font-size:16px">%5$s</a><a href="#" style="padding:0;background:transparent;border:none" class="nothanks link notic-click-dissmiss">%6$s</a></div></div>',
        esc_attr($class),
        wp_kses_post($message),
        esc_url($url1),
        esc_html__('see here', 'click-to-top'),
        esc_html__('🎁 Explore Offer Now 🚀', 'click-to-top'),
        esc_html__('Hide Me', 'click-to-top')
    );
}
add_action('admin_notices', 'clickhide_admin_notice');


function clickhide_new_optins_texts_init()
{
    if (isset($_GET['cdismissed']) && $_GET['cdismissed'] == 1) {
        update_option('click_to_top_shop_info', current_time('mysql'));
    }
}
add_action('init', 'clickhide_new_optins_texts_init');
