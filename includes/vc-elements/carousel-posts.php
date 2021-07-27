<?php

class WPBakeryShortCode_Tt_Posts_Carousel extends WPBakeryShortCode {
    protected function content( $atts, $content = null){
        extract(shortcode_atts(array(
            'layout' => 'standard',
            'columns' => '3',
            'ratio' => '1x1',
            'margin_bottom' => 'mv8',
            'count' => '12',
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
                                <svg version='1.1' xmlns='http://www.w3.org/2000/svg' xmlns:xlink='http://www.w3.org/1999/xlink' x='0px' y='0px' viewBox='0 0 43 43' enable-background='new 0 0 43 43' xml:space='preserve'>
                                    <circle fill='none' stroke='#444444' stroke-width='2' stroke-miterlimit='10' cx='21.5' cy='21.5' r='20'/>
                                    <polyline fill='none' stroke='#444444' stroke-width='2' stroke-miterlimit='10' points='21.5,9.5 21.5,21.5 29.5,25.5 '/>
                                </svg>
                                <span>".get_the_time('M d, Y')."  -  $category</span>
                            </div>";


            $image = '';
            if( has_post_thumbnail() ){
                $atach_src = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full');
                $image = is_array($atach_src) ? $atach_src[0] : "";
            }

            $entry_media = "<div class='entry-media' style='background-image:url($image);'>
                                <img src='".get_template_directory_uri()."/images/$ratio.png' alt='blog image'>
                                <div class='entry-overlay'></div>
                            </div>";


            $title = "<h3 class='post-title'>
                            <a href='".get_permalink()."'>".get_the_title()."</a>
                        </h3>";

            $readmore = "<div class='read-more'>
                            <a href='".get_permalink()."' class='button button-fill button-bordered button-small'>
                                ".esc_html__('Read More', 'katharine')."
                            </a>
                        </div>";

            $seperator = "<div class='seperator with-colored'><span></span></div>";

            $item_class = $layout=='centered' ? 'style-active-meta' : 'style-hover-meta';

            $items .= "<div class='swiper-slide'>
                            <div class='blog-item-boxed $item_class'>
                                $entry_media
                                <div class='entry-info'>
                                    $entry_date
                                    $title
                                    $readmore
                                    $seperator
                                </div>
                            </div>
                        </div>";
        }

        // reset query
        wp_reset_postdata();

        $extra_class = esc_attr($extra_class);
        if( $layout=='centered' ){
            $extra_class .= " layout-centered";
        }
        else{
            $extra_class .= " layout-standard";
        }
        $extra_class .= " $margin_bottom";

        $result = "<div class='carousel-posts $extra_class mvt0' data-columns='".abs($columns)."'>
                        <div class='swiper-container'>
                            <div class='swiper-wrapper'>$items</div>
                        </div>
                        <div class='swiper-button-prev'></div>
                        <div class='swiper-button-next'></div>
                    </div>";

        return $result;

    }

}

vc_map( array(
    "name" => esc_html__('Posts Carousel', 'katharine'),
    "description" => esc_html__("Carousel", 'katharine'),
    "base" => 'tt_posts_carousel',
    "icon" => "icon-wpb-themeton",
    "content_element" => true,
    "category" => 'Katharine',
    'params' => array(
        array(
            "type" => "dropdown",
            "param_name" => "layout",
            "heading" => esc_html__("Layout Style", 'katharine'),
            "value" => array(
                "Standard" => "standard",
                "Slide Center" => "centered"
                
            ),
            "std" => "standard"
        ),

        array(
            "type" => "dropdown",
            "param_name" => "columns",
            "heading" => esc_html__("Columns", 'katharine'),
            "value" => array(
                "1 Column" => "1",
                "2 Columns" => "2",
                "3 Columns" => "3",
                "4 Columns" => "4"
            ),
            "std" => "3",
            "dependency" => Array("element" => "layout", "value" => array("standard"))
        ),

        array(
            "type" => "dropdown",
            "param_name" => "ratio",
            "heading" => esc_html__("Item ratio", 'katharine'),
            "value" => array(
                "1x1" => "1x1",
                "5x8" => "5x8",
                "16x9" => "16x9"
            ),
            "std" => "1x1"
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
            "type" => "dropdown",
            "param_name" => "margin_bottom",
            "heading" => esc_html__("Margin Bottom", 'katharine'),
            "value" => array(
                "10 pixel" => "mv1",
                "20 pixel" => "mv2",
                "30 pixel" => "mv3",
                "40 pixel" => "mv4",
                "50 pixel" => "mv5",
                "60 pixel" => "mv6",
                "70 pixel" => "mv7",
                "80 pixel" => "mv8",
                "90 pixel" => "mv9",
                "100 pixel" => "mv10",
                "110 pixel" => "mv11",
                "120 pixel" => "mv12",
                "130 pixel" => "mv13",
                "140 pixel" => "mv14",
                "150 pixel" => "mv15",
                "160 pixel" => "mv16",
            ),
            "std" => "mv8"
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