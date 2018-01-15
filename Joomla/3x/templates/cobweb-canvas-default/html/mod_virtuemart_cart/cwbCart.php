<?php // no direct access
defined('_JEXEC') or die('Restricted access');

//dump ($cart,'mod cart');
// Ajax is displayed in vm_cart_products
// ALL THE DISPLAY IS Done by Ajax using "hiddencontainer" ?>

<!-- Virtuemart 2 Ajax Card -->

<?php

$app = JFactory::getApplication();

if (!class_exists('VirtueMartCart')) require(VMPATH_SITE . DS . 'helpers' . DS . 'cart.php');
$cart = VirtueMartCart::getCart(false);

 // echo "<pre><br>DEBUG START <br>" . print_r($data, 1) . "<br> DEBUG END<br></pre>";
$total = explode( " ", $data->billTotal );

?>
<?php

$document = JFactory::getDocument();
$css = JURI::root() . '/templates/'. $app->getTemplate() .'/html/mod_virtuemart_cart/cart.css';
$document->addStyleSheet($css);

jimport('joomla.language.helper');
$languages = JLanguageHelper::getLanguages('lang_code');
$lang_code = JFactory::getLanguage()->getTag();
$sef = $languages[$lang_code]->sef;

?>
<div class="top-cart-block">
    <div class="vmCartModule <?php echo $params->get('moduleclass_sfx'); ?>"
         id="vmCartModule<?php echo $params->get('moduleid_sfx'); ?>">
         <div class="incon-bag">
            <i class="fa fa-shopping-bag" aria-hidden="true"></i>
         </div>
        <div class="text-right top-cart-info" id="seeMoreCart" style=" display: none; ">
            <?php if( $total[1] > 0 ): ?>
               <span class="product_number total_products">
                   <?php preg_match("/href=\"(.+)\"/U", $data->cart_show, $show_cart_link); ?>
                   <a href="<?php echo $show_cart_link[1]; ?>"><?php echo $data->totalProductTxt; ?></a>
             </span>
            <?php endif; ?>
            <div class="total">
                <?php// echo  $data->totalProductTxt ?> / Total: <?php echo preg_replace("/Total/", "", $data->billTotal); ?>
            </div>
        </div>
        <?php //if ( $data->products ): ?>
        <div class="top-cart-content-wrapper " id="cart-content">
            <?php

            if ($show_product_list) {
            ?>
            <div class="hiddencontainer" style=" display: none; ">
                <div class="vmcontainer">
                    <div class="scroller">
                        <div class="product_row">
                            <div class="top-cart-item clearfix">
                                <div class="top-cart-item-desc">
                                    <strong class="product_name"></strong>
                                    <span class="top-cart-item-quantity quantity"></span><span class="ex">x</span>
                                    <span clas="top-cart-item-price product_price"><?php echo $product_price; ?> </span>
                                    <span class="top-cart-item-price subtotal_with_tax"></span>
                                    <div class="customProductData"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

            </div>

            <div class="vm_cart_products-container">
                <div class="vm_cart_products top-cart-content">
                    <?php if ( !$data->products ): ?>
                        <div style="text-align: center">Количката е празна</div>
                    <?php endif; ?>
                    <div class="vmcontainer" id="cartCont">

                        <div class="top-cart-items">
                            <?php foreach ($data->products as $key => $product ){ ?>

                                    <div class="top-cart-item clearfix">

                                        <div class="top-cart-item-desc">
                                            <strong><?php echo $product['product_name'] ?></strong>
                                            <span class="top-cart-item-quantity"><?php echo $product['quantity'] ?>x</span>
                                            <span class="top-cart-item-price"><?php echo $product['prices']; //var_dump($cart->products[0]->prices['salesPrice']);?></span>
                                        </div>
                                    </div>
                                <?php }; ?>


                            <?php } ?>
                        </div>

                    </div>

                    <div style="clear:both;"></div>
                    <div class="payments-signin-button"></div>
                </div>
                <div class="cart_footer">
                    <div class="show_cart text-right <?php if (!$data->totalProduct) echo 'hide-class' ?> ">
                        <?php echo $data->cart_show; ?>
                    </div>
                    <div class="total">
                        <?php echo '<strong>' . JText::sprintf('COM_VIRTUEMART_AJAX_CART_TOTAL') . ' ' . $data->billTotal_discounted_net . '</strong>'; ?>
                    </div>
                </div>

                <noscript>
                    <?php echo vmText::_('MOD_VIRTUEMART_CART_AJAX_CART_PLZ_JAVASCRIPT') ?>
                </noscript>
                <script type="text/javascript">
                    jQuery('body').on('mouseover', '.top-cart-block', function(){
                        jQuery(this).find('.vm_cart_products-container').show();
                    });

                    jQuery('body').on('mouseleave', '.top-cart-block', function(){
                        jQuery(this).find('.vm_cart_products-container').hide();
                    });

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
                                                jQuery('.vmCartModule').find('.show_cart').removeClass('hide-class');
                                                jQuery('.vmCartModule').find('.total').html( datas.totalProductTxt + ' / ' + datas.billTotal.replace('Total', 'Общо'));
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
        <?php //endif; ?>
    </div>

</div>