        <header id="header" class="menu-above-logo">

            <div class="topbar">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-12">

                            <div class="topbar-left-content">
                                <a href="javascript:;" id="header-search">
                                    <span><?php esc_html_e('Search', 'katharine'); ?></span>
                                    <i class="fa fa-search"></i>
                                </a>
                            </div>

                            <div class="topbar-right-content">
                                <div class="social-links">
                                    <?php TPL::get_social_links(); ?>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        
                        <div class="header-wrapper">

                            <?php get_template_part('layouts/nav-menu'); ?>

                            <?php get_template_part('layouts/logo'); ?>

                        </div>

                    </div>
                </div>
            </div>
        </header>