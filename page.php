<?php get_header(); ?>


<?php
    $page_class = '';

    if( TT::getmeta('remove_padding')=='1' ){
        $page_class .= 'no-padding';
    }
?>


<?php
while ( have_posts() ) : the_post();
    $layout_class = 'col-sm-8 col-md-8';
    $page_layout = TT::getmeta('page_layout');
    if( $page_layout=='full' ){
        $layout_class = 'col-sm-12';
    }
    if( $page_layout=='left' ){
        $layout_class = 'col-sm-8 col-md-8 pull-right';
    }
?>
<section class="section-content <?php echo esc_attr($page_class); ?>">

    <div>
        <div class="row">
            
            <div class="<?php echo esc_attr($layout_class); ?>">

                <article class="blog-item blog-single">

                    <?php
                    $title_show = TT::getmeta('title_show');
                    if( $title_show!='0' ): ?>
                        <?php
                        $page_description = TT::getmeta('page_description');
                        if( !empty($page_description) ): ?>
                        <div class="entry-date">
                            <span><?php print($page_description); ?></span>
                        </div>
                        <?php endif; ?>
                        
                        <h1 class="post-title"><?php the_title(); ?></h1>
                    <?php
                    endif;
                    ?>

                    <div class="entry-excerpt">

                        <?php
                        the_content();

                        wp_link_pages( array(
                            'before'      => '<div class="page-links"><span class="page-links-title">' . esc_html__('Pages:', 'katharine') . '</span>',
                            'after'       => '</div>',
                            'link_before' => '<span>',
                            'link_after'  => '</span>',
                            'pagelink'    => '<span class="screen-reader-text">' . esc_html__('Page', 'katharine') . ' </span>%',
                            'separator'   => '<span class="screen-reader-text">, </span>',
                        ) );
                        ?>

                    </div>


                </article>

                <?php
                if ( TT::get_mod('page_comment')=='1' && (comments_open() || get_comments_number()) ) :
                    comments_template();
                endif;
                ?>

            </div>

            <?php
            if( $page_layout!='full' ){
                global $sidebar;
                $sidebar = 'page';
                get_sidebar();
            }
            ?>

        </div>
    </div>
</section>

<?php endwhile; ?>



<?php get_footer(); ?>