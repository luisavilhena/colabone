<?php


if ( ! function_exists( 'katharine_theme_setup' ) ) :
    function katharine_theme_setup() {

        // load translate file
        load_theme_textdomain( 'katharine', get_template_directory() . '/languages' );

        // Add default posts and comments RSS feed links to head.
        add_theme_support( 'automatic-feed-links' );

        // Let WordPress manage the document title.
        add_theme_support( 'title-tag' );

        // Enable support for Post Thumbnails on posts and pages.
        add_theme_support( 'post-thumbnails' );
        set_post_thumbnail_size( 640, 380, true );

        // Set Image sizes
        add_image_size( 'katharine-thumb', 750, 500, true );
        add_image_size( 'katharine-boxed-item', 480, 480, true );
        add_image_size( 'katharine-horizontal', 560, 500, true );
        add_image_size( 'katharine-st-col1', 1170, 600, true );
        add_image_size( 'katharine-st-cols', 550, 410, true );
        add_image_size( 'katharine-masonry', 550, 0, true );


        // This theme uses wp_nav_menu() in two locations.
        register_nav_menus( array(
            'primary' => esc_html__('Primary Menu', 'katharine'),
            'topbar_menu' => esc_html__('Topbar Menu', 'katharine'),
            'footer_menu' => esc_html__('Footer Menu', 'katharine'),
            'subfooter_menu' => esc_html__('Sub Footer Menu', 'katharine')
        ) );

        // Switch default core markup for search form, comment form, and comments to output valid HTML5.
        add_theme_support( 'html5', array(
            'search-form', 'comment-form', 'comment-list', 'gallery', 'caption'
        ) );

        add_theme_support( 'post-formats', array(
            'quote', 'image', 'gallery', 'audio', 'video', 'link'
        ) );

    }
endif;
add_action( 'after_setup_theme', 'katharine_theme_setup' );



// default content width
if ( ! isset( $content_width ) ) $content_width = 940;




$tt_sidebars = array();
$tt_sidebars = array_merge(array(
    'sidebar'=> esc_html__('Post Sidebar Area', 'katharine'),
    'sidebar-page'=> esc_html__('Page Sidebar Area', 'katharine')
), $tt_sidebars);

// Register widget area.
function katharine_theme_widgets_init() {
    
    global $tt_sidebars;
    if(isset($tt_sidebars)) {
        foreach ($tt_sidebars as $id => $sidebar) {
            if( !empty($id) ){
                if( $id=='sidebar-portfolio' && !class_exists('TT_Portfolio_PT') )
                    continue;
                
                register_sidebar(array(
                    'name' => $sidebar,
                    'id' => $id,
                    'description' => esc_html__('Add widgets here to appear in your sidebar.', 'katharine'),
                    'before_widget' => '<div id="%1$s" class="widget %2$s">',
                    'after_widget'  => '</div>',
                    'before_title'  => '<h5 class="widget-title"><span>',
                    'after_title'   => '</span></h5>'
                ));                
            }
        }
    }


    // Footer widget areas
    $footer_widget_num = TT::get_mod('footer_style');

    for($i=1; $i<=$footer_widget_num ; $i++ ) {
        register_sidebar(
            array(
                'name'          => esc_html__('Footer Column', 'katharine') . ' ' .$i,
                'id'            => 'footer'.$i,
                'description'   => esc_html__('Add widgets here to appear in your footer column', 'katharine') . ' ' .$i,
                'before_widget' => '<div id="%1$s" class="footer_widget widget %2$s">',
                'after_widget'  => '</div>',
                'before_title'  => '<h5 class="widget-title">',
                'after_title'   => '</h5>'
            )
        );
    }
}

add_action( 'widgets_init', 'katharine_theme_widgets_init' );




if ( ! function_exists( 'katharine_theme_fonts_url' ) ) :
    function katharine_theme_fonts_url() {
        $fonts_url = '';
        $fonts     = array();
        $subsets   = 'latin,latin-ext';

        $logo = TT::get_mod('logo');
        if( empty($logo) ){
            $fonts[] = 'Raleway:200';
        }

        if ( $fonts ) {
            $fonts_url = esc_url(add_query_arg( array(
                'family' => implode( '|', $fonts ),
                'subset' => urlencode( $subsets ),
            ), '//fonts.googleapis.com/css' ));
        }

        return $fonts_url;
    }
