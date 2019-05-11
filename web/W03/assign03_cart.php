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

    <script type="text/javascript" src="allscripts.js">


</script>
<div class="grid-container">
    <div class="div_title"><img src="images/bakery-main.png" alt="Cakes" height="200" width="400"><p class="div_title_text"><link href='http://fonts.googleapis.com/css?family=Pacifico' rel='stylesheet' type='text/css'>
        Shopping Cart</p></div>
    <div class="div_menu" id="menu_items">
        <ul>
            <li><a href="assign03.php">Back</a></li>
            <li><a href="#link_delivery">Delivery</a></li>
            <li><a href="assign03_checkout.php">Checkout</a></li>
        </ul>
    </div>
    <div class="div_content">

    <?php
        require 'cake.php';
        $cookie_name = "shoppingCart";
    if(!isset($_COOKIE[$cookie_name])) {
        //echo "Cookie named '" . $cookie_name . "' is not set!";
    } else {
        //echo "Cookie '" . $cookie_name . "' is set!<br>";
        //echo "Value is: " . $_COOKIE[$cookie_name];
        $json = $_COOKIE[$cookie_name];
        $cakesCart = json_decode($json, true);
        listTable($cakesCart);
    }

    function listTable($cakesCart){
        echo '<table>';
        for ($i = 0; $i < sizeof($cakesCart); $i++) {
             if ($cakesCart[$i] !== null && $cakesCart[$i] > 0) listCake($i, $cakesCart[$i]);
        }
        echo '</table>';
    }

    function listCake($cakeId, $num){
           $cakes = $GLOBALS['cakes'];
           $cake = $cakes[$cakeId];
           echo ' <tr>
                <td><div class="shop_item"><img src="'.$cake->_icon.'" alt = "Cake">
                    <span class = "shop_item_name">'.$cake->_name.'</span>
                    <span class = "price_tag">$'.$cake->_price.'</span>
                    <button class = "shop_item_button" id = "dec_'.$cakeId.'" onClick="addValue(this.id, -1)">-</button>
                    <span class = "shop_item_quantity" id = "quantity_'.$cakeId.'">'.$num.'</span>
                    <button class = "shop_item_button" id = "inc_'.$cakeId.'" onClick="addValue(this.id, 1)">+</button>
                    <button class = "shop_item_button" id = "'.$cakeId.'" onClick="removeFromCart(this.id)">Remove</button>
                </div>
                </td>
            </tr>'; 
    }
    
    ?>

    </div>
    <div class="div_delivery" id="link_delivery">Delivery terms:<br><strong>FREE</strong> delivery on all orders above $30, all other orders delivery fee <i>$10</i></div>
</div>
</body>
</html>