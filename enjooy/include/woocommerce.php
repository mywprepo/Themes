            <?php
            /* put it here because, how to wrapped in #main div */
            if( ozy_check_is_woocommerce_page() ) {
                global $woocommerce;
            ?>
            <div class="ozy-ajax-shoping-cart">
                <a class="cart-contents" href="<?php echo $woocommerce->cart->get_cart_url(); ?>" title="<?php _e('View your shopping cart', 'woothemes'); ?>">
                    <i class="oic-simple-line-icons-52"></i>
                    <?php echo sprintf(_n('%d item', '%d items', $woocommerce->cart->cart_contents_count, 'woothemes'), $woocommerce->cart->cart_contents_count);?> - <?php echo $woocommerce->cart->get_cart_total(); ?>
                </a>
            </div>
            <!--.ozy-ajax-shoping-cart-->
            <?php
            }
            ?>