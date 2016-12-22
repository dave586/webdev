<?php


include_once 'components/includes.php';
include_once "components/Cart.php";


?>


<!DOCTYPE html>
<?php
echo generateHead("View Cart");
?>

<body>
<?php
echo generateHeader();

$cart = BusinessHelper::createObject(new Cart(BusinessHelper::getConnection())); ?>
<br>
<main>
    <div class="ui fluid container">
<form class="ui form" method="POST" action="continue-shopping.php">
    <div class="ui stackable grid container">
        <div class="left floated three wide column">
            <h3 class="ui dividing header">Actions</h3>
            <a class="ui button grey" href="clear-cart.php?return=<?php echo urlencode("view-cart.php"); ?>"><i
                    class="trash icon"></i> Clear Cart</a>
            <br>
            <br>
            <button style="display:none" class="ui button orange" type="submit"><i class="refresh icon"></i> Update Cart</button>
        </div>


        <div class="twelve wide column">
            <h2 class="ui dividing header">Basket</h2>
            <div class="ui items" id="viewCartItemList">

                <?php echo $cart->generateCartView(); ?>
                
               
            </div>
            
            
            
             <div id="cartOptions">
                
                    <?php if (!$cart->isEmpty()) { ?>

                    <div id="subTotal">
                            <p class="alighRight">Sub Total: $<span id="subTotalValue"></span></p>
                    </div>
                        <br>
                    <select name="shipping" id="shippingType">
                        <option <?php if (!$cart->isShippingExpress()) {
                            echo 'selected';
                        } ?> value="standard">Standard Shipping
                        </option>
                        <option <?php if ($cart->isShippingExpress()) {
                            echo 'selected';
                        } ?> value="express">Express Shipping
                        </option>
                    </select>
    
                    <!-- calculate the shipping -->
                        <br>
                    <div id="shippingTotal">
                        <p class="alighRight">Shipping: $<span id="shippingValue"></span></p>
                    </div>

                    <div id="cartTotal">
                        <p class="alighRight">Total: $<span id="totalValue"></span></p>
                    </div>
                    <br>
                    <a href="#" class="ui button orange"><i class="dollar icon"></i> Checkout</a>
                    <button class="ui orange button"><i class="mail forward icon" type="submit"></i> Continue Shopping</button>
    
    
                    <?php } ?>
                
                </div>
            
        </div>


        <div class="one wide column">
            <p></p>
        </div>
    </div>
</form>
    </div>




<script type="text/javascript" src="js/view-cart.js"></script>
<?php BusinessHelper::closeAllConnection(); ?>
</main>
<?php
echo generateFooter();
?>
</body>

</html>