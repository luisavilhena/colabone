<?php get_header(); ?>


<section class="section-content">

    <div class="container">
        <div class="row">
            
            <div class="col-sm-8 col-md-8">

                
                <?php
                // Start the loop.
                while ( have_posts() ) : the_post();
                    get_template_part( 'content', get_post_format() );

                    if ( TT::get_mod('post_comment')=='1' && (comments_open() || get_comments_number()) ) :
                        comments_template();
                    endif;
                    
                endwhile;
                ?>

            </div>

            <?php get_sidebar(); ?>

        </div>
    </div>
</section>



<?php get_footer(); ?>