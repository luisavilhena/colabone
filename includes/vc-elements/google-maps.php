<?php

class WPBakeryShortCode_Google_Map extends WPBakeryShortCode {
    protected function content( $atts, $content = null){
        extract( shortcode_atts( array(
            "lat" => '40.7797115',
            "lng" => '-74.1755574',
            "color" => '',
            "saturation" => "-100",
            "zoom" => '16',
            "map_height" => '550',
            "marker" => '',
            "title" => 'Keep in touch',
            "list" => ''
        ), $atts ) );

        $list = vc_param_group_parse_atts($list); 
        $lists = '';

        if( is_array($list) ){
            foreach ($list as $item) {
                $text = isset($item['text']) ? $item['text'] : "Address text";
                $icon = isset($item['icon']) ? $item['icon'] : "fa fa-map-marker";

                $lists .= '<div class="gmap-item">
                                <label><i class="'.esc_attr($icon).'"></i></label>
                                <span>'.$text.'</span>
                            </div>';
            }
        }

        wp_enqueue_script( 'google-map-config', get_template_directory_uri() . '/js/google-maps.js');
        wp_enqueue_script( 'google-map', '//maps.googleapis.com/maps/api/js?callback=initMap');

        $image_src = !empty($marker) ? wp_get_attachment_image_src($marker, 'thumbnail') : '';
        $marker = !empty($image_src) ? $image_src[0] : get_template_directory_uri() . '/images/icon-marker.svg';

        $result = '<div id="tt-google-map" style="height:'.abs($map_height).'px;" class="tt-google-map" data-lat="'.esc_attr($lat).'" data-lng="'.esc_attr($lng).'" data-zoom="'.abs($zoom).'" data-saturation="'.esc_attr($saturation).'" data-color="'.esc_attr($color).'" data-marker="'.esc_attr($marker).'">
                        <div id="gmap_content">
                            <div class="gmap-item">
                                <label class="label-title">'.$title.'</label>
                            </div>
                            '.$lists.'
                        </div>
                    </div>';

        return $result;
    }
}

vc_map( array(
    "name" => esc_html__("Google Map", 'katharine'),
    "description" => esc_html__("Google Maps Latitude, Longitude", 'katharine'),
    "base" => "google_map",
    "class" => "",
    "icon" => "icon-wpb-themeton",
    "category" => 'Katharine',
    "show_settings_on_create" => true,
    "params" => array(
        array(
            'type' => 'textfield',
            "param_name" => "lat",
            "heading" => esc_html__("Latitude", 'katharine'),
            "value" => '',
            'description' => '-37.831208'
        ),
        array(
            'type' => 'textfield',
            "param_name" => "lng",
            "heading" => esc_html__("Longitude", 'katharine'),
            "value" => '',
            "description" => '144.998499'
        ),
        
        array(
            'type' => 'colorpicker',
            "param_name" => "color",
            "heading" => esc_html__("Hue Color", 'katharine'),
            "value" => '',
        ),
        array(
            'type' => 'textfield',
            "param_name" => "saturation",
            "heading" => esc_html__("Saturation", 'katharine'),
            "value" => '-100',
            "description" => '(a floating point value between -100 and 100)'
        ),
        
        array(
            'type' => 'textfield',
            "param_name" => "zoom",
            "heading" => esc_html__("Zoom", 'katharine'),
            "value" => '16',
            "desc"  => 'Zoom levels 0 to 18'
        ),
        array(
            'type' => 'textfield',
            "param_name" => "map_height",
            "heading" => esc_html__("Height", 'katharine'),
            "value" => ''
        ),
        array(
            'type' => 'attach_image',
            "param_name" => "marker",
            "heading" => esc_html__("Marker Image", 'katharine'),
            "value" => ''
        ),

        array(
            'type' => 'textfield',
            "param_name" => "title",
            "heading" => esc_html__("Address Title", 'katharine'),
            "value" => '',
            'holder' => 'div'
        ),
        array(
            'type' => 'param_group',
            'heading' => esc_html__('Address Content', 'katharine'),
            'param_name' => 'list',
            'params' => array(
                array(
                    'type' => 'iconpicker',
                    "param_name" => "icon",
                    "heading" => esc_html__("Icon", 'katharine'),
                    'value' => 'fa fa-map-marker'
                ),
                array(
                    'type' => 'textfield',
                    'heading' => esc_html__('Item text', 'katharine'),
                    'param_name' => 'text',
                    'admin_label' => true
                )
            )
        )
    )
) );