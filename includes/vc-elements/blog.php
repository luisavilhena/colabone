<?php

class WPBakeryShortCode_Tt_Blog extends WPBakeryShortCode {
    protected function content( $atts, $content = null){
        extract(shortcode_atts(array(
            'layout' => 'standard', // value: standard | boxed | horizontal
            'columns' => '2',       // value: 1,2,3,4 - standard | boxed
            'masonry' => 'none',    // value: none, masonry - standard
            'img_align' => 'left',  // value: left, mixed - horizontal
            'count' => '12',
            'pager' => 'show',
            'categories' => '',
            'extra_class' => ''
        ), $atts));

        $atts['columns'] = $columns;
        $atts['masonry'] = $masonry;
        $atts['img_align'] = $img_align;


        $cats = array();
        if( !empty($categories) ){
            $exps = explode(",", $categories);
            foreach($exps as $val){
                if( (int)$val>-1 ){
                    $cats[]=(int)$val;
                }
            }
        }

        $paged = get_query_var('paged') ? (int)get_query_var('paged') : 1;
        if( is_front_page() ){
            $paged = get_query_var('page') ? (int)get_query_var('page') : $paged;
        }

        $args = array(
                    'post_type' => 'post',
                    'posts_per_page' => $count,
                    'paged' => $paged,
                    'ignore_sticky_posts' => true
                );
        if(!empty($cats)){
            $args['category__in'] = $cats;
        }

        $items = '';
        $post_index = 1;
        $posts_query = new WP_Query($args);
        while ( $posts_query->have_posts() ) {
            $posts_query->the_post();

            if( $layout=='boxed' ){
                $items .= $this->get_boxed_items($atts);
            }

            else if( $layout=='horizontal' ){
                $format = get_post_format();
                if( $format=='quote' || $format=='link' ){
                    $post_index = 0;
                }
                $atts['post_index'] = $post_index;
                $items .= $this->get_horizontal_items($atts);
            }

            else{
                $items .= $this->get_standard_items($atts);
            }

            $post_index++;
        }

        $result = '';

        if( $layout=='boxed' ){
            $result = "<div class='blog-container ".esc_attr($extra_class)."'>
                            <div class='container-fluid'>
                                <div class='row'>$items</div>
                            </div>
                        </div>";
        }

        else if( $layout=='horizontal' ){
            $result = "<div class='blog-horizontal-container ".esc_attr($extra_class)."'>
                            $items
                        </div>";
        }

        else{
            if( $masonry=='masonry' ){
                $result = "<div class='blog-masonry-container ".esc_attr($extra_class)."'>
                                <div class='row'>$items</div>
                            </div>";
            }
            else if( abs($columns)==1 ){
                $result = "<div class='blog-items-container".esc_attr($extra_class)."'>$items</div>";
            }
            else{
                $result = "<div class='row blog-grid-row".esc_attr($extra_class)."' data-columns='$columns'>$items</div>";
            }
        }

      
            $pagination = TPL::pagination($posts_query);
            if( !empty($pagination) ){
                $result .= "<div class='post-navigation mv10'>$pagination</div>";
            }
        

        // reset query
        wp_reset_postdata();

        return $result;

    }



