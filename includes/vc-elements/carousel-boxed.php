<?php

class WPBakeryShortCode_Tt_Carousel_Boxed extends WPBakeryShortCode {
    protected function content( $atts, $content = null){
        extract(shortcode_atts(array(
            'layout' => 'bordered',
            'count' => '3',
            'categories' => '',
            'extra_class' => ''
        ), $atts));


        $cats = array();
        if( !empty($categories) ){
            $exps = explode(",", $categories);
            foreach($exps as $val){
                if( (int)$val>-1 ){
                    $cats[]=(int)$val;
                }
            }
        }

        $args = array(
                    'post_type' => 'post',
                    'posts_per_page' => $count,
                    'ignore_sticky_posts' => true
                );
        if(!empty($cats)){
            $args['category__in'] = $cats;
        }

        $items = '';
        $posts_query = new WP_Query($args);
        while ( $posts_query->have_posts() ) {
            $posts_query->the_post();

            $category = '';
            $post_categories = wp_get_post_categories(get_the_id());
            foreach($post_categories as $c){
                $cat = get_category($c);
                $category = "<a href='".get_term_link($cat)."'>$cat->name</a>";
            }

            $entry_date = "<div class='entry-date'>
                                <img src='".get_template_directory_uri()."/images/svg/clock.svg' alt='clock icon' class='icon-clock'>
                                <span>".get_the_time('M d, Y')."  -  $category</span>
                            </div>";


            $entry_media = "<div class='entry-media'>
                                <a href='".get_permalink()."' class='el-link'>
                                    <img src='".get_template_directory_uri()."/images/4x3.png' alt='blog image'>
                                    <div class='entry-overlay'></div>
                                </a>
                            </div>";

            
            if( has_post_thumbnail() ){
                $thumb_img = wp_get_attachment_image( get_post_thumbnail_id(), 'katharine-horizontal' );
                $entry_media = "<div class='entry-media'>
                                    <a href='".get_permalink()."' class='el-link'>
                                        $thumb_img
                                        <div class='entry-overlay'></div>
                                    </a>
                                </div>";
            }


            $title = "<h3 class='post-title'>
                            <a href='".get_permalink()."'>".get_the_title()."</a>
                        </h3>";


            $entry_meta = "<div class='entry-meta'>
                                <span>
                                    <img src='".get_template_directory_uri()."/images/svg/heart.svg' alt='svg image'>
                                    <span>14</span>
                                    <img src='".get_template_directory_uri()."/images/svg/comment.svg' alt='svg image'>
                                    <span>".get_comments_number()."</span>
                                </span>
                            </div>";

            $seperator = "<div class='seperator with-colored'><span></span></div>";

            $length = $layout=='bordered' ? 20 : 40;
            $excerpt = TPL::clear_urls(wp_trim_words( wp_strip_all_tags(do_shortcode(get_the_content())), $length ));
            $excerpt = "<div class='entry-excerpt text-center'>
                            <p>$excerpt</p>
                            <br>
                            <a href='".get_permalink()."' class='button button-fill button-bordered button-small'>".esc_html__('Read More', 'katharine')."</a>
                        </div>";

            $bg_color = '#fafafa';
            if( $layout=='bordered' ){
                $entry_meta = '';
                $bg_color = '';
            }

            $items .= "<div class='swiper-slide'>
                            <article class='blog-item style-horizontal mvb0 with-$layout' style='background-color:$bg_color;'>
                                <div class='row'>
                                    <div class='col-sm-6'>
                                        $entry_media
                                    </div>
                                    <div class='col-sm-6'>
                                        $entry_date
                                        $title
                                        $entry_meta
                                        $excerpt
                                        <div class='seperator with-colored'><span></span></div>
                                    </div>
                                </div>
                            </article>
                        </div>";

        }

        // reset query
        wp_reset_postdata();

        $extra_class = esc_attr($extra_class);
        $extra_class .= " layout-$layout";


        $result = "<div class='fullwidth-post $extra_class'>
                        <div class='swiper-container'>
                            <div class='swiper-wrapper'>$items</div>
                        </div>
                        <div class='swiper-pagination'></div>
                    </div>";

        return $result;

    }

}

vc_map( array(
    "name" => esc_html__('Posts Carousel Boxed', 'katharine'),
    "description" => esc_html__("Carousel Boxed Style", 'katharine'),
    "base" => 'tt_carousel_boxed',
    "icon" => "icon-wpb-themeton",
    "content_element" => true,
    "category" => 'Katharine',
    'params' => array(
        array(
            "type" => "dropdown",
            "param_name" => "layout",
            "heading" => esc_html__("Layout Style", 'katharine'),
            "value" => array(
                "Bordered" => "bordered",
                "Background Color" => "bgcolor"
                
            ),
            "std" => "bordered"
        ),

        array(
            "type" => 'textfield',
            "param_name" => "categories",
            "heading" => esc_html__("Categories", 'katharine'),
            "description" => esc_html__("Specify category Id or leave blank to display items from all categories.", 'katharine'),
            "value" => ''
        ),

        array(
            "type" => 'textfield',
            "param_name" => "count",
            "heading" => esc_html__("Posts Count", 'katharine'),
            "value" => '3'
        ),

        array(
            "type" => "textfield",
            "param_name" => "extra_class",
            "heading" => esc_html__("Extra Class", 'katharine'),
            "value" => "",
            "description" => esc_html__("If you wish text to white, you should add class \"text-light\". If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'katharine'),
        )
    )
));