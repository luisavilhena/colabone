<?php

class WPBakeryShortCode_Tt_Content_Slider extends WPBakeryShortCode {
    protected function content( $atts, $content = null){
        extract( shortcode_atts( array(
            "layout" => 'standard',
            "arrows" => 'show',
            "bullets" => "show",
            "slider_padding" => "pv16",
            "list" => "",
            "extra_class" => ""
        ), $atts ) );

        $list = vc_param_group_parse_atts($list);
        $lists = '';

        $slider_arrows = "<div class='swiper-button-prev'></div>
                    	  <div class='swiper-button-next'></div>";
        $slider_bullets = "<div class='swiper-pagination'></div>";


        if( $layout!='with-box' ){
        	if( $arrows=='hide' ){ $slider_arrows = ''; }
        	if( $bullets=='hide' ){ $slider_bullets = ''; }
        }

        if( is_array($list) ){
            foreach ($list as $item) {
                $image = isset($item['image']) ? $item['image'] : "";
                $icon_type = isset($item['icon_type']) ? $item['icon_type'] : "fontawesome";
                
                $icon = isset($item["icon_$icon_type"]) ? $item["icon_$icon_type"] : "";
                $icon = !empty($icon) ? "<i class='$icon'></i>" : "";

                if( !empty($icon) ){
                    wp_enqueue_style( "vc_$icon_type" );
                }
                
                
                $sub_title = isset($item['sub_title']) ? $item['sub_title'] : "";
                $sub_title = !empty($sub_title) ? "<div class='entry-date'>$icon<span>$sub_title</span></div>" : "";
                
                $title = isset($item['title']) ? $item['title'] : "";
                $title = !empty($title) ? "<h3 class='post-title'>$title</h3>" : "";
                
                $detail_text = isset($item['detail_text']) ? $item['detail_text'] : "";
                $detail_text = !empty($detail_text) ? "<p>$detail_text</p>" : "";

                $link = isset($item['link']) ? $item['link'] : "";

                $link_text = isset($item['link_text']) ? $item['link_text'] : "";
                $link_text = !empty($link_text) ? "<a href='$link' class='button button-fill button-bordered button-small'>$link_text</a>" : "";

                $atach_src = wp_get_attachment_image_src($image, 'full');
            	$image = is_array($atach_src) ? $atach_src[0] : "";


            	if( $layout!='with-box' ){
            		$link_text = !empty($link_text) ? "$link_text<br>" : "";
            		$lists .= "<div class='swiper-slide $slider_padding' style='background-image:url(".esc_attr($image).");'>
	                                <div class='container'>
	                                    <div class='row'>
	                                        <div class='col-sm-12 col-md-10 col-md-offset-1 col-lg-8 col-lg-offset-2'>
	                                            <div class='blog-item-boxed'>
	                                                $sub_title
	                                                $title
	                                                $detail_text
	                                                $link_text
	                                                <div class='seperator with-colored size-small'><span></span></div>
	                                            </div>
	                                        </div>
	                                    </div>
	                                </div>
	                            </div>";
            	}
            	else{
            		$lists .= "<div class='swiper-slide'>
			                            <article class='blog-item'>
			                                <div class='entry-media'>
			                                    <a href='javascript:;' class='el-link'>
			                                        <img src='".esc_attr($image)."' alt='blog image'>
			                                        <div class='entry-overlay'></div>
			                                    </a>
			                                </div>
			                                <div class='entry-box'>
			                                    <div class='container'>
			                                        <div class='row'>
			                                            <div class='col-sm-10 col-sm-offset-1 entry-box-bg pv4 pvb0 text-center'>
			                                                $sub_title
			                                                $title
			                                                <div class='entry-excerpt text-center'>
			                                                    $link_text
			                                                </div>
			                                                <div class='seperator with-colored size-small'><span></span></div>
			                                            </div>
			                                        </div>
			                                    </div>
			                                </div>
			                            </article>
			                        </div>";
            	}

            }
        }


        if( $layout=='with-box' ){
        	$result = "<div class='fullwidth-post-slider ".esc_attr($extra_class)."'>
			                <div class='swiper-container'>
			                    <div class='swiper-wrapper'>$lists</div>
			                </div>
			                $slider_arrows
		                    $slider_bullets
			            </div>";
        }
        else{
        	$result = "<div class='katharine-post-slider ".esc_attr($extra_class)."'>
		                    <div class='swiper-container'>
		                        <div class='swiper-wrapper'>$lists</div>
		                    </div>
		                    $slider_arrows
		                    $slider_bullets
		                </div>";
        }


        return $result;
    }
}

