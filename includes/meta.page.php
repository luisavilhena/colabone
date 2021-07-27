<?php

class CurrentThemePageMetas extends TTRenderMeta{

    function __construct(){
        $this->items = $this->items();
        add_action('admin_enqueue_scripts', array($this, 'print_admin_scripts'));
        add_action('add_meta_boxes', array($this, 'add_custom_meta'), 1);
        add_action('edit_post', array($this, 'save_post'), 99);
    }

    public function items(){
        global $post;

        define('ADMIN_IMAGES', get_template_directory_uri().'/framework/admin-assets/images/');

        $tmp_arr = array(
            'page' => array(
                'label' => 'Page Options',
                'post_type' => 'page',
                'items' => array(
                    array(
                        'name' => 'page_layout',
                        'type' => 'thumbs',
                        'label' => 'Page Layout',
                        'default' => 'right',
                        'option' => array(
                            'full' => ADMIN_IMAGES . '1col.png',
                            'right' => ADMIN_IMAGES . '2cr.png',
                            'left' => ADMIN_IMAGES . '2cl.png'
                        ),
                        'desc' => 'Select Page Layout (Fullwidth | Right Sidebar | Left Sidebar)'
                    ),

                    array(
                        'type' => 'checkbox',
                        'name' => 'title_show',
                        'label' => 'Page Title Show',
                        'default' => '1'
                    ),

                    array(
                        'type' => 'text',
                        'name' => 'page_description',
                        'label' => 'Page description',
                        'default' => '',
                        'dependency' => array("element" => "title_show", "value" => "1")
                    )

                )
            )
            
        );

        return $tmp_arr;
    }
    
}

new CurrentThemePageMetas();

?>