    public function get_standard_items($atts){

        $format = get_post_format();

        $category = '';
        $post_categories = wp_get_post_categories(get_the_id());
        foreach($post_categories as $c){
            $cat = get_category($c);
            $category = "<a href='".get_term_link($cat)."'>$cat->name</a>";
        }

        $columns = isset($atts['columns']) && abs($atts['columns'])>0 ? abs($atts['columns']) : 1;
        $masonry = isset($atts['masonry']) && !empty($atts['masonry']) ? $atts['masonry'] : 'none';
        $img_size = 'katharine-st-col1';
        $img_size = $columns>1 ? 'katharine-st-cols' : $img_size;
        $img_size = $masonry=='masonry' ? 'katharine-masonry' : $img_size;

        $entry_date = '<div class="entry-date">
                            <img src="'.get_template_directory_uri().'/images/svg/clock.svg" alt="clock icon" class="icon-clock">
                            <span>'.get_the_time('M d, Y').'  -  '.$category.'</span>
                        </div>';

        $title = '<h2 class="post-title"><a href="'.get_permalink().'">'.get_the_title().'</a></h2>';


        $entry_media = '';
        if( has_post_thumbnail() ){
            $thumb_img = wp_get_attachment_image( get_post_thumbnail_id(), $img_size );
            $entry_media = '<div class="entry-media">
                                <a href="'.get_permalink().'" class="el-link">
                                    '.$thumb_img.'
                                    <div class="entry-overlay"></div>
                                </a>
                            </div>';
        }


        if( $format=='video' ){
            if ( preg_match( '|^\s*(https?://[^\s"]+)\s*$|im', get_the_content(), $matches ) ) {
                if(isset($matches[1])) {
                    $thumb_img = '<img src="'.get_template_directory_uri().'/images/8x5.png" alt="image spacer">';
                    $thumb_img = has_post_thumbnail() ? wp_get_attachment_image( get_post_thumbnail_id(), $img_size ) : $thumb_img;
                    $entry_media = '<div class="entry-media">
                                        <div class="video-element">
                                            <a href="'.esc_attr($matches[1]).'">'.$thumb_img.'</a>
                                        </div>
                                    </div>';
                }
            }
        }


        $entry_meta = '<div class="entry-meta">
                            <span>
                                <span>'.tt_get_post_like(get_the_id()).'</span>
                                <img src="'.get_template_directory_uri().'/images/svg/comment.svg" alt="svg image">
                                <span>'.get_comments_number().'</span>
                            </span>
                        </div>';

        $length = 60;
        $length = $columns==2 ? 40 : $length;
        $length = $columns>2 ? 20 : $length;
        $excerpt = TPL::clear_urls(wp_trim_words( wp_strip_all_tags(do_shortcode(get_the_content())), $length ));
        $excerpt = '<div class="entry-excerpt text-center">
                        <p>'.$excerpt.'</p>
                        <br>
                        <a href="'.get_permalink().'" class="button button-fill button-bordered button-small">'.esc_html__('Read More', 'katharine').'</a>
                    </div>';


        $result = '<article class="blog-item">
                        '.$entry_date.'
                        '.$title.'
                        '.$entry_media.'
                        '.$entry_meta.'
                        '.$excerpt.'
                        <div class="seperator"><span></span></div>
                    </article>';


        if( $format=='quote' ){
            preg_match("/<blockquote>(.*?)<\/blockquote>/msi", get_the_content(), $matches);
            if( isset($matches[0]) && !empty($matches[0]) ){
                $quote = $matches[0];
                $quote = str_replace("<blockquote", "<blockquote class='quote-element'", $quote);
                $result = '<article class="blog-item blog-item-quote">
                                '.$entry_date.'
                                <div class="entry-media">'.$quote.'</div>
                                '.$entry_meta.'
                            </article>';
            }
        }
        else if( $format=='link' ){
            preg_match('/<a\s[^>]*href=\"([^\"]*)\"[^>]*>(.*)<\/a>/siU', get_the_content(), $matches);
            if( isset($matches[1],$matches[2]) && !empty($matches[2]) ){
                $quote = "<blockquote class='quote-element link-element'>
                            $matches[2]
                            <cite><a href='$matches[1]'>$matches[1]</a></cite>
                          </blockquote>";
                $result = '<article class="blog-item blog-item-quote">
                                '.$entry_date.'
                                <div class="entry-media">'.$quote.'</div>
                                '.$entry_meta.'
                            </article>';
            }
        }

        $post_class = $masonry=='masonry' ? 'masonry-item' : '';
        if( $columns==2 ){
            $post_class = "col-sm-6 $post_class";
            return '<div class="'.$post_class.'">'.$result.'</div>';
        }
        else if( $columns==3 ){
            $post_class = "col-sm-4 $post_class";
            return '<div class="'.$post_class.'">'.$result.'</div>';
        }
        else if( $columns==4 ){
            $post_class = "col-sm-4 col-md-3 $post_class";
            return '<div class="'.$post_class.'">'.$result.'</div>';
        }
        else{
            return $result;
        }

    }


