        <footer id="footer" class="footer-dark-subline">

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

                    </div>

                </div>

            </div>

            <div class="sub-footer">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-4">

                            <div class="widget mv6 mvb0">
                                <p><?php echo TT::get_mod('copyright_content'); ?></p>
                            </div>

                        </div>
                        <div class="col-sm-4 text-center">
                            <div class="widget widget-subscribe-form">
                                <h5 class="widget-title">Newsletter</h5>
                                <div class="subscribe-form">
                                    <form>
                                        <input type="text" placeholder="Enter Your E-mail">
                                        <button type="submit"><i class="fa fa-envelope-o"></i></button>
                                    </form>
                                </div>
                            </div>
                            
                        </div>
                        <div class="col-sm-2 ph0">

                            <div class="widget mv6 mvb0">
                                <div class="custom-links">
                                    <?php
                                    wp_nav_menu( array(
                                        'menu_id'           => '',
                                        'menu_class'        => '',
                                        'theme_location'    => 'subfooter_menu',
                                        'depth'             => 1,
                                        'container'         => '',
                                        'fallback_cb'       => 'tt_footer_menu_callback'
                                    ));
                                    ?>
                                </div>
                            </div>
                            
                        </div>
                        <div class="col-sm-2 text-right">

                            <div class="widget mv6 mvb0">
                                <div class="social-links">
                                    <?php TPL::get_social_links(); ?>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>

        </footer>