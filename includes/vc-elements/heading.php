<?php

class WPBakeryShortCode_Heading extends WPBakeryShortCode {
    protected function content( $atts, $content = null){
        extract(shortcode_atts(array(
            'title' => '',
            'sub_title' => '',
            'extra_class' => ''
        ), $atts));

        $return = "<div class='heading text-center ".esc_attr($extra_class)."'>
                        <h6>$sub_title</h6>
                        <h4>$title</h4>
                    </div>";

        return $return;
    }
}

vc_map( array(
    "name" => esc_html__('Heading', 'katharine'),
    "description" => esc_html__("Heading Title", 'katharine'),
    "base" => 'heading',
    "icon" => "icon-wpb-themeton",
    "content_element" => true,
    "category" => 'Katharine',
    'params' => array(
        array(
            "type" => 'textfield',
            "param_name" => "title",
            "heading" => esc_html__("Title", 'katharine'),
            "value" => '',
            "holder" => 'div'
        ),
        array(
            "type" => 'textfield',
            "param_name" => "sub_title",
            "heading" => esc_html__("Sub Title", 'katharine'),
            "value" => ''
        ),
        array(
            "type" => "textfield",
            "param_name" => "extra_class",
            "heading" => esc_html__("Extra Class", 'katharine'),
            "value" => "",
            "description" => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'katharine'),
        )
    )
));