        <footer id="footer">
<style>

footer#footer .sub-footer .widget p {
font-size: 12px !important;
} 

</style>
            
            <div class="container footer-container">
                <div class="row">

                    <?php
                    $footer_col = 4;
                    $footer_columns = array();
                    $footer_style = TT::get_mod('footer_style');
                    switch($footer_style){
                        case '1':
                            $footer_col = 1;
                            $footer_columns = array(
                                    'col-sm-12'
                                );
                            break;
                        case '2':
                            $footer_col = 2;
                            $footer_columns = array(
                                    'col-sm-6',
                                    'col-sm-6'
                                );
                            break;
                        case '3':
                            $footer_col = 3;
                            $footer_columns = array(
                                    'col-sm-4',
                                    'col-sm-4',
                                    'col-sm-4'
                                );
                            break;
                        case '4':
                            $footer_col = 4;
                            $footer_columns = array(
                                    'col-sm-6 col-md-3',
                                    'col-sm-6 col-md-3',
                                    'col-sm-6 col-md-3',
                                    'col-sm-6 col-md-3'
                                );
                            break;
                        case '5':
                            $footer_col = 4;
                            $footer_columns = array(
                                    'col-sm-6 col-md-4',
                                    'col-sm-6 col-md-2',
                                    'col-sm-6 col-md-3',
                                    'col-sm-6 col-md-3'
                                );
                            break;
                        default:
                            $footer_col = 4;
                            $footer_columns = array(
                                    'col-sm-6 col-md-4',
                                    'col-sm-6 col-md-3',
                                    'col-sm-6 col-md-2',
                                    'col-sm-6 col-md-3'
                                );
                            break;
                    }

                    for ($i = 1; $i <= $footer_col; $i++) {
                        echo "<div class='".$footer_columns[$i - 1]." footer-column-$i'>";
                            dynamic_sidebar('footer'.$i);
                        echo "</div>";
                    }
                    ?>

                </div>
            </div>


            <div class="sub-footer">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-6">
                            
                            <div class="widget">
                                <div class="social-links">
                                    <?php TPL::get_social_links(); ?>
                                </div>
                            </div>

                            <div class="widget">
                                <p>© 2019 Clínica Colabone. Todos os direitos reservados.</p>
                            </div>
                            
                        </div>

                        <div class="col-md-6">
                           <div class="widgetvollup">
                                <div class="social-links">
                                    <?php TPL::get_social_links(); ?>
                                </div>
                            </div>
                          <div class="widget">
                                <p class="tamanho">Desenvolvido por:</p>
					<a href="https://www.vollup.com" target="_blank"><img class="size-full wp-image-3100 alignnone" src="/wp-content/uploads/2019/07/vollup.png" alt="" width="60" height="18"></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </footer>

<!-- <?php echo TT::get_mod('copyright_content'); ?>-->