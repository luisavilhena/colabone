<?php

if (!function_exists('tt_customizer_options')):

    function tt_customizer_options() {
        global $tt_sidebars;

        $template_uri = get_template_directory_uri();

        $pages = array();
        $all_pages = get_pages();
        foreach ($all_pages as $page) {
            $pages[$page->ID] = $page->post_title;
        }

        $option = array(
            // General
            array(
                'type' => 'section',
                'id' => 'colors',
                'label' => 'General',
                'desc' => '',
                'controls' => array(
                    array(
                        'type' => 'color',
                        'id' => 'brand-color',
                        'label' => 'Brand Color',
                        'default' => getLessValue('brand-color')
                    ),
                    array(
                        'type' => 'color',
                        'id' => 'color-text',
                        'label' => 'Content text color',
                        'default' => getLessValue('color-text')
                    ),
                    array(
                        'type' => 'color',
                        'id' => 'color-second',
                        'label' => 'Second color',
                        'default' => getLessValue('color-second')
                    ),
                    array(
                        'type' => 'color',
                        'id' => 'color-title',
                        'label' => 'Title Elements color',
                        'default' => getLessValue('color-title')
                    ),
                    array(
                        'type' => 'color',
                        'id' => 'content-bg-color',
                        'label' => 'Content background color',
                        'default' => getLessValue('content-bg-color')
                    ),

                    array(
                        'id' => 'color_option_section_menu',
                        'type' => 'sub_title',
                        'label' => 'Menu Color',
                        'default' => ''
                    ),
                    array(
                        'type' => 'color',
                        'id' => 'menu-color',
                        'label' => 'Menu color',
                        'default' => getLessValue('menu-color')
                    ),
                    array(
                        'type' => 'color',
                        'id' => 'menu-bg',
                        'label' => 'Menu background color',
                        'default' => getLessValue('menu-bg')
                    )
                )
            ),// end General

            
            // Fonts
            array(
                'type' => 'section',
                'id' => 'font',
                'label' => 'Font',
                'desc' => '',
                'controls' => array(
                    array(
                        'type' => 'font',
                        'id' => 'font-title-s',
                        'label' => 'Title font styled',
                        'default' => getLessValue('font-title-s')
                    ),
                    array(
                        'type' => 'font',
                        'id' => 'font-title',
                        'label' => 'Title Font normal',
                        'default' => getLessValue('font-title')
                    ),
                    array(
                        'type' => 'font',
                        'id' => 'font-text',
                        'label' => 'Text Font',
                        'default' => getLessValue('font-text')
                    ),
                    array(
                        'type' => 'font',
                        'id' => 'font-second',
                        'label' => 'Second Font',
                        'default' => getLessValue('font-second')
                    ),

                    array(
                        'id' => 'font_option_section_menu',
                        'type' => 'sub_title',
                        'label' => 'Menu Font',
                        'default' => ''
                    ),
                    array(
                        'type' => 'font',
                        'id' => 'menu-font',
                        'label' => 'Menu font',
                        'default' => getLessValue('menu-font')
                    ),


                    array(
                        'id' => 'font_option_section_footer',
                        'type' => 'sub_title',
                        'label' => 'Footer Font',
                        'default' => ''
                    ),
                    array(
                        'type' => 'font',
                        'id' => 'footer-font-title',
                        'label' => 'Footer Title Font',
                        'default' => getLessValue('footer-font-title')
                    ),
                    array(
                        'type' => 'font',
                        'id' => 'footer-font-text',
                        'label' => 'Footer Text Font',
                        'default' => getLessValue('footer-font-text')
                    ),
                    array(
                        'type' => 'font',
                        'id' => 'sub-footer-font',
                        'label' => 'Subfooter Font',
                        'default' => getLessValue('sub-footer-font')
                    )
                )
            ),// end Fonts


            // Branding & Logo
            array(
                'type' => 'section',
                'id' => 'section_header_style',
                'label' => 'Brand Logo & Header',
                'desc' => '',
                'controls' => array(
                    array(
                        'type' => 'image',
                        'id' => 'logo',
                        'label' => 'Logo Image',
                        'default' => $template_uri . "/images/logo.svg",
                    ),
                    array(
                        'id' => 'logo-width',
                        'label' => 'Logo Width',
                        'default' => getLessValue('logo-width'),
                        'type' => 'pixel'
                    ),
                    array(
                        'id' => 'logo-height',
                        'label' => 'Logo Height',
                        'default' => getLessValue('logo-height'),
                        'type' => 'pixel'
                    ),
                    array(
                        'id' => 'logo-margin',
                        'label' => 'Logo Margin',
                        'default' => getLessValue('logo-margin'),
                        'type' => 'pixel'
                    ),
                    array(
                        'type' => 'image',
                        'id' => 'favicon',
                        'label' => 'Favicon',
                        'default' => $template_uri . "/images/favicon.png",
                    ),


                    // Header
                    array(
                        'id' => 'header_option_section',
                        'type' => 'sub_title',
                        'label' => 'Header Options',
                        'default' => ''
                    ),
                    array(
                        'id' => 'header_layout',
                        'label' => 'Header Layout',
                        'default' => 'menu_below_logo',
                        'type' => 'select',
                        'choices' => array(
                            'menu_above_logo'   => 'Menu above logo', 
                            'menu_below_logo'   => 'Menu below logo', 
                            'menu_full'         => 'Menu full', 
                            'menu_top_center'   => 'Menu center on topbar',
                            'menu_top_left'     => 'Menu left on topbar'
                        )
                    ),
                    array(
                        'id' => 'menu-font-size',
                        'label' => 'Menu Text Size',
                        'default' => getLessValue('menu-font-size'),
                        'type' => 'pixel'
                    ),
                    array(
                        'id' => 'menu-space',
                        'label' => 'Menu Items Space',
                        'default' => getLessValue('menu-space'),
                        'type' => 'pixel'
                    ),

                    array(
                        'id' => 'header_option_bg',
                        'type' => 'sub_title',
                        'label' => 'Header Background',
                        'default' => '',
                        'desc' => 'Menu full layout'
                    ),
                    array(
                        'id' => 'header-bg-color',
                        'label' => 'Background Color',
                        'default' => getLessValue('header-bg-color'),
                        'type' => 'color'
                    ),
                    array(
                        'id' => 'header_bg_image',
                        'label' => 'Background Image',
                        'default' => '',
                        'type' => 'bg_image'
                    )

                )
            ),// end Branding
            
            
            // Content options
            array(
                'type' => 'section',
                'id' => 'page_content',
                'label' => 'Content Options',
                'controls' => array(
                    array(
                        'id' => 'content-font-size',
                        'label' => 'Content Font Size',
                        'default' => getLessValue('content-font-size'),
                        'type' => 'pixel'
                    ),
                    array(
                        'id' => 'content-line-height',
                        'label' => 'Content Text Line Height',
                        'default' => getLessValue('content-line-height'),
                        'type' => 'pixel'
                    )
                ),
            ), //end Content options


            // Social options
            array(
                'type' => 'section',
                'id' => 'social_content',
                'label' => 'Social Links',
                'controls' => array(
                    array(
                        'id' => 'social_fb',
                        'label' => 'Facebook',
                        'desc' => 'http://facebook.com/example',
                        'default' => '#',
                        'type' => 'input'
                    ),
                    array(
                        'id' => 'social_tw',
                        'label' => 'Twitter',
                        'desc' => 'http://twitter.com/example',
                        'default' => '#',
                        'type' => 'input'
                    ),
                    array(
                        'id' => 'social_gp',
                        'label' => 'Google Plus',
                        'desc' => 'http://plus.google.com/example',
                        'default' => '#',
                        'type' => 'input'
                    ),
                    array(
                        'id' => 'social_in',
                        'label' => 'Instagram',
                        'desc' => 'http://www.Instagram.com/example',
                        'default' => '#',
                        'type' => 'input'
                    ),
                    array(
                        'id' => 'social_vm',
                        'label' => 'Vimeo',
                        'desc' => 'http://www.vimeo.com/example',
                        'default' => '#',
                        'type' => 'input'
                    )
                ),
            ), //end Social options
            
            
            // Footer
            array(
                'type' => 'section',
                'id' => 'section_footer',
                'label' => 'Footer',
                'controls' => array(

                    array(
                        'id' => 'footer_layout',
                        'label' => 'Footer Layout',
                        'default' => 'standard',
                        'type' => 'select',
                        'choices' => array(
                            'standard'          => 'Standard',
                            'dark'              => 'Dark',
                            'dark_subfooter'    => 'Dark with sub footer', 
                            'dark_subline'      => 'Dark with line', 
                            'dark_topmenu'      => 'Dark with menu'
                        )
                    ),
                    array(
                        'id' => 'footer_style',
                        'label' => 'Footer Columns',
                        'default' => '6',
                        'type' => 'select',
                        'choices' => array(
                                '1' => 'Full', 
                                '2' => '2 Columns',
                                '3' => '3 Columns',
                                '4' => '4 Columns',
                                '5' => '1/3 + 1/6 + 1/4 + 1/4',
                                '6' => '1/3 + 1/4 + 1/6 + 1/4'
                        )
                    ),
                    array(
                        'id' => 'footer-color',
                        'label' => 'Footer Text Color',
                        'default' => getLessValue('footer-color'),
                        'type' => 'color'
                    ),
                    array(
                        'id' => 'footer-bg',
                        'label' => 'Footer Background Color',
                        'default' => getLessValue('footer-bg'),
                        'type' => 'color'
                    ),

                    array(
                        'id' => 'footer_logo',
                        'label' => 'Footer Logo',
                        'default' => $template_uri . "/images/logo-text-white.svg",
                        'type' => 'image'
                    ),
                    array(
                        'id' => 'footer_logo_width',
                        'label' => 'Footer Logo Width',
                        'default' => '378px',
                        'type' => 'pixel'
                    ),



                    // Sub Footer
                    array(
                        'id' => 'sub_footer_title',
                        'type' => 'sub_title',
                        'label' => 'Sub Footer Options',
                        'default' => ''
                    ),
                    array(
                        'id' => 'sub_footer',
                        'label' => 'Enable Sub Footer',
                        'default' => '1',
                        'type' => 'switch'
                    ),
                    array(
                        'id' => 'sub-footer-bg',
                        'label' => 'Sub Footer Background Color',
                        'default' => getLessValue('sub-footer-bg'),
                        'type' => 'color'
                    ),
                    array(
                        'id' => 'copyright_content',
                        'label' => 'CopyRight Content',
                        'default' => '&copy; Copyrights 2016 Katharine. All rights reserved.',
                        'desc' => '',
                        'type' => 'textarea'
                    ),


                    // Footer Images
                    array(
                        'id' => 'footer_section_images',
                        'type' => 'sub_title',
                        'label' => 'Footer top images',
                        'default' => ''
                    ),
                    // Call to Action
                    array(
                        'id' => 'footer_c2a',
                        'label' => 'Enable',
                        'default' => '0',
                        'type' => 'switch'
                    ),
                    array(
                        'id' => 'footer_c2a_content',
                        'label' => 'Text',
                        'default' => 'FOLLOW US ON  <a href="#"><i class="fa fa-instagram"></i> INSTAGRAM</a>',
                        'desc' => '',
                        'type' => 'textarea'
                    ),
                    array(
                        'id' => 'footer_c2a_img1',
                        'label' => 'Image 1',
                        'default' => '',
                        'type' => 'image'
                    ),
                    array(
                        'id' => 'footer_c2a_img2',
                        'label' => 'Image 2',
                        'default' => '',
                        'type' => 'image'
                    ),
                    array(
                        'id' => 'footer_c2a_img3',
                        'label' => 'Image 3',
                        'default' => '',
                        'type' => 'image'
                    ),
                    array(
                        'id' => 'footer_c2a_img4',
                        'label' => 'Image 4',
                        'default' => '',
                        'type' => 'image'
                    ),
                    array(
                        'id' => 'footer_c2a_img5',
                        'label' => 'Image 5',
                        'default' => '',
                        'type' => 'image'
                    ),
                    array(
                        'id' => 'footer_c2a_img6',
                        'label' => 'Image 6',
                        'default' => '',
                        'type' => 'image'
                    )

                ),
            ), // end Footer


            // Post Types
            array(
                'id' => 'panel_options',
                'label' => 'Post Types',
                'desc' => 'You can customize here mostly post type options including singular pages options.',
                'sections' => array(
                    // Post
                    array(
                        'id' => 'section_post',
                        'label' => 'Post',
                        'controls' => array(
                            array(
                                'id' => 'post_comment',
                                'label' => 'Post Comment',
                                'default' => 1,
                                'type' => 'switch'
                            ),
                            array(
                                'id' => 'post_nextprev',
                                'label' => 'Next/Prev links',
                                'default' => 1,
                                'type' => 'switch'
                            ),
                        ),
                    ),// end Post
                    // Page
                    array(
                        'id' => 'section_page',
                        'label' => 'Page',
                        'controls' => array(
                            array(
                                'id' => 'page_nextprev',
                                'label' => 'Next/Prev links',
                                'default' => 1,
                                'type' => 'switch'
                            ),
                        ),
                    ),// end Page

                )
            ),// end Post Types
            // Extras
            array(
                'id' => 'panel_extra',
                'label' => 'Extras',
                'desc' => 'Export Import and Custom CSS.',
                'sections' => array(
                    // Backup
                    array(
                        'type' => 'section',
                        'id' => 'section_backup',
                        'label' => 'Export/Import',
                        'desc' => '',
                        'controls' => array(
                            array(
                                'id' => 'backup_settings',
                                'label' => 'Export Data',
                                'desc' => 'Copy to Customizer Data',
                                'default' => '',
                                'type' => 'backup'
                            ),
                            array(
                                'id' => 'import_settings',
                                'label' => 'Import Data',
                                'desc' => 'Import Customizer Exported Data',
                                'default' => '',
                                'type' => 'import'
                            )
                        )
                    ), // end backup
                    // Custom
                    array(
                        'type' => 'section',
                        'id' => 'section_custom_css',
                        'label' => 'Custom CSS',
                        'desc' => '',
                        'controls' => array(
                            array(
                                'id' => 'custom_css',
                                'label' => 'Custom CSS (general)',
                                'default' => '',
                                'type' => 'textarea'
                            ),
                            array(
                                'id' => 'custom_css_tablet',
                                'label' => 'Tablet CSS',
                                'default' => '',
                                'type' => 'textarea',
                                'desc' => 'Screen width between 768px and 991px.'
                            ),
                            array(
                                'id' => 'custom_css_widephone',
                                'label' => 'Wide Phone CSS',
                                'default' => '',
                                'type' => 'textarea',
                                'desc' => 'Screen width between 481px and 767px. Ex: iPhone landscape.'
                            ),
                            array(
                                'id' => 'custom_css_phone',
                                'label' => 'Phone CSS',
                                'default' => '',
                                'type' => 'textarea',
                                'desc' => 'Screen width up to 480px. Ex: iPhone portrait.'
                            ),
                        )
                    ) // end Custom
                )
            ) // end Extras
        );

        return $option;
    }

endif;


function tt_theme_customize_setup(){
    // create instance of TT Theme Customizer
    new TT_Theme_Customizer();
}
add_action( 'after_setup_theme', 'tt_theme_customize_setup' );
