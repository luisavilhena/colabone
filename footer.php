        
        <?php
        $c2a_img1 = TT::get_mod('footer_c2a_img1');
        $c2a_img2 = TT::get_mod('footer_c2a_img2');
        $c2a_img3 = TT::get_mod('footer_c2a_img3');
        $c2a_img4 = TT::get_mod('footer_c2a_img4');
        $c2a_img5 = TT::get_mod('footer_c2a_img5');
        $c2a_img6 = TT::get_mod('footer_c2a_img6');

        $footer_c2a = TT::get_mod('footer_c2a');
        if( $footer_c2a=='1' ):
        ?>
        <div class="footer-row">
            <div class="row">
                <div class="col-xs-4 col-sm-2">
                    <img src="<?php echo esc_attr($c2a_img1); ?>" alt="image">
                </div>
                <div class="col-xs-4 col-sm-2">
                    <img src="<?php echo esc_attr($c2a_img2); ?>" alt="image">
                </div>
                <div class="col-xs-4 col-sm-2">
                    <img src="<?php echo esc_attr($c2a_img3); ?>" alt="image">
                </div>
                <div class="col-xs-4 col-sm-2">
                    <img src="<?php echo esc_attr($c2a_img4); ?>" alt="image">
                </div>
                <div class="col-xs-4 col-sm-2">
                    <img src="<?php echo esc_attr($c2a_img5); ?>" alt="image">
                </div>
                <div class="col-xs-4 col-sm-2">
                    <img src="<?php echo esc_attr($c2a_img6); ?>" alt="image">
                </div>
            </div>

            <div class="fi-caption">
                <?php echo TT::get_mod('footer_c2a_content'); ?>
            </div>
        </div>
        <?php endif; ?>

		<?php
        $footer_layout = TT::get_mod('footer_layout');
        global $flayout;
        $footer_layout = !empty($flayout) ? $flayout : $footer_layout;
        switch($footer_layout){
            case 'dark':
                get_template_part('layouts/footer', 'dark');
                break;
            case 'dark_subfooter':
                get_template_part('layouts/footer', 'dark-subfooter');
                break;
            case 'dark_subline':
                get_template_part('layouts/footer', 'dark-subline');
                break;
            case 'dark_topmenu':
                get_template_part('layouts/footer', 'dark-topmenu');
                break;
            default:
                // footer standard
                get_template_part('layouts/footer', 'standard');
                break;
        }
        ?>

	</div>

    <!-- Overlay Search -->
    <div id="overlay-search">
        <form method="get" action="<?php echo esc_url(home_url('/')); ?>">
            <input type="text" name="s" placeholder="<?php esc_attr_e('Search...', 'katharine'); ?>" autocomplete="off">
            <button type="submit">
                <i class="fa fa-search"></i>
            </button>
            <p><?php esc_html_e('Begin typing and hit enter to search...', 'katharine'); ?></p>
        </form>
        <a href="javascript:;" class="close-search"></a>
    </div>


	<?php wp_footer(); ?>

</body>
</html>