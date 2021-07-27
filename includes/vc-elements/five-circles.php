<?php

class WPBakeryShortCode_Tt_Five_Circles extends WPBakeryShortCode {
    protected function content( $atts, $content = null){
        extract( shortcode_atts( array(
            "image" => '',
            "sub_title" => '',
            "title" => "",
            "link_text" => "",
            "link" => "#",

            'image1' => '',
            'title1' => '',
            'link1' => '#',

            'image2' => '',
            'title2' => '',
            'link2' => '#',

            'image3' => '',
            'title3' => '',
            'link3' => '#',

            'image4' => '',
            'title4' => '',
            'link4' => '#',

            "extra_class" => ""
        ), $atts ) );

        $atach_src = wp_get_attachment_image_src($image, 'full');
        $image = is_array($atach_src) ? $atach_src[0] : "";

        $atach_src = wp_get_attachment_image_src($image1, 'full');
        $image1 = is_array($atach_src) ? $atach_src[0] : "";

        $atach_src = wp_get_attachment_image_src($image2, 'full');
        $image2 = is_array($atach_src) ? $atach_src[0] : "";

        $atach_src = wp_get_attachment_image_src($image3, 'full');
        $image3 = is_array($atach_src) ? $atach_src[0] : "";

        $atach_src = wp_get_attachment_image_src($image4, 'full');
        $image4 = is_array($atach_src) ? $atach_src[0] : "";

        $link_text = !empty($link_text) ? '<a href="'.esc_attr($link).'" class="button button-fill button-bordered button-small">'.$link_text.'</a>' : '';
        
    	$result = '<div class="circle-posts mv8 mvt0">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="circle-item" style="background-image:url('.esc_attr($image1).');">
                                    <img src="'.get_template_directory_uri().'/images/8x5.png" class="full-size">
                                    <a href="'.esc_attr($link1).'" class="entry-circle">
                                        <span class="circle-img" style="background-image:url('.esc_attr($image1).');"></span>
                                        <span class="circle-txt">'.$title1.'</span>
                                    </a>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="circle-item" style="background-image:url('.esc_attr($image2).');">
                                    <img src="'.get_template_directory_uri().'/images/8x5.png" class="full-size">
                                    <a href="'.esc_attr($link2).'" class="entry-circle">
                                        <span class="circle-img" style="background-image:url('.esc_attr($image2).');"></span>
                                        <span class="circle-txt">'.$title2.'</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="row mv3 mvb0">
                            <div class="col-sm-6">
                                <div class="circle-item" style="background-image:url('.esc_attr($image3).');">
                                    <img src="'.get_template_directory_uri().'/images/8x5.png" class="full-size">
                                    <a href="'.esc_attr($link3).'" class="entry-circle">
                                        <span class="circle-img" style="background-image:url('.esc_attr($image3).');"></span>
                                        <span class="circle-txt">'.$title3.'</span>
                                    </a>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="circle-item" style="background-image:url('.esc_attr($image4).');">
                                    <img src="'.get_template_directory_uri().'/images/8x5.png" class="full-size">
                                    <a href="'.esc_attr($link4).'" class="entry-circle">
                                        <span class="circle-img" style="background-image:url('.esc_attr($image4).');"></span>
                                        <span class="circle-txt">'.$title4.'</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="circle-post" style="background-image:url('.$image.');">
                            <img src="'.get_template_directory_uri().'/images/1x1.png" class="full-size">
                            <article class="blog-item text-center">
                                <div class="entry-date"><span>'.$sub_title.'</span></div>
                                <h2 class="post-title">'.$title.'</h2>
                                <div class="entry-excerpt text-center">'.$link_text.'</div>
                                <div class="seperator with-colored size-small"><span></span></div>
                            </article>
                        </div>
                    </div>';


        return $result;
    }
}

vc_map( array(
    "name" => esc_html__("Five Circles", 'katharine'),
    "description" => esc_html__("Five Circles Layout", 'katharine'),
    "base" => "tt_five_circles",
    "class" => "",
    "icon" => "icon-wpb-quickload",
    "category" => 'Katharine',
    "show_settings_on_create" => true,
    "params" => array(
        array(
            'type' => 'attach_image',
            "param_name" => "image",
            "heading" => esc_html__("Image", 'katharine')
        ),
        array(
            "type" => "textfield",
            "param_name" => "sub_title",
            "heading" => esc_html__("Sub Title", 'katharine')
        ),
        array(
            "type" => "textfield",
            "param_name" => "title",
            "heading" => esc_html__("Title", 'katharine')
        ),
        array(
            "type" => "textfield",
            "param_name" => "link_text",
            "heading" => esc_html__("Link Text", 'katharine')
        ),
        array(
            "type" => "textfield",
            "param_name" => "link",
            "heading" => esc_html__("Link", 'katharine'),
            "value" => "#"
        ),


        // item - 1
        array(
            'type' => 'attach_image',
            "param_name" => "image1",
            "heading" => esc_html__("Item 1 - Image", 'katharine')
        ),
        array(
            "type" => "textfield",
            "param_name" => "title1",
            "heading" => esc_html__("Item 1 - Title", 'katharine')
        ),
        array(
            "type" => "textfield",
            "param_name" => "link1",
            "heading" => esc_html__("Item 1 - Link", 'katharine'),
            "value" => "#"
        ),

        // item - 2
        array(
            'type' => 'attach_image',
            "param_name" => "image2",
            "heading" => esc_html__("Item 2 - Image", 'katharine')
        ),
        array(
            "type" => "textfield",
            "param_name" => "title2",
            "heading" => esc_html__("Item 2 - Title", 'katharine')
        ),
        array(
            "type" => "textfield",
            "param_name" => "link2",
            "heading" => esc_html__("Item 2 - Link", 'katharine'),
            "value" => "#"
        ),

        // item - 3
        array(
            'type' => 'attach_image',
            "param_name" => "image3",
            "heading" => esc_html__("Item 3 - Image", 'katharine')
        ),
        array(
            "type" => "textfield",
            "param_name" => "title3",
            "heading" => esc_html__("Item 3 - Title", 'katharine')
        ),
        array(
            "type" => "textfield",
            "param_name" => "link3",
            "heading" => esc_html__("Item 3 - Link", 'katharine'),
            "value" => "#"
        ),

        // item - 4
        array(
            'type' => 'attach_image',
            "param_name" => "image4",
            "heading" => esc_html__("Item 4 - Image", 'katharine')
        ),
        array(
            "type" => "textfield",
            "param_name" => "title4",
            "heading" => esc_html__("Item 4 - Title", 'katharine')
        ),
        array(
            "type" => "textfield",
            "param_name" => "link4",
            "heading" => esc_html__("Item 4 - Link", 'katharine'),
            "value" => "#"
        ),

    	
        array(
            "type" => "textfield",
            "param_name" => "extra_class",
            "heading" => esc_html__("Extra Class", 'katharine'),
            "value" => "",
            "description" => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'katharine'),
        )
    )
) );