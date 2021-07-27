        <footer id="footer" class="footer-dark-topmenu">
            
            <div class="footer-menu-container">
                <div class="containers">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="footer-menu">
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
                </div>
            </div>

            <div class="container footer-container">
                <div class="row">

                    <div class="col-sm-6 col-md-3">
                        
                        <div class="widget">
                            <p>
                                <?php
                                $footer_logo = TT::get_mod('footer_logo');
                                $footer_logo = !empty($footer_logo) ? $footer_logo : get_template_directory_uri() . "/images/logo-white.svg";
                                $footer_logo_width = TT::get_mod('footer_logo_width');
                                $footer_logo_width = !empty($footer_logo_width) ? $footer_logo_width : '148px';
                                echo '<img src="'.esc_attr($footer_logo).'" style="width:'.esc_attr($footer_logo_width).';" alt="footer logo">';
                                ?>
                            </p>
                        </div>

                    </div>

                    <div class="col-sm-6 col-md-6 text-center">
                        
                        <div class="widget widget-subscribe-form">
                            <h5 class="widget-title">Subscribe Now</h5>
                            <div class="subscribe-form">
                                <form>
                                    <input type="text" placeholder="Email">
                                    <button type="submit"><i class="fa fa-send-o"></i></button>
                                </form>
                            </div>
                        </div>

                    </div>

                    <div class="col-sm-6 col-md-3 text-right">

                        <div class="widget">
                            <div class="social-links">
                                <?php TPL::get_social_links(); ?>
                            </div>
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