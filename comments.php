<?php

if ( post_password_required() ) {
    return;
}


// Filter: get_comment_author_link
add_filter('get_comment_author_link', 'kf_get_comment_author_link');

if( !function_exists('kf_get_comment_author_link') ):
function kf_get_comment_author_link( $comment_ID ){
    $comment = get_comment( $comment_ID );
    $url     = get_comment_author_url( $comment );
    $author  = get_comment_author( $comment );
 
    if ( empty( $url ) || 'http://' == $url ){
        $return = $author;
    }
    else{
        $return = "<a href='$url' rel='external nofollow' class='comment-author'>$author</a>";
    }

    return $return;
}
endif;




if( !function_exists('kf_custom_comment_item') ):
function kf_custom_comment_item($comment, $args, $depth) {
    $GLOBALS['comment'] = $comment;

    if ( 'div' == $args['style'] ) {
        $tag = 'div';
        $add_below = 'comment';
    } else {
        $tag = 'li';
        $add_below = 'div-comment';
    }

    switch ( $comment->comment_type ) :
        case 'pingback' :
        case 'trackback' :
    ?>
    
    <<?php echo esc_attr($tag); ?> class="post pingback">
        <p><?php esc_html_e('Pingback:', 'katharine'); ?> <?php comment_author_link(); ?><?php edit_comment_link( esc_html__('Edit', 'katharine'), '<span class="edit-link">', '</span>' ); ?></p>
    <?php
            break;
        default:
    ?>

    <<?php echo esc_attr($tag); ?> <?php comment_class( empty( $args['has_children'] ) ? '' : 'parent' ) ?> id="comment-<?php comment_ID() ?>">

    <article>
        <div class="comment-avatar">
            <?php echo get_avatar( $comment, 105 ); ?>
        </div>

        <div class="comment-body">
            <div class="meta-data">
                <?php echo get_comment_author_link(); ?>
                <span class="comment-date">
                    <?php printf( '%1$s', get_comment_date() ); ?> <?php esc_html_e('at', 'katharine'); ?> <?php printf( '%1$s', get_comment_time() ); ?>
                </span>
            </div>
            <div class="comment-content">
                <?php comment_text(); ?>
            </div>
            <span class="comment-reply">
                <?php comment_reply_link( array_merge( $args, array( 'add_below' => $add_below, 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
            </span>
        </div>
    </article>

<?php
            break;
    endswitch;
}
endif;







// Comment Navigation
if ( ! function_exists( 'tt_theme_comment_nav' ) ) :
    function tt_theme_comment_nav() {
        // Are there comments to navigate through?
        if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) :
        ?>
        <nav class="navigation comment-navigation" role="navigation">
            <h2 class="screen-reader-text"><?php esc_html_e('Comment navigation', 'katharine'); ?></h2>
            <div class="nav-links">
                <?php
                    if ( $prev_link = get_previous_comments_link( esc_html__('Older Comments', 'katharine') ) ) :
                        printf( '<div class="nav-previous">%s</div>', $prev_link );
                    endif;

                    if ( $next_link = get_next_comments_link( esc_html__('Newer Comments', 'katharine') ) ) :
                        printf( '<div class="nav-next">%s</div>', $next_link );
                    endif;
                ?>
            </div><!-- .nav-links -->
        </nav><!-- .comment-navigation -->
        <?php
        endif;
    }
endif;




?>


<div id="comments" class="comments-area">
    
    <?php if ( have_comments() ) : ?>
    <div class="comments-wrapper">

        <h2 class="comments-title">
            <?php
                printf( _nx( 'One comment', 'Comments (%1$s)', get_comments_number(), 'comment', 'katharine' ),
                    number_format_i18n( get_comments_number() ), get_the_title() );
            ?>
        </h2>

        <?php tt_theme_comment_nav(); ?>

        <ol class="comment-list">
            <?php
                wp_list_comments( array(
                    'style'       => 'ol',
                    'short_ping'  => true,
                    'avatar_size' => 56,
                    'callback'    => 'kf_custom_comment_item'
                ) );
            ?>
        </ol><!-- .comment-list -->

        <?php tt_theme_comment_nav(); ?>

    </div>
    <?php endif; // have_comments() ?>


    <?php
    // If comments are closed and there are comments, let's leave a little note, shall we?
    if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :
    ?>
        <p class="no-comments"><?php esc_html_e('Comments are closed.', 'katharine'); ?></p>
    <?php endif; ?>


    <?php
        $req = get_option( 'require_name_email' );
        $aria_req = ( $req ? " aria-required='true'" : '' );
        comment_form(
            array(
                'comment_notes_after' => '',
                'class_submit' => '',
                'fields' => array(
                    'author' => '<div class="row">
                                        <p class="comment-form-author col-sm-6">
                                            <input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) .
                                        '" size="30" placeholder="'.esc_attr__('Name *', 'katharine').'" ' . $aria_req . ' /></p>',

                    'email' => '<p class="comment-form-email col-sm-6">
                                    <input id="email" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) .
                                    '" size="30" placeholder="'.esc_attr__('Email *', 'katharine').'" ' . $aria_req . ' /></p></div>',

                    'url' => '<p class="comment-form-url">
                                    <input id="url" name="url" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) .
                                    '" size="30" placeholder="'.esc_attr__('Website', 'katharine').'" /></p>',
                ),
                'comment_field' => '<p class="comment-form-comment">
                                        <textarea id="comment" name="comment" placeholder="'.esc_attr__('Comments', 'katharine').'"></textarea></p>'
            )
        );
    ?>
    
</div>