<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Buroff Bakery - Shopping Cart</title>
    <link rel = "stylesheet"
          type = "text/css"
          href = "style.css" />
    <style>
    
        /*New one*/
        .shop_item_name, .price_tag, .shop_item_button, .shop_item_quantity, .shop_item_total {
            padding: 10px;
        }

    </style>
</head>
<body>

    <script type="text/javascript" src="allscripts.js"></script>
<div class="grid-container">
    <div class="div_title"><img src="images/bakery-main.png" alt="Cakes" height="200" width="400"><p class="div_title_text"><link href='http://fonts.googleapis.com/css?family=Pacifico' rel='stylesheet' type='text/css'>
        Checkout</p></div>
    <div class="div_menu" id="menu_items">
        <ul>
            <li><a href="assign03_checkout.php">Back</a></li>
        </ul>
    </div>
    <div class="div_content">

    <?php
        require 'cake.php';
        $cookie_name = "shoppingCart";
    if(!isset($_COOKIE[$cookie_name])) {
    } else {
        $json = $_COOKIE[$cookie_name];
        $cakesCart = json_decode($json, true);
        listTable($cakesCart);
        listAddress();
    }

    function listTable($cakesCart){
        echo '<table>';
        $total = 0; 
        for ($i = 0; $i < sizeof($cakesCart); $i++) {
             if ($cakesCart[$i] !== null && $cakesCart[$i] > 0) {
                listCake($i, $cakesCart[$i]);
                $total = $total + getTotalFor($i, $cakesCart[$i]);
            }
        }
        listTotal($total);
        echo '</table>';
    }

    function listCake($cakeId, $num){
           $cakes = $GLOBALS['cakes'];
           $cake = $cakes[$cakeId];
           echo ' <tr>
                <td><div class="shop_item"><img src="'.$cake->_icon.'" alt = "Cake">
                    <span class = "shop_item_name">'.$cake->_name.'</span>
                    <span class = "price_tag">$'.$cake->_price.'</span>
                    <span class = "shop_item_quantity" id = "quantity_'.$cakeId.'">'.$num.'</span>
                    <span class = "shop_item_total">$'.$cake->_price * $num.'</span>
                </div>
                </td>
            </tr>'; 
    }

    function listTotal($total){
           echo ' <tr>
                <br>    
                <td><div class="shop_item">
                    <span class = "shop_item_total">Total $'.$total.'</span>
                </div>
                </td>
            </tr>'; 
    }

    function getTotalFor($cakeId, $num){
           $cakes = $GLOBALS['cakes'];
           $cake = $cakes[$cakeId];
           return $cake->_price * $num;
    }

    function listAddress(){
        echo '<div class="shop_item"><h2 class = "delivery-address-title">Deliver to:</h2><br>';
        echo '<p class = "delivery-address-text">';
        echo getKey("address_line1")." ".getKey("address_line2")." , ".getKey("address_city")." ".getKey("address_state").",".getKey("address_zip");
        echo '</p><div>';
    }

    function getKey($key){
        if (isset($_POST[$key]) && !empty($_POST[$key])) {
           return strip_tags(htmlspecialchars_decode($_POST[$key]));    
        } else {  
            return "";
        }
    }
    
    ?>
    </div>
    <div class="div_delivery" id="link_delivery">Delivery terms:<br><strong>FREE</strong> delivery on all orders above $30, all other orders delivery fee <i>$10</i></div>

</div>
</body>
</html>