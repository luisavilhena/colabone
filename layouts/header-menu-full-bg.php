        <?php
        $header_bg_image = TT::get_mod('header_bg_image');
        $header_bg_image = strpos($header_bg_image, "http")!==false ? $header_bg_image : '';
        ?>
        <header id="header" class="menu-full-bg" style="background-image:url(<?php echo esc_attr($header_bg_image); ?>);">

            <div class="topbar">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-12">

                            <div class="topbar-left-content">
                                <div class="social-links">
                                    <?php TPL::get_social_links(); ?>
                                </div>
                            </div>

                            <?php get_template_part('layouts/logo'); ?>

                            <div class="topbar-right-content">
                                <a href="javascript:;" id="header-search">
                                    <span><?php esc_html_e('Search', 'katharine'); ?></span>
                                    <i class="fa fa-search"></i>
                                </a>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

            <div class="menu-container">
                
                <div class="container">
                    <div class="row">
                        <div class="col-sm-12">
                            
                            <div class="header-wrapper">

                                <?php get_template_part('layouts/nav-menu'); ?>

                            </div>

                        </div>
                    </div>
                </div>

            </div>

        </header>