vc_map( array(
    "name" => esc_html__("Content Slider", 'katharine'),
    "description" => esc_html__("Swiper Content Slider", 'katharine'),
    "base" => "tt_content_slider",
    "class" => "",
    "icon" => "icon-wpb-quickload",
    "category" => 'Katharine',
    "show_settings_on_create" => true,
    "params" => array(
    	array(
            "type" => "dropdown",
            "param_name" => "layout",
            "heading" => esc_html__("Layout", 'katharine'),
            "value" => array(
                "Standard" => "standard",
                "With Box" => "with-box"
            ),
            "std" => "standard"
        ),
        array(
            "type" => "dropdown",
            "param_name" => "arrows",
            "heading" => esc_html__("Slider Arrows", 'katharine'),
            "value" => array(
                "Show" => "show",
                "Hide" => "hide"
            ),
            "std" => "show",
            "dependency" => Array("element" => "layout", "value" => array("standard"))
        ),
        array(
            "type" => "dropdown",
            "param_name" => "bullets",
            "heading" => esc_html__("Slider Bullets", 'katharine'),
            "value" => array(
                "Show" => "show",
                "Hide" => "hide"
            ),
            "std" => "show",
            "dependency" => Array("element" => "layout", "value" => array("standard"))
        ),
        array(
            "type" => "dropdown",
            "param_name" => "slider_padding",
            "heading" => esc_html__("Slider Padding", 'katharine'),
            "value" => array(
                "160px" => "pv16",
                "150px" => "pv15",
                "140px" => "pv14",
                "130px" => "pv13",
                "120px" => "pv12",
                "110px" => "pv11",
                "100px" => "pv10"
            ),
            "std" => "pv16",
            "dependency" => Array("element" => "layout", "value" => array("standard"))
        ),
        array(
            'type' => 'param_group',
            'heading' => esc_html__('Values', 'katharine'),
            'param_name' => 'list',
            'value' => '',
            'params' => array(
            	array(
		            'type' => 'attach_image',
		            "param_name" => "image",
		            "heading" => esc_html__("Image", 'katharine')
		        ),

            	array(
		            'type' => 'dropdown',
		            'heading' => esc_html__('Icon library', 'katharine'),
		            'value' => array(
		                esc_html__('Font Awesome', 'katharine') => 'fontawesome',
		                esc_html__('Open Iconic', 'katharine') => 'openiconic',
		                esc_html__('Typicons', 'katharine') => 'typicons',
		                esc_html__('Entypo', 'katharine') => 'entypo',
		                esc_html__('Linecons', 'katharine') => 'linecons'
		            ),
		            'param_name' => 'icon_type',
		            'description' => esc_html__('Select icon library.', 'katharine'),
		        ),
		        array(
		            'type' => 'iconpicker',
		            'heading' => esc_html__('Icon', 'katharine'),
		            'param_name' => 'icon_fontawesome',
		            'value' => 'fa fa-info-circle',
		            'settings' => array(
		                'emptyIcon' => false, // default true, display an "EMPTY" icon?
		                'iconsPerPage' => 4000, // default 100, how many icons per/page to display
		            ),
		            'dependency' => array(
		                'element' => 'icon_type',
		                'value' => 'fontawesome',
		            ),
		            'description' => esc_html__('Select icon from library.', 'katharine'),
		        ),
		        array(
		            'type' => 'iconpicker',
		            'heading' => esc_html__('Icon', 'katharine'),
		            'param_name' => 'icon_openiconic',
		            'settings' => array(
		                'emptyIcon' => false, // default true, display an "EMPTY" icon?
		                'type' => 'openiconic',
		                'iconsPerPage' => 4000, // default 100, how many icons per/page to display
		            ),
		            'dependency' => array(
		                'element' => 'icon_type',
		                'value' => 'openiconic',
		            ),
		            'description' => esc_html__('Select icon from library.', 'katharine'),
		        ),
		        array(
		            'type' => 'iconpicker',
		            'heading' => esc_html__('Icon', 'katharine'),
		            'param_name' => 'icon_typicons',
		            'settings' => array(
		                'emptyIcon' => false, // default true, display an "EMPTY" icon?
		                'type' => 'typicons',
		                'iconsPerPage' => 4000, // default 100, how many icons per/page to display
		            ),
		            'dependency' => array(
		                'element' => 'icon_type',
		                'value' => 'typicons',
		            ),
		            'description' => esc_html__('Select icon from library.', 'katharine'),
		        ),
		        array(
		            'type' => 'iconpicker',
		            'heading' => esc_html__('Icon', 'katharine'),
		            'param_name' => 'icon_entypo',
		            'settings' => array(
		                'emptyIcon' => false, // default true, display an "EMPTY" icon?
		                'type' => 'entypo',
		                'iconsPerPage' => 4000, // default 100, how many icons per/page to display
		            ),
		            'dependency' => array(
		                'element' => 'icon_type',
		                'value' => 'entypo',
		            ),
		        ),
		        array(
		            'type' => 'iconpicker',
		            'heading' => esc_html__('Icon', 'katharine'),
		            'param_name' => 'icon_linecons',
		            'settings' => array(
		                'emptyIcon' => false, // default true, display an "EMPTY" icon?
		                'type' => 'linecons',
		                'iconsPerPage' => 4000, // default 100, how many icons per/page to display
		            ),
		            'dependency' => array(
		                'element' => 'icon_type',
		                'value' => 'linecons',
		            ),
		            'description' => esc_html__('Select icon from library.', 'katharine'),
		        ),

		        // title text
                array(
                    'type' => 'textfield',
                    'heading' => esc_html__('Sub title text', 'katharine'),
                    'param_name' => 'sub_title',
                    'value' => 'Sub Title'
                ),
                array(
                    'type' => 'textfield',
                    'heading' => esc_html__('Title text', 'katharine'),
                    'param_name' => 'title',
                    'admin_label' => true,
                    'value' => 'Title'
                ),
                array(
                    'type' => 'textfield',
                    'heading' => esc_html__('Detail text', 'katharine'),
                    'param_name' => 'detail_text'
                ),
                array(
                    'type' => 'textfield',
                    'heading' => esc_html__('Link text', 'katharine'),
                    'param_name' => 'link_text',
                    'value' => 'Read More'
                ),
                array(
                    'type' => 'textfield',
                    'heading' => esc_html__('Link', 'katharine'),
                    'param_name' => 'link',
                    'value' => '#'
                )
            )
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