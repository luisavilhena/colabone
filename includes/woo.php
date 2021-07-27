<?php
class TT_WooCommerce{
    public $size = 'woo-item';

    function __construct(){
        add_theme_support( 'woocommerce' );

        add_filter('woocommerce_show_page_title', array($this, 'woo_page_title'));

        /* WOO PAGINATION HOOK
        =============================================*/
        remove_action('woocommerce_after_shop_loop', 'woocommerce_pagination', 10);
        add_action( 'woocommerce_after_shop_loop', array($this, 'woo_pagination'), 10);

        add_filter( 'loop_shop_columns', array($this, 'wc_loop_shop_columns'), 1, 10 );

        add_action( 'woocommerce_before_shop_loop_item_title', array($this, 'ttwc_st_before_shop_loop_item_title'), 10);
        remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10);

        // woocommerce_before_shop_loop_item
        add_action( 'woocommerce_before_shop_loop_item', array($this, 'before_shop_loop_item'), 0, 0 );
        add_action( 'woocommerce_after_shop_loop_item', array($this, 'after_shop_loop_item'), 99, 0 );
        
    }

    public function woo_page_title() {
        return false;
    }

    public function woo_pagination() {
        global $wp_query;
        echo '<div class="row pagination m0">';
            TPL::pagination($wp_query);
        echo '</div>';
    }

    public function wc_loop_shop_columns( $number_columns ){
        return 3;
    }


    public function ttwc_st_before_shop_loop_item_title($param){
        global $product;
        
        $id = get_the_ID();
        
        echo "<section>";

            $first_img = $this->gallery_first_thumbnail( $id , 'tt-woo-thumb');
            if( has_post_thumbnail() ){
                $fimage = wp_get_attachment_image(get_post_thumbnail_id($id), 'tt-woo-thumb', false, array('class'=>'img-responsive'));
                echo $fimage;
            }
            
        echo "</section>";
    }


    public function gallery_first_thumbnail($id, $size){
        $active_hover = true;

        if(!empty($active_hover)){
            $product_gallery = get_post_meta( $id, '_product_image_gallery', true );
            
            if(!empty($product_gallery)){
                $gallery    = explode(',',$product_gallery);
                $image_id   = $gallery[0];
                $image      = wp_get_attachment_image_src( $image_id, $size );
                
                if(!empty($image)) return $image;
            }
        }
        return '';
    }



    public function before_shop_loop_item(){
        global $product, $post;

        $price_html = '';
        if ( $product->get_price_html() ){
            $price_html = $product->get_price_html();
        }

        $thumb = '';
        if( has_post_thumbnail() ){
            $img = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'tt-woo-thumb');
            $thumb = $img[0];
        }
        else{
            $thumb = $this->gallery_first_thumbnail( $id , 'tt-woo-thumb');
        }

        echo '<div class="shop-item">
                    <div class="layer-shop">
                          <div class="vertical-align">
                                <a href="'.esc_url(home_url('/')).'?add-to-cart='.get_the_ID().'" rel="nofollow" data-product_id="'.get_the_ID().'" data-product_sku="" data-quantity="1" class="button add_to_cart_button product_type_simple card-button"><span class="fa fa-shopping-cart"></span>'.esc_html__('add to cart', 'katharine').'</a>
                          </div>
                    </div>
                    <img src="'. $thumb .'" alt="'. esc_attr(get_the_title()) .'">
              </div>
              <div class="shop-title">
                    <a href="'. get_permalink() .'"><h5>'. get_the_title() .'</h5></a>
                    '. $price_html .'
              </div>';

        // echo '<a href="/dev/shop/?add-to-cart=37" rel="nofollow" data-product_id="37" data-product_sku="" data-quantity="1" class="button add_to_cart_button product_type_simple">Add to cart</a>';

        echo '<div class="woo-item-content">';
    }

    public function after_shop_loop_item(){
        echo '</div>';
    }

}


if( class_exists( 'woocommerce' ) )
    new TT_WooCommerce();


function get_woo_cart_link(){
    if( class_exists( 'woocommerce' ) ){
        global $woocommerce;
        return '<a href="'.$woocommerce->cart->get_cart_url().'"><span class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></span></a>';
    }
    return '';
}