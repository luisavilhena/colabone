<?php

class TPL{



    public static function get_post_media(){
        global $post;
        $media = '';
        if( has_post_thumbnail() ){
            $thumb_img = wp_get_attachment_image( get_post_thumbnail_id(), 'katharine-thumb' );
            $media = '<a href="'.get_permalink().'" class="el-link">'. $thumb_img .'<div class="entry-overlay"></div></a>';
        }

        $format = get_post_format();

        if( current_theme_supports('post-formats', $format) ){


            // blockquote
            if( $format=='quote' ){
                preg_match("/<blockquote>(.*?)<\/blockquote>/msi", get_the_content(), $matches);
                if( isset($matches[0]) && !empty($matches[0]) ){
                    $media = $matches[0];
                    $media = str_replace("<blockquote", "<blockquote class='quote-element'", $media);
                }
            }


            // link
            if( $format=='link' ){
                preg_match('/<a\s[^>]*href=\"([^\"]*)\"[^>]*>(.*)<\/a>/siU', get_the_content(), $matches);
                if( isset($matches[1],$matches[2]) && !empty($matches[2]) ){
                    $media = "<blockquote class='link-element'>
                                $matches[2]
                                <cite><a href='$matches[1]'>$matches[1]</a></cite>
                              </blockquote>";
                }
            }


            // gallery
            else if( $format=='gallery' && has_shortcode($post->post_content, 'gallery') ){
                $gallery = get_post_gallery( get_the_ID(), false );
                $ids = explode(",", isset($gallery['ids']) ? $gallery['ids'] : "");

                $gallery_id = uniqid();
                $gallery = '';
                $indicators = '';
                $indx = 0;
                foreach ($ids as $gid) {
                    $img = wp_get_attachment_image( $gid, 'katharine-thumb' );
                    $gallery .= "<div class='swiper-slide'>$img</div>";
                    $indx++;
                }


                $media = !empty($gallery) ? "<div class='gallery-slideshow'>
                                                <div class='swiper-container gallery-container'>
                                                    <div class='swiper-wrapper'>$gallery</div>
                                                </div>
                                                <div class='swiper-button-prev'></div>
                                                <div class='swiper-button-next'></div>
                                            </div>" : $media;

                $media = $media;
            }


            // audio
            else if( $format=='audio' ){
                $pattern = get_shortcode_regex();
                preg_match('/'.$pattern.'/s', $post->post_content, $matches);
                if (is_array($matches) && isset($matches[2]) && $matches[2] == 'audio') {
                    $shortcode = $matches[0];
                    $media = '<div class="mejs-wrapper audio">'. do_shortcode($shortcode) . '</div>';
                }
                else{
                    preg_match("/<iframe(.)*<\/iframe>/msi", get_the_content(), $matches);
                    if( isset($matches[0]) && !empty($matches[0]) ){
                        $media = $matches[0];
                    }
                    else{
                        if ( preg_match( '|^\s*(https?://[^\s"]+)\s*$|im', $post->post_content, $matches ) ) {
                            if(isset($matches[1])) {
                                $media = "<div class='audio-post'>".apply_filters( "tt_media_filter", $matches[1] )."</div>";
                            }
                        }
                    }
                }
                $media = $media;
            }



            // video
            else if( $format=='video' ){
                if ( preg_match( '|^\s*(https?://[^\s"]+)\s*$|im', $post->post_content, $matches ) ) {
                    if(isset($matches[1])) {
                        $media = "<div class='video-post'>".apply_filters( "tt_media_filter", $matches[1] )."</div>";
                    }
                }
            }

            
        }

        return !empty($media) ? "<div class='entry-media'>$media</div>" : "";
    }





    public static function get_folio_gallery($fpost){
        if( has_shortcode($fpost->post_content, 'gallery') ):
            $gallery = get_post_gallery( $fpost->ID, false );
            $ids = explode(",", isset($gallery['ids']) ? $gallery['ids'] : "");

            $gallery_items = '';
            foreach ($ids as $a_id):
                $img_full = wp_get_attachment_image( $a_id, 'full' );

                $gallery_items .= '<div class="gallery-item">
                                        '.$img_full.'
                                    </div>';

            endforeach;

            return '<div class="gallery-slider owl-carousel">'.$gallery_items.'</div>';
        endif;

        return '';
    }