    public function get_boxed_items($atts){

        $format = get_post_format();

        $category = '';
        $post_categories = wp_get_post_categories(get_the_id());
        foreach($post_categories as $c){
            $cat = get_category($c);
            $category = "<a href='".get_term_link($cat)."'>$cat->name</a>";
        }

        $post_class = '';

        $entry_media = '<div class="entry-media">
                            <img src="'.get_template_directory_uri().'/images/1x1.png" alt="blog image">
                            <div class="entry-overlay"></div>
                        </div>';

        if( has_post_thumbnail() ){
            $thumb_img = wp_get_attachment_image( get_post_thumbnail_id(), 'katharine-boxed-item' );
            $entry_media = '<div class="entry-media">
                                '.$thumb_img.'
                                <div class="entry-overlay"></div>
                            </div>';
        }


        $entry_date = '<div class="entry-date">
                            <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 43 43" enable-background="new 0 0 43 43" xml:space="preserve">
                                <circle fill="none" stroke="#444444" stroke-width="2" stroke-miterlimit="10" cx="21.5" cy="21.5" r="20"/>
                                <polyline fill="none" stroke="#444444" stroke-width="2" stroke-miterlimit="10" points="21.5,9.5 21.5,21.5 29.5,25.5 "/>
                            </svg>
                            <span>'.get_the_time('M d, Y').'  -  '.$category.'</span>
                        </div>';

        $title = '<h3 class="post-title"><a href="'.get_permalink().'">'.get_the_title().'</a></h3>';

        $entry_meta = '<div class="entry-meta">
                            <span>
                                <span>'.tt_get_post_like(get_the_id()).'</span>
                                <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 64 60" enable-background="new 0 0 64 60" xml:space="preserve">
                                    <polygon fill="none" stroke="#444444" stroke-width="2" stroke-miterlimit="10" points="26,47.2 55,47.2 55,9.2 1,9.2 1,47.2 14,47.2 14,57.7 "/>
                                    <polyline fill="none" stroke="#444444" stroke-width="2" stroke-miterlimit="10" points="57,39.2 63,39.2 63,1.2 9,1.2 9,7.2 "/>
                                </svg>
                                <span>'.get_comments_number().'</span>
                            </span>
                        </div>';

        $readmore = '<div class="read-more">
                        <a href="'.get_permalink().'" class="button button-fill">'.esc_html__('Read More', 'katharine').'</a>
                    </div>';



        if( $format=='video' ){
            $video_link = 'javascript:;';
            if ( preg_match( '|^\s*(https?://[^\s"]+)\s*$|im', get_the_content(), $matches ) ){
                if(isset($matches[1])){
                    $video_link = $matches[1];
                }
            }
            $entry_date = '<a href="'.esc_attr($video_link).'" class="video-play"><i class="fa fa-play"></i></a>' . $entry_date;
            $readmore = '';
        }
        else if( $format=='quote' ){
            preg_match("/<blockquote>(.*?)<\/blockquote>/msi", get_the_content(), $matches);
            if( isset($matches[0]) && !empty($matches[0]) ){
                $title = $matches[0];
                $post_class = 'post-format-quote';
                $readmore = '';
                $entry_media = '<div class="entry-media">
                                    <img src="'.get_template_directory_uri().'/images/1x1.png" alt="blog image">
                                </div>';
            }
        }
        else if( $format=='link' ){
            preg_match('/<a\s[^>]*href=\"([^\"]*)\"[^>]*>(.*)<\/a>/siU', get_the_content(), $matches);
            if( isset($matches[1],$matches[2]) && !empty($matches[2]) ){
                $title = "<blockquote>
                            $matches[2]
                            <cite><a href='$matches[1]'>$matches[1]</a></cite>
                          </blockquote>";
                $post_class = 'post-format-quote format-link';
                $readmore = '';
                $entry_media = '<div class="entry-media">
                                    <img src="'.get_template_directory_uri().'/images/1x1.png" alt="blog image">
                                </div>';
            }
        }

        // columns
        $columns = isset($atts['columns']) && abs($atts['columns'])>0 ? abs($atts['columns']) : 3;
        if( $columns==2 ){
            $post_class = "col-sm-6 blog-item-boxed $post_class";
        }
        else if( $columns==3 ){
            $post_class = "col-sm-6 col-md-4 blog-item-boxed $post_class";
        }
        else if( $columns==4 ){
            $post_class = "col-sm-6 col-md-4 col-lg-3 blog-item-boxed $post_class";
        }
        else{
            $post_class = "col-sm-12 blog-item-boxed $post_class";
        }

        $result = '<div class="'.esc_attr($post_class).'">
                        '.$entry_media.'
                        <div class="entry-info">
                            '.$entry_date.'
                            '.$title.'
                            '.$entry_meta.'
                            '.$readmore.'
                        </div>
                    </div>';

        return $result;
    }