endif;





if( !function_exists('wp_site_icon') ):
    // Print Favicon
    add_action('wp_head', 'tt_print_favicon');
    function tt_print_favicon(){
        if(TT::get_mod('favicon') != '')
            echo '<link rel="shortcut icon" type="image/x-icon" href="'.TT::get_mod('favicon').'"/>';
    }
endif;

function tt_inline_script(){
    $cookie = array();
    if( array_key_exists('reactions_of_posts', $_COOKIE) ){
        $cookie = (array)json_decode($_COOKIE['reactions_of_posts']);
    }

    return sprintf('var theme_options = { ajax_url: "%s" };
                    var themeton_reaction_of_posts = %s;',
                    esc_url(admin_url('admin-ajax.php')), json_encode($cookie) );
}




function katharine_enqueue_scripts() {
    
    wp_enqueue_script( 'wp-mediaelement' );

    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' );
    }

    // Add custom fonts, used in the main stylesheet.
    wp_enqueue_style( 'tt-theme-fonts', katharine_theme_fonts_url(), array(), null );


    // Bootstrap
    wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/vendors/bootstrap/css/bootstrap.min.css' );
    wp_enqueue_style( 'bootstrap-theme', get_template_directory_uri() . '/vendors/bootstrap/css/bootstrap-theme.min.css' );
    wp_enqueue_script('bootstrap', get_template_directory_uri() . '/vendors/bootstrap/js/bootstrap.min.js', false, false, true );

    // Fontawesome
    wp_enqueue_style( 'fontawesome', get_template_directory_uri() . '/vendors/font-awesome/css/font-awesome.min.css' );

    // Swiper
    wp_enqueue_style( 'swiperjs', get_template_directory_uri() . '/vendors/swiper/css/swiper.min.css' );
    wp_enqueue_script('swiperjs', get_template_directory_uri() . '/vendors/swiper/js/swiper.min.js', false, false, true );

    // Magnific-popup
    wp_enqueue_style( 'magnific-popup', get_template_directory_uri() . '/vendors/magnific-popup/magnific-popup.css' );
    wp_enqueue_script('magnific-popup', get_template_directory_uri() . '/vendors/magnific-popup/jquery.magnific-popup.min.js', false, false, true );


    // Loaders CSS
    wp_enqueue_style( 'loaders-css', get_template_directory_uri() . '/vendors/loaders-css/loaders.min.css' );
    wp_enqueue_script('loaders-css', get_template_directory_uri() . '/vendors/loaders-css/loaders.css.js', false, false, false );

    // scripts
    wp_enqueue_script('waypoints', get_template_directory_uri() . '/vendors/jquery.waypoints.min.js', false, false, true );
    wp_enqueue_script('isotope', get_template_directory_uri() . '/vendors/isotope.pkgd.min.js', false, false, true );
    

    // theme style and scripts
    wp_enqueue_style( 'katharine-stylesheet', get_stylesheet_uri() );
    wp_enqueue_script('katharine-script', get_template_directory_uri() . '/js/scripts.js', array( 'jquery' ), false, true );
    wp_add_inline_script('themeton-lib-packages', tt_inline_script() );

}
add_action( 'wp_enqueue_scripts', 'katharine_enqueue_scripts' );





add_filter( 'body_class', 'katharine_body_class_filter' );
function katharine_body_class_filter( $classes ) {
    global $post;
    
    if( is_page() ){
        $template = isset($post->ID) ? TT::getmeta('wp_page_template') : '';
        if( $template=="page-maintenance.php" ){
            $classes[] = 'coming-soon';
        }
    }
    
    

    return $classes;
}




function custom_excerpt_length( $length ) {
    return 20;
}
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );


function custom_excerpt_more( $excerpt ) {
    return ' ...';
}
add_filter( 'excerpt_more', 'custom_excerpt_more' );


