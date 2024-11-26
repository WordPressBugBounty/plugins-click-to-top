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
                    'id' => 'click_top_basic',
                    'title' => esc_html__('Basic Settings', 'click-to-top')
                ),
                array(
                    'id' => 'click_top_style',
                    'title' => esc_html__('Scroll style Settings', 'click-to-top')
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
                        'default' => 'slide',
                        'options' => array(
                            'Fade' => esc_html__('Fade', 'click-to-top'),
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
                        'desc'    => esc_html__('First select button type icon then choice icon.', 'click-to-top'),
                        'type'    => 'select',
                        'default' => 'angle-double-up',
                        'options' => array(
                            'angle-double-up' => esc_html__('icon angle-double-up', 'click-to-top'),
                            'angle-up' => esc_html__('icon angle up', 'click-to-top'),
                            'arrow-circle-o-up' => esc_html__('icon arrow circle o up', 'click-to-top'),
                            'arrow-circle-up' => esc_html__('icon arrow circle up', 'click-to-top'),
                            'arrow-up' => esc_html__('icon arrow-up', 'click-to-top'),
                            'caret-square-o-up' => esc_html__('icon caret square o up', 'click-to-top'),
                            'caret-up' => esc_html__('icon caret up', 'click-to-top'),
                            'chevron-circle-up' => esc_html__('icon chevron circle up', 'click-to-top'),
                            'chevron-up' => esc_html__('icon chevron up', 'click-to-top'),
                            'hand-o-up' => esc_html__('icon hand up', 'click-to-top'),
                            'hand-pointer-o' => esc_html__('icon hand pointer', 'click-to-top'),
                            'long-arrow-up' => esc_html__('icon long arrow up', 'click-to-top'),
                            'toggle-up' => esc_html__('icon toggle up', 'click-to-top'),
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
            echo '<a target="_blank" href="https://wpthemespace.com/pro-services/"><img src="https://wpthemespace.com/wp-content/uploads/2022/01/wordpress-service.jpg"></a>';
            echo '<div class="wrap click-top">';
            echo '<h1>' . esc_html__('Click to top settings', 'click-to-top') . '</h1>';
            $this->settings_api->show_navigation();
            $this->settings_api->show_forms();

            echo '</div>';
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