    public function get_horizontal_items($atts){
        $format = get_post_format();

        $category = '';
        $post_categories = wp_get_post_categories(get_the_id());
        foreach($post_categories as $c){
            $cat = get_category($c);
            $category = "<a href='".get_term_link($cat)."'>$cat->name</a>";
        }


        $entry_media = '<div class="entry-media">
                            <a href="'.get_permalink().'" class="el-link">
                                <img src="'.get_template_directory_uri().'/images/4x3.png" alt="blog image">
                                <div class="entry-overlay"></div>
                            </a>
                        </div>';

        if( has_post_thumbnail() ){
            $thumb_img = wp_get_attachment_image( get_post_thumbnail_id(), 'katharine-horizontal' );
            $entry_media = '<div class="entry-media">
                                <a href="'.get_permalink().'" class="el-link">
                                    '.$thumb_img.'
                                    <div class="entry-overlay"></div>
                                </a>
                            </div>';
        }


        if( $format=='video' ){
            if ( preg_match( '|^\s*(https?://[^\s"]+)\s*$|im', get_the_content(), $matches ) ) {
                if(isset($matches[1])) {
                    $thumb_img = '<img src="'.get_template_directory_uri().'/images/4x3.png" alt="image spacer">';
                    $thumb_img = has_post_thumbnail() ? wp_get_attachment_image( get_post_thumbnail_id(), 'katharine-horizontal' ) : $thumb_img;
                    $entry_media = '<div class="entry-media">
                                        <div class="video-element">
                                            <a href="'.esc_attr($matches[1]).'">'.$thumb_img.'</a>
                                        </div>
                                    </div>';
                }
            }
        }


        $entry_date = '<div class="entry-date text-left">
                            <img src="'.get_template_directory_uri().'/images/svg/clock.svg" alt="clock icon" class="icon-clock">
                            <span>'.get_the_time('M d, Y').'  -  '.$category.'</span>
                        </div>';

        $title = '<h2 class="post-title text-left"><a href="'.get_permalink().'">'.get_the_title().'</a></h2>';

        $entry_meta = '<div class="entry-meta text-left">
                            <span>
                                <span>'.tt_get_post_like(get_the_id()).'</span>
                                <img src="'.get_template_directory_uri().'/images/svg/comment.svg" alt="svg image">
                                <span>'.get_comments_number().'</span>
                            </span>
                        </div>';

        $excerpt = TPL::clear_urls(wp_trim_words( wp_strip_all_tags(do_shortcode(get_the_content())), 40 ));
        $excerpt = '<div class="entry-excerpt text-left">
                        <p>'.$excerpt.'</p>
                        <br>
                        <a href="'.get_permalink().'" class="button button-fill button-bordered button-small">'.esc_html__('Read More', 'katharine').'</a>
                    </div>';


        $left_content = $entry_media;
        $right_content = $entry_date . $title . $entry_meta . $excerpt . '<div class="seperator"><span></span></div>';

        $img_align = isset($atts['img_align']) && !empty($atts['img_align']) ? $atts['img_align'] : 'left';
        $index = isset($atts['post_index']) && abs($atts['post_index'])>0 ? abs($atts['post_index']) : 1;

        if( $img_align=='mixed' && ($index%2)==0 ){
            $tmp = $left_content;
            $left_content = $right_content;
            $right_content = $tmp;
        }

        if( $img_align=='mixed' ){
            $left_content = str_replace(' text-left">', '">', $left_content);
            $right_content = str_replace(' text-left">', '">', $right_content);

            $left_content = str_replace(' class="entry-excerpt', ' class="entry-excerpt text-center', $left_content);
            $right_content = str_replace(' class="entry-excerpt', ' class="entry-excerpt text-center', $right_content);
        }

        $result = '<article class="blog-item style-horizontal">
                        <div class="row">
                            <div class="col-sm-6">
                                '.$left_content.'
                            </div>
                            <div class="col-sm-6">
                                '.$right_content.'
                            </div>
                        </div>
                    </article>';


        if( $format=='quote' ){
            preg_match("/<blockquote>(.*?)<\/blockquote>/msi", get_the_content(), $matches);
            if( isset($matches[0]) && !empty($matches[0]) ){
                $quote = $matches[0];
                $quote = str_replace("<blockquote", "<blockquote class='quote-element'", $quote);
                $result = '<article class="blog-item style-horizontal blog-item-quote">
                                '.str_replace(' text-left">', '">', $entry_date).'
                                <div class="entry-media">'.$quote.'</div>
                                '.str_replace(' text-left">', '">', $entry_meta).'
                            </article>';
            }
        }
        else if( $format=='link' ){
            preg_match('/<a\s[^>]*href=\"([^\"]*)\"[^>]*>(.*)<\/a>/siU', get_the_content(), $matches);
            if( isset($matches[1],$matches[2]) && !empty($matches[2]) ){
                $quote = "<blockquote class='quote-element link-element'>
                            $matches[2]
                            <cite><a href='$matches[1]'>$matches[1]</a></cite>
                          </blockquote>";
                $result = '<article class="blog-item style-horizontal blog-item-quote">
                                '.str_replace(' text-left">', '">', $entry_date).'
                                <div class="entry-media">'.$quote.'</div>
                                '.str_replace(' text-left">', '">', $entry_meta).'
                            </article>';
            }
        }

        return $result;
    }
}