function tt_mime_types($mime_types){
    $mime_types['svg'] = 'image/svg+xml';
    return $mime_types;
}
add_filter('upload_mimes', 'tt_mime_types', 1, 1);









if( ! function_exists('tt_print_main_menu') ) :
    function tt_print_main_menu($menu_class = ''){
        global $post;
        $po = $post;
        $page_for_posts = get_option('page_for_posts');
        $is_blog_page = is_home() && get_post_type($post) && !empty($page_for_posts) ? true : false;
        if( (is_page() || $is_blog_page) && $is_blog_page )
            $po = get_post($page_for_posts);

        if( isset($po->ID) && TT::getmeta('one_page_menu', $po->ID)=='1' ){
            $content = $po->post_content;
            $pattern = get_shortcode_regex();

            echo "<ul class='$menu_class one-page-menu'>";
            if( preg_match_all( '/'. $pattern .'/s', $post->post_content, $matches ) && array_key_exists( 2, $matches ) && in_array( 'vc_row', $matches[2] ) ){
                foreach ($matches[3] as $attr) {
                    $props = array();
                    $sarray = explode('" ', trim($attr));
                    foreach ($sarray as $val) {
                        $el =explode("=", $val);
                        $s1 = str_replace('"', '', trim($el[0]));
                        $s2 = isset($el[1]) ? str_replace('"', '', trim($el[1])) : '';
                        $props[$s1] = $s2;
                    }

                    if( isset($props['one_page_section'], $props['one_page_label']) && $props['one_page_section']=='yes' && !empty($props['one_page_label']) ){
                        $label = $props['one_page_label'];
                        $slug = isset($props['one_page_slug']) && !empty($props['one_page_slug']) ? $props['one_page_slug'] : TT::create_slug($props['one_page_label']);

                        echo "<li class='menu-item'><a class='scroll-to-link' href='#".esc_attr($slug)."'>$label</a></li>";
                    }

                }
            }
            echo "</ul>";
        }
        else{
            wp_nav_menu( array(
                'menu_id'           => 'primary-nav',
                'menu_class'        => $menu_class,
                'theme_location'    => 'primary',
                'container'         => '',
                'fallback_cb'       => 'tt_primary_callback'
            ) );
        }
    }
endif;






function tt_primary_callback(){
    echo '<ul class="menu">';
    wp_list_pages( array(
        'sort_column'  => 'menu_order, post_title',
        'title_li' => '') );
    echo '</ul>';
}

function tt_footer_menu_callback(){
    echo '<ul>';
        echo '<li class="menu-item"><a href="'.esc_url(home_url('/')).'">'.esc_html__('Home', 'katharine').'</a></li>';
        echo '<li class="menu-item"><a href="'.esc_url(home_url('/')).'?post_type=post">'.esc_html__('Archive', 'katharine').'</a></li>';
        echo '<li class="menu-item"><a href="'.esc_url(home_url('/')).'?s=">'.esc_html__('Search', 'katharine').'</a></li>';
    echo '</ul>';
}



add_filter( 'the_content_more_link', 'modify_read_more_link' );
function modify_read_more_link() {
    return '<br><br><a href="'.get_permalink().'" class="button button-fill button-bordered button-small">'.esc_html__('Read More', 'katharine').'</a>';
}






// wp_oembedd media filter
global $wp_embed;
add_filter( 'tt_media_filter', array( $wp_embed, 'autoembed' ), 8 ); 



/*
                                                                    
 _____ _                 _              _____ _                     
|_   _| |_ ___ _____ ___| |_ ___ ___   |     | |___ ___ ___ ___ ___ 
  | | |   | -_|     | -_|  _| . |   |  |   --| | .'|_ -|_ -| -_|_ -|
  |_| |_|_|___|_|_|_|___|_| |___|_|_|  |_____|_|__,|___|___|___|___|
  
*/
  // Themeton Standard Package
require_once get_template_directory() . '/framework/classes/class.themeton.std.php';

// Include current theme customize
require_once TT::file_require(get_template_directory() . '/includes/functions.php');

?>