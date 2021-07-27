<?php get_header(); ?>


 <!--
	Substituição:
	No post -> 404 not found	

	<section class="section-content">

    <div class="container">

        <div class="row">
            
            <div class="col-sm-8 col-md-8">

                <?php
                if ( have_posts() ):
                    // Start the loop.
                    while ( have_posts() ) : the_post();
                        get_template_part( 'content', get_post_format() );
                    endwhile;

                // If no content, include the "No posts found" template.
                else :
                    get_template_part( 'content', 'none' );
                endif;
                ?>

                <?php
                $pagination = TPL::pagination();
                if( !empty($pagination) ){
                    echo "<div class='post-navigation mv10'>$pagination</div>";
                }
                ?>


            </div>

            <?php //get_sidebar(); ?>

        </div>
    </div>
</section>

-->

<section class="section-content">

    <div class="container">
        <div class="row">
            
            <div class="col-sm-12 col-md-12">

                <article class="blog-item blog-single">

                    <div class="entry-date">
                        <span><?php esc_html_e('PÁGINA NÃO ENCONTRADA', 'katharine'); ?></span>
                    </div>

                    <h1 class="post-title">
                        <?php echo wp_kses( __('Desculpe, a página que você está pesquisando<br>não foi encontrada!', 'katharine'), array('br'=>array()) ); ?>
                    </h1>

                    <div class="entry-excerpt">

                        <h2 class="big-text text-center"><?php esc_html_e('404', 'katharine'); ?></h2>

                        <br>

						
                    </div>

                    <div class="seperator"><span></span></div>

                </article>


            </div>



        </div>
    </div>
</section>

<?php get_footer(); ?>