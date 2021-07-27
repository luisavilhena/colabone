<?php get_header(); ?>


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
						<!-- Remoção barra de pesquisa -->
						
						<!--
							<div class="row">
								<div class="col-sm-10 col-sm-offset-1">
									<form class="search_form" action="<?php echo esc_url(home_url('/')); ?>" method="get">
										<input type="text" name="s" placeholder="<?php esc_attr_e('O que você procura?', 'katharine'); ?>">
										<button type="submit">Buscar</button>
									</form>
								</div>
							</div>
						-->
						
<!--
                        <p class="text-center">
                            <?php esc_html_e('Took a whole lotta trying just to get up that hill just two good old boys Would not change if they could fighting the system like a true modern day robin hood we are gonna do it on your mark', 'katharine'); ?>
                        </p>
-->
                    </div>

                    <div class="seperator"><span></span></div>

                </article>


            </div>



        </div>
    </div>
</section>

<?php get_footer(); ?>