<?php

// ---------- Theme recommendation notice (themes.php only) ----------
if ( ! function_exists( 'spacehide_go_me' ) ) :
    function spacehide_go_me() {
        global $pagenow;
        if ( $pagenow !== 'themes.php' ) {
            return;
        }

        $url = 'https://wpthemespace.com/product-category/pro-theme/';
        ?>
        <div class="notice notice-success is-dismissible" style="padding:10px 15px 20px;">
            <p>
                <strong><span style="color:red;"><?php esc_html_e( 'Hi Buddy!! Recommended WordPress Theme for you:', 'click-to-top' ); ?></span>
                <span style="color:green;"><?php esc_html_e( 'If you find a Secure, SEO friendly, full functional premium WordPress theme for your site then', 'click-to-top' ); ?></span></strong>
                <a href="<?php echo esc_url( $url ); ?>" target="_blank"><?php esc_html_e( 'see here', 'click-to-top' ); ?></a>.
            </p>
            <a target="_blank" class="button button-danger" href="<?php echo esc_url( $url ); ?>" style="margin-right:10px;">
                <?php esc_html_e( 'View WordPress Theme', 'click-to-top' ); ?>
            </a>
        </div>
        <?php
    }
    add_action( 'admin_notices', 'spacehide_go_me' );
endif;
