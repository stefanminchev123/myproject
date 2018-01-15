<?php // no direct access
defined('_JEXEC') or die('Restricted access');

//dump ($cart,'mod cart');
// Ajax is displayed in vm_cart_products
// ALL THE DISPLAY IS Done by Ajax using "hiddencontainer" ?>

<!-- Virtuemart 2 Ajax Card -->

<?php

if (!class_exists('VirtueMartCart')) require(VMPATH_SITE . DS . 'helpers' . DS . 'cart.php');
$cart = VirtueMartCart::getCart(false);

 // echo "<pre><br>DEBUG START <br>" . print_r($data, 1) . "<br> DEBUG END<br></pre>";
$total = explode( " ", $data->billTotal );

?>

<div class="top-cart-block">
    <div class="vmCartModule <?php echo $params->get('moduleclass_sfx'); ?>"
         id="vmCartModule<?php echo $params->get('moduleid_sfx'); ?>">
        <div class="text-right top-cart-info" id="seeMoreCart">
            <?php if( $total[1] > 0 ): ?>
               <span class="product_number total_products">
                   <?php preg_match("/href=\"(.+)\"/U", $data->cart_show, $show_cart_link); ?>
                   <a href="<?php echo $show_cart_link[1]; ?>"><?php echo $data->totalProductTxt; ?></a>
             </span>
            <?php endif; ?>
            <div class="total"><?php echo $data->billTotal; ?>
            </div>
            <i class="fa fa-shopping-cart"></i>
        </div>
        <?php if ( $data->products ): ?>
        <div class="top-cart-content-wrapper " id="cart-content">
            <?php

            if ($show_product_list) {
            ?>

            <div class="hiddencontainer" style=" display: none; ">
            <div class="vmcontainer_inner">
                <div class="vmcontainer">
                    <div class="scroller">
                        <div class="product_row">
                            <span class="quantity"></span>
                            <p>&nbsp;x&nbsp;</p><span class="product_name"></span>
                            <span clas="product_price"><?php //echo $product_price ?> </span>

                            <div class="subtotal_with_tax"></div>
                            <div class="customProductData"></div>
                            <br>
                        </div>

                    </div>

                    <!-- <div class="show_cart">
                        <?php if ($data->totalProduct): ?>
                            <button><?php echo $data->cart_show; ?></button>
                        <?php endif; ?>
                    </div> -->
                </div>
            </div>
            <div class="show_cart text-right">
                            <?php if ($data->totalProduct): ?>
                                <button class="btn btn-primary"><?php echo $data->cart_show; ?></button>
                            <?php endif; ?>
                        </div>
            </div>

            <div class="vm_cart_products top-cart-content">
                <div class="vmcontainer" id="cartCont">
                    <div class="scroller">
                        <ul class="scroller" style="height: 250px; overflow: hidden; width: auto;">
                            <?php foreach ($data->products as $key => $product ){ ?>
                                    <li>
                                        <span class="cart-content-count"><?php echo $product['quantity'] ?>x</span>
                                        <strong><?php echo $product['product_name'] ?></strong>
                                        <span class="product_price"><?php echo $product['prices'] ?></span>

                                    </li>
                                <?php }; ?>


                            <?php } ?>
                        </ul>

                        <div class="show_cart text-right">
                            <?php if ($data->totalProduct): ?>
                                <button class="btn btn-primary"><?php echo $data->cart_show; ?></button>
                            <?php endif; ?>
                        </div>
                    </div>

                </div>


                <div style="clear:both;"></div>
                <div class="payments-signin-button"></div>
                <noscript>
                    <?php echo vmText::_('MOD_VIRTUEMART_CART_AJAX_CART_PLZ_JAVASCRIPT') ?>
                </noscript>
                <script type="text/javascript">
                    if (typeof Virtuemart === "undefined")
                            Virtuemart = {};

                        jQuery(function($) {
                            Virtuemart.customUpdateVirtueMartCartModule = function(el, options){
                                var base    = this;
                                base.el     = jQuery(".vmCartModule");
                                base.options    = jQuery.extend({}, Virtuemart.customUpdateVirtueMartCartModule.defaults, options);

                                base.init = function(){
                                    jQuery.ajaxSetup({ cache: false })
                                    jQuery.getJSON(Virtuemart.vmSiteurl + "index.php?option=com_virtuemart&nosef=1&view=cart&task=viewJS&format=json" + Virtuemart.vmLang,
                                        function (datas, textStatus) {
                                            base.el.each(function( index ,  module ) {
                                                if (datas.totalProduct > 0) {
                                                    jQuery(module).find(".vm_cart_products .vmcontainer_inner").html("");
                                                    jQuery.each(datas.products, function (key, val) {
                                                        //jQuery("#hiddencontainer .vmcontainer").clone().appendTo(".vmcontainer .vm_cart_products");
                                                        jQuery(module).find(".hiddencontainer .vmcontainer .product_row").clone().appendTo( jQuery(module).find(".vm_cart_products") );
                                                        jQuery.each(val, function (key, val) {
                                                            jQuery(module).find(".vm_cart_products ." + key).last().html(val);
                                                        });
                                                    });
                                                }
                                                jQuery(module).find(".show_cart").html(     datas.cart_show);
                                                jQuery(module).find(".total_products").html(    datas.totalProductTxt);
                                                jQuery(module).find(".total").html(     datas.billTotal);
                                            });
                                        }
                                    );
                                };
                                base.init();
                            };
                            // Definition Of Defaults
                            Virtuemart.customUpdateVirtueMartCartModule.defaults = {
                                name1: 'value1'
                            };

                        });

                        jQuery(document).ready(function( $ ) {
                            jQuery(document).off("updateVirtueMartCartModule","body",Virtuemart.customUpdateVirtueMartCartModule);
                            jQuery(document).on("updateVirtueMartCartModule","body",Virtuemart.customUpdateVirtueMartCartModule);
                        });

                </script>
            </div>
        </div>
        <?php endif; ?>
    </div>

</div>
