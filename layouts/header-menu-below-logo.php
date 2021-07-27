        <header id="header" class="menu-below-logo">

            <div class="topbar">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-12">

                            <div class="topbar-left-content">
                                <div class="social-links">
                                    <?php TPL::get_social_links(); ?>
                                </div>
                            </div>

                            <div class="topbar-right-content">
                                <?php
                                wp_nav_menu( array(
                                    'menu_id'           => '',
                                    'menu_class'        => '',
                                    'theme_location'    => 'topbar_menu',
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

            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        
                        <div class="header-wrapper">

                            <?php get_template_part('layouts/logo'); ?>

                            <?php get_template_part('layouts/nav-menu'); ?>

                        </div>

                    </div>
                </div>
            </div>
        </header>