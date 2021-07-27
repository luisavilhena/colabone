<?php get_header(); ?>


<section class="section-content">

    <div class="container">

        <div class="row">
            
            <div class="col-sm-8 col-md-8">

                <?php
                while ( have_posts() ) : the_post();
                    get_template_part( 'content', get_post_format() );
                endwhile;
                ?>

                <?php
                $pagination = TPL::pagination();
                if( !empty($pagination) ){
                    echo "<div class='post-navigation mv10'>$pagination</div>";
                }
                ?>


            </div>

            <?php get_sidebar(); ?>

        </div>
    </div>
</section>



<?php get_footer(); ?>