vc_map( array(
    "name" => esc_html__('Blog', 'katharine'),
    "description" => esc_html__("Blog posts", 'katharine'),
    "base" => 'tt_blog',
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
                "Boxed Item" => "boxed",
                "Horizontal" => "horizontal"
                
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
            "std" => "2",
            "dependency" => Array("element" => "layout", "value" => array("standard", "boxed"))
        ),

        // standard
        array(
            "type" => "dropdown",
            "param_name" => "masonry",
            "heading" => esc_html__("Masonry layout", 'katharine'),
            "value" => array(
                "None" => "none",
                "Masonry" => "masonry"
            ),
            "std" => "left",
            "dependency" => Array("element" => "layout", "value" => array("standard"))
        ),

        // horizontal
        array(
            "type" => "dropdown",
            "param_name" => "img_align",
            "heading" => esc_html__("Image Align", 'katharine'),
            "value" => array(
                "Left" => "left",
                "Left, Right mixed" => "mixed"
            ),
            "std" => "left",
            "dependency" => Array("element" => "layout", "value" => array("horizontal"))
        ),

        // common
        array(
            "type" => 'textfield',
            "param_name" => "count",
            "heading" => esc_html__("Posts Count", 'katharine'),
            "value" => '12'
        ),
        array(
            "type" => "dropdown",
            "param_name" => "pager",
            "heading" => esc_html__("Pagination", 'katharine'),
            "value" => array(
                "Show" => "show",
                "Hide" => "hide"
            ),
            "std" => "show"
        ),

        array(
            "type" => 'textfield',
            "param_name" => "categories",
            "heading" => esc_html__("Categories", 'katharine'),
            "description" => esc_html__("Specify category Id or leave blank to display items from all categories.", 'katharine'),
            "value" => ''
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