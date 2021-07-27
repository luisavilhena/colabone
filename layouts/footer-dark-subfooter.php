        <footer id="footer" class="footer-dark-subfooter">

            <div class="container footer-container">
                <div class="row">

                    <div class="col-md-12 text-center">
                        
                        <div class="widget">
                            <p>
                                <?php
                                $footer_logo = TT::get_mod('footer_logo');
                                $footer_logo = !empty($footer_logo) ? $footer_logo : get_template_directory_uri() . "/images/logo-text-white.svg";
                                $footer_logo_width = TT::get_mod('footer_logo_width');
                                $footer_logo_width = !empty($footer_logo_width) ? $footer_logo_width : '378px';
                                echo '<img src="'.esc_attr($footer_logo).'" style="width:'.esc_attr($footer_logo_width).';" alt="footer logo">';
                                ?>
                            </p>
                        </div>

                        <div class="footer-menu mv9 mvb0">
                            <?php
                            wp_nav_menu( array(
                                'menu_id'           => '',
                                'menu_class'        => '',
                                'theme_location'    => 'footer_menu',
                                'depth'             => 1,
                                'container'         => '',
                                'fallback_cb'       => 'tt_footer_menu_callback'
                            ));
                            ?>
                        </div>

                    </div>

                </div>
                
                <div class="row copyright-text">
                    <div class="col-sm-12 text-center">
                        <div class="widget">
                            <p><?php echo TT::get_mod('copyright_content'); ?></p>
                        </div>
                    </div>
                </div>

            </div>

        </footer>