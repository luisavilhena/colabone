<?php

class WPBakeryShortCode_Tt_Hover_Scroll extends WPBakeryShortCode {
    protected function content( $atts, $content = null){
        extract(shortcode_atts(array(
            'image' => '',
            'title' => '',
            'link' => '',
            'extra_class' => ''
        ), $atts));

        $extra_class = esc_attr($extra_class);

        $alt = esc_attr($title);
        $title = !empty($title) ? "<h3>$title</h3>" : "";

        $atach_src = wp_get_attachment_image_src($image, 'full');
        $img = is_array($atach_src) ? $atach_src[0] : "";

        $result = "<div class='welcome-item $extra_class'>
                        <a href='".esc_attr($link)."' style='background-image:url(".esc_attr($img).");'>
                            <img src='".get_template_directory_uri()."/images/4x3.png' alt='$alt'>
                        </a>
                        $title
                    </div>";

        return $result;

    }

}

vc_map( array(
    "name" => esc_html__('Hover Scroll', 'katharine'),
    "description" => esc_html__("Mouse Hover Scroll Item", 'katharine'),
    "base" => 'tt_hover_scroll',
    "icon" => "icon-wpb-themeton",
    "content_element" => true,
    "category" => 'Katharine',
    'params' => array(

        array(
            'type' => 'attach_image',
            "param_name" => "image",
            "heading" => esc_html__("Image", 'katharine')
        ),

        array(
            "type" => 'textfield',
            "param_name" => "title",
            "heading" => esc_html__("Title", 'katharine'),
            "value" => '',
            "holder" => 'div'
        ),

        array(
            "type" => 'textfield',
            "param_name" => "link",
            "heading" => esc_html__("Link", 'katharine'),
            "value" => ''
        ),

        array(
            "type" => "textfield",
            "param_name" => "extra_class",
            "heading" => esc_html__("Extra Class", 'katharine'),
            "value" => "",
            "description" => esc_html__("If you wish text to white. If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'katharine'),
        )
    )
));