    public static function get_author_link(){
        global $post;
        return get_author_posts_url(get_the_author_meta('ID'));
    }


    
    public static function get_author_name(){
        global $post;
        return get_the_author();
    }


     
    public static function pagination( $query=null ) {
         
        global $wp_query, $paged;
        $query = $query ? $query : $wp_query;
        $big = 999999999;
        if( is_front_page() ){
            $paged = get_query_var('page') ? get_query_var('page') : 1;
        }

        $paginate = paginate_links( array(
            'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
            'type' => 'array',
            'total' => $query->max_num_pages,
            'format' => '?paged=%#%',
            'current' => max( 1, $paged ),
            'prev_text' => '<i class="fa fa-angle-left"></i>',
            'next_text' => '<i class="fa fa-angle-right"></i>',
            )
        );

        $result = '';

        if ($query->max_num_pages > 1) :
            $result .= "<ul>";
            foreach ( $paginate as $page ) {
                $result .= "<li>$page</li>";
            }
            $result .= "</ul>";
        endif;
        
        return $result;
    }





    public static function getCategories($post_id, $post_type){
        $cats = array();
        $taxonomies = get_object_taxonomies($post_type);
        if( !empty($taxonomies) ){
            $tax = $taxonomies[0];
            if( $post_type=='product' )
                $tax = 'product_cat';
            $terms = wp_get_post_terms($post_id, $tax);
            foreach ($terms as $term){
                $cats[] = array(
                                'term_id' => $term->term_id,
                                'name' => $term->name,
                                'slug' => $term->slug,
                                'link' => get_term_link($term)
                                );
            }
        }

        return $cats;
    }




    public static function get_share_links(){
        $social = array();

        $social['facebook'] = 'http://www.facebook.com/sharer.php?u='.esc_url(get_permalink());
        $social['twitter'] = 'https://twitter.com/share?url='.esc_url(get_permalink()).'&text='.esc_attr(get_the_title());
        $social['googleplus'] = 'https://plus.google.com/share?url='.esc_url(get_permalink());
        $social['pinterest'] = 'https://pinterest.com/pin/create/bookmarklet/?media='.esc_url(isset($thumb[0]) ? $thumb[0] : '').'&url='.esc_url(get_permalink()).'&description='.esc_attr(get_the_title());

        return $social;
    }



    public static function get_social_links(){
        $social_fb = TT::get_mod('social_fb');
        $social_tw = TT::get_mod('social_tw');
        $social_gp = TT::get_mod('social_gp');
        $social_vm = TT::get_mod('social_vm');
        $social_in = TT::get_mod('social_in');
        
        if( !empty($social_fb) ){
            echo '<a href="'.esc_attr($social_fb).'"><i class="fa fa-facebook"></i></a>';
        }
        if( !empty($social_tw) ){
            echo '<a href="'.esc_attr($social_tw).'"><i class="fa fa-twitter"></i></a>';
        }
        if( !empty($social_gp) ){
            echo '<a href="'.esc_attr($social_gp).'"><i class="fa fa-google-plus"></i></a>';
        }
        if( !empty($social_vm) ){
            echo '<a href="'.esc_attr($social_vm).'"><i class="fa fa-vimeo"></i></a>';
        } 
        if( !empty($social_in) ){
            echo '<a href="'.esc_attr($social_in).'"><i class="fa fa-instagram"></i></a>';
        } 
    }

    

    public static function clear_urls($content){
        $pattern = "/(?i)\b((?:https?:\/\/|www\d{0,3}[.]|[a-z0-9.\-]+[.][a-z]{2,4}\/)(?:[^\s()<>]+|\(([^\s()<>]+|(\([^\s()<>]+\)))*\))+(?:\(([^\s()<>]+|(\([^\s()<>]+\)))*\)|[^\s`!()\[\]{};:'\".,<>?]))/";
        $content = preg_replace($pattern, "", $content);
        return trim( $content );
    }



    public static function get_page_title(){
        global $post;
        if( function_exists('is_shop') && is_shop() ):
            printf( "%s", esc_html__('Shop', 'katharine') );
        elseif( function_exists('is_shop') && is_product() ):
            printf( "%s", esc_html__('Shop Details', 'katharine') );
        elseif( is_archive() ):
            if(function_exists('the_archive_title')) :
                the_archive_title();
            else:
                printf( wp_kses( __('Category: <span>%s</span>', 'katharine'), array('span'=>array()) ), single_cat_title( '', false ) );
            endif;

        elseif( is_search() ):
            printf( 'Search Results for: <span>%s</span>', get_search_query() );
        elseif( is_singular('portfolio') ):
            printf( '%s', get_the_title() );
        elseif( is_single() ):
            printf( '%s', get_the_title() );
        elseif( is_front_page() || is_home() ):
            if( get_query_var('post_type')=='portfolio' ):
                printf('%s', esc_html__('Projects', 'katharine'));
            elseif( !is_front_page() && is_home() ):
                $reading_blog_page = get_option('page_for_posts');
                $po = get_post($reading_blog_page);
                echo apply_filters('the_title', $po->post_title);
            else:
                printf('%s', esc_html__('Home', 'katharine'));
            endif;
        elseif( is_404() ):
            printf( "%s", esc_html__('404 Page', 'katharine') );
        else:
            the_title();
        endif;
    }



}

