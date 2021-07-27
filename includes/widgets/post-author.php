<?php

class tt_PostAuthorWidget extends WP_Widget {

    function __construct() {
        $widget_ops = array('classname' => 'widget_social text-center', 'description' => 'Post Single Author Info');
        parent::__construct(false, ': Post Author', $widget_ops);
    }
    function widget($args, $instance) {
        extract($args);
        $title = apply_filters('widget_title', $instance['title']);
       
            global $post;
            echo '<div class="widget about-author">
                        '.get_avatar($post->post_author, 358, '', '', array('width'=>358, 'height'=>437)).'
                        <div class="overlay"></div>
                        <div class="entry-info">
                            <h6>'.$title.'</h6>
                            <h3>'.get_the_author_meta('display_name', $post->post_author).'</h3>
                            <div class="seperator"><span></span></div>
                            <p>'.get_the_author_meta('description', $post->post_author).'</p>
                        </div>
                    </div>';
       
    }

    function update($new_instance, $old_instance) {
        $instance = $old_instance;
        global $tt_social_icons;
        /* Strip tags (if needed) and update the widget settings. */
        $instance['title'] = sanitize_text_field($new_instance['title']);
        return $instance;
    }

    function form($instance) {
        ?>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('title')); ?>">Widget Title:</label>
            <input type="text" class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" value="<?php echo esc_attr(isset($instance['title']) ? $instance['title'] : ''); ?>"  />
        </p>
        <?php
    }
}


add_action('widgets_init', create_function('', 'return register_widget("tt_PostAuthorWidget");'));

?>