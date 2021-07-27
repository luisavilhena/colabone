<?php

$content_class = 'blog-item';
if( is_single() ){
    $content_class .= ' blog-single';
}
else{
    $content_class .= ' blog-loop';
}

$format = get_post_format();

$loop_quote_link = !is_single() && ($format=='quote' || $format=='link');
$loop_quote_link_media = '';
if( $loop_quote_link ){
    $loop_quote_link_media = TPL::get_post_media();
    if( strlen($loop_quote_link_media)<40 ){
        $loop_quote_link = false;
    }
}

if( $loop_quote_link ){
    $content_class .= ' loop-quote-link';
}

?>
<article <?php post_class($content_class); ?>>

    <div class="entry-date">
        <img src="<?php echo get_template_directory_uri(); ?>/images/svg/clock.svg" alt="clock icon" class="icon-clock">
        <span>
            <?php the_time('M d, Y'); ?>  -  
            <?php
            $categories = get_the_category();
            $output = '';
            if( !empty($categories) ){
                foreach( $categories as $category ){
                    $output = '<a href="' . esc_url( get_category_link( $category->term_id ) ) . '" alt="' . esc_attr( sprintf( esc_html__('View all posts in %s', 'katharine'), $category->name ) ) . '">' . esc_html( $category->name ) . '</a>';
                }
            }
            printf($output);
            ?>
        </span>
    </div>


    <?php if( is_single() ): ?>
        <h1 class="post-title"><?php the_title(); ?></h1>
    <?php else: ?>
        <h2 class="post-title">
            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
        </h2>
    <?php endif; ?>



    <?php
    if( !is_single() && $loop_quote_link ): 
        print($loop_quote_link_media); ?>
    <?php
    elseif( !is_single() && has_post_thumbnail() ): ?>
    <div class="entry-media">
        <a href="<?php the_permalink(); ?>" class="el-link">
            <?php echo wp_get_attachment_image( get_post_thumbnail_id(), 'hs-post-thumb' ); ?>
            <div class="entry-overlay"></div>
        </a>
    </div>
    <?php endif; ?>

    
    <?php
    if( is_single() ):
        echo TPL::get_post_media();
    endif;
    ?>




    <div class="entry-meta">
        <span>
           
            <span> <?php echo tt_get_post_like(true); ?></span>
            <img src="<?php echo get_template_directory_uri(); ?>/images/svg/comment.svg" alt="svg image">
            <span><?php comments_number('0', '1', '%'); ?></span>
        </span>
    </div>




    <?php if( !is_single() ): ?>
    <div class="entry-excerpt text-center">
        
        <?php
        $more_link = '<br><a href="'.get_permalink().'" class="button button-fill button-bordered button-small">'.esc_html__('Read More', 'katharine').'</a>';
        if(strpos($post->post_content, '<!--more-->') > 0) :
            printf('<p>%s</p>', get_the_content(esc_html__('MORE >', 'katharine') ));
        elseif(has_excerpt()) :
            printf('<p>%s</p>%s', wp_strip_all_tags(get_the_excerpt()), $more_link );
        else :
            printf( '<p>%s</p>%s', TPL::clear_urls(wp_trim_words( wp_strip_all_tags(do_shortcode(get_the_content())), 30 )), $more_link );
        endif;
        ?>
    </div>
    <?php else: ?>
    <div class="entry-excerpt">
        <?php the_content();
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
    <?php endif; ?>
    


    
    <?php if( is_single() ): ?>
    <div class="entry-social">
        <?php $socials = TPL::get_share_links(); ?>
        <a href="<?php printf('%s', $socials['facebook']); ?>"><i class="fa fa-facebook"></i></a>
        <a href="<?php printf('%s', $socials['twitter']); ?>"><i class="fa fa-twitter"></i></a>
        <a href="<?php printf('%s', $socials['googleplus']); ?>"><i class="fa fa-google-plus"></i></a>
    </div>
    <?php endif; ?>



    <div class="seperator"><span></span></div>


    <?php if( is_single() ): ?>
    <br>
    <div class="author-info">
        <a href="javascript:;" class="author-image">
            <?php echo get_avatar($post->post_author, 129); ?>
        </a>
        <div class="info-entry">
            <div class="info-title">
                <h5><?php the_author_posts_link(); ?></h5>
                <p><?php echo get_the_author_meta('description'); ?></p>
                <div class="info-social">
                    <?php
                    $facebook = get_the_author_meta('facebook', $post->post_author);
                    $twitter = get_the_author_meta('twitter', $post->post_author);
                    $tumblr = get_the_author_meta('tumblr', $post->post_author);
                    $gplus = get_the_author_meta('gplus', $post->post_author);
                    ?>
                    <a href="<?php echo esc_attr($facebook); ?>" class="fb"><i class="fa fa-facebook"></i></a>
                    <a href="<?php echo esc_attr($twitter); ?>" class="tw"><i class="fa fa-twitter"></i></a>
                    <a href="<?php echo esc_attr($gplus); ?>" class="gp"><i class="fa fa-google-plus"></i></a>
                    <a href="<?php echo esc_attr($tumblr); ?>" class="tm"><i class="fa fa-tumblr"></i></a>
                </div>
            </div>
        </div>
    </div>
    <?php endif; ?>


</article>