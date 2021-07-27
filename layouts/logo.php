<?php
$logo = TT::get_mod('logo');
$logo_class = !empty($logo) ? 'logo-image' : 'logo-text';
?>
<a href="<?php echo esc_url(home_url('/')); ?>" id="logo" class="<?php echo esc_attr($logo_class); ?>" title="<?php echo esc_attr(get_bloginfo('name')); ?>">
    <?php bloginfo( 'name' ); ?>
</a>