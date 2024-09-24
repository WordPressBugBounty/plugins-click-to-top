<?php

/**
 * @link              http://wpthemespace.com
 * @since             1.0.0
 * @package           wp edit password protected
 *
 * @author noor alam
 */
/*
if(!class_exists('WpSpaceNtClass')){
class WpSpaceNtClass{

    function __construct()
   {
    add_action( 'init', [ $this, 'wpspace_admin_notice_option' ] );;
    add_action( 'admin_notices', [ $this, 'clicktop_new_optins_texts' ] );
      
   }

    function clicktop_new_optins_texts() {
        $api_url = 'https://ms.wpthemespace.com/msadd.php';  
        $api_response = wp_remote_get( $api_url );
    
        $click_message = '';
        $click_id = '1';
        $click_link1 = '';
        $click_linktext1 = '';
        $click_link2 = '';
        $click_linktext2 = '';
        if( !is_wp_error($api_response) ){
            $click_api_body = wp_remote_retrieve_body($api_response);
            $click_notice_outer = json_decode($click_api_body);
        
            $click_message = !empty($click_notice_outer->massage)? $click_notice_outer->massage: '';
            $click_id = !empty($click_notice_outer->id)? $click_notice_outer->id: '';
            $click_linktext1 = !empty($click_notice_outer->linktext1)? $click_notice_outer->linktext1: '';
            $click_link1 = !empty($click_notice_outer->link1)? $click_notice_outer->link1: '';
            $click_linktext2 = !empty($click_notice_outer->linktext2)? $click_notice_outer->linktext2: '';
            $click_link2 = !empty($click_notice_outer->link2)? $click_notice_outer->link2: '';
    
        }
    
        $click_addid = 'clickdissmiss'.$click_id;
        global $pagenow;
        if( get_option( $click_addid ) || $pagenow == 'plugins.php' ){
            return;
        }
    ?>
    <div class="eye-notice notice notice-success is-dismissible" style="padding:10px 15px 20px;">
    <?php if( $click_message ): ?>
        <p><?php echo wp_kses_post( $click_message ); ?></p>
    <?php endif; ?>
    <?php if( $click_link1 ): ?>
        <a target="_blank" class="button button-primary" href="<?php echo esc_url( $click_link1 ); ?>" style="margin-right:10px"><?php echo esc_html( $click_linktext1  ); ?></a>
    <?php endif; ?>
    <?php if( $click_link2 ): ?>
        <a target="_blank" class="button button-primary" href="<?php echo esc_url( $click_link2 ); ?>" style="margin-right:10px"><?php echo esc_html( $click_linktext2 ); ?></a>
    <?php endif; ?>
    <a href="#" class="clickto-dismiss"><?php echo esc_html('Dismiss this notice','click-to-top'); ?></a>
        
    </div>
    
    <?php
    
    
    } 

        function wpspace_admin_notice_option(){
            global $pagenow;
            $api_url = 'https://ms.wpthemespace.com/msadd.php';  
            $api_response = wp_remote_get( $api_url );
          
            $click_id = '1';
            $click_oldid = '2';
            if( !is_wp_error($api_response) ){
                $click_api_body = wp_remote_retrieve_body($api_response);
                $click_notice_outer = json_decode($click_api_body);
        
                $click_id = !empty($click_notice_outer->id)? $click_notice_outer->id: '';
                $click_oldid = !empty($click_notice_outer->old_id)? $click_notice_outer->old_id: '';
        
              
            }
        
            $click_removeid = 'clickdissmiss'.$click_oldid;
            $click_addid = 'clickdissmiss'.$click_id;
        
            if(isset($_GET['clickdissmiss']) && $_GET['clickdissmiss'] == 1 ){
                delete_option( $click_removeid );
                update_option( $click_addid, 1 );
            }

            if( !(get_option( $click_addid ) || $pagenow == 'plugins.php') ){
                add_action( 'admin_footer', [ $this, 'add_scripts' ],999 );
            }
            
        }

        function add_scripts(){
            ?>
            <script>
            ;(function($){
                $(document).ready(function(){
                    $('.notic-click-dissmiss').on('click',function(){
                        var url = new URL(location.href);
                        url.searchParams.append('cdismissed',1);
                        location.href= url;
                    });
                    $('.clickto-dismiss').on('click',function(e){
                        e.preventDefault();
                        var url = new URL(location.href);
                        url.searchParams.append('clickdissmiss',1);
                        location.href= url;
                    });
                });
            })(jQuery);
            </script>
            <?php
        }




}

new WpSpaceNtClass();

  
}// if condition check 

*/

//Admin notice 
if (!function_exists('spacehide_go_me')) :
    function spacehide_go_me()
    {
        global $pagenow;
        if ($pagenow != 'themes.php') {
            return;
        }

        $class = 'notice notice-success is-dismissible';
        $url1 = esc_url('https://wpthemespace.com/product-category/pro-theme/');

        $message = __('<strong><span style="color:red;">Hi Buddy!! Recomended WordPress Theme for you:</span>  <span style="color:green"> If you find a Secure, SEO friendly, full functional premium WordPress theme for your site then </span>  </strong>', 'click-to-top');

        printf('<div class="%1$s" style="padding:10px 15px 20px;"><p>%2$s <a href="%3$s" target="_blank">' . esc_html__('see here', 'click-to-top') . '</a>.</p><a target="_blank" class="button button-danger" href="%3$s" style="margin-right:10px">' . esc_html__('View WordPress Theme', 'click-to-top') . '</a></div>', esc_attr($class), wp_kses_post($message), esc_url($url1));
    }
    add_action('admin_notices', 'spacehide_go_me');
endif;
