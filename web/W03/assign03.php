<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Buroff Bakery</title>
    <link rel = "stylesheet"
          type = "text/css"
          href = "style.css" />

</head>
<body>

<script type="text/javascript" src="allscripts.js">
   

</script>
<div class="grid-container">
    <div class="div_title"><img src="images/bakery-main.png" alt="Cakes" height="200" width="400"><p class="div_title_text"><link href='http://fonts.googleapis.com/css?family=Pacifico' rel='stylesheet' type='text/css'>
Buroff's bakery</p></div>
    <div class="div_menu" id="menu_items">
        <ul>
            <li>About us</li>
            <li><a href="#link_cakes">Cakes</a></li>
            <li><a href="#link_birthday_cakes">Birthday Cakes</a></li>
            <li><a href="#link_cupcakes">Cupcakes</a></li>
            <li><a href="#link_donuts">Donuts</a></li>
            <li><a href="assign03_cart.php">Shopping cart</a></li>
            <li><a href="#link_delivery">Delivery</a></li>
        </ul>
    </div>
    <div class="div_content">
        <table>

<?php
require 'cake.php';

            //printing out
            $counter = 0;
            $firstline = true;
            $lastIndex = sizeof($cakes)-1;
            //global cakes defined in cake.php
            $cakes = $GLOBALS['cakes'];    
            foreach ($cakes as $cake) {
                if ($counter %3 == 0 && $firstline == true) {
                   //open tag
                   echo '<tr id = "link_cakes">';
                   $firstline = false;
                } else if ($counter %3 == 0) {
                   //close previous tag, open new tag
                   echo '</tr>';

                //if there will be another row
                if($counter < $lastIndex) echo '<tr>';
            }
                echo '<td><p class="shop_item"><img src="'.$cake->_icon.'" alt = "Cake"><p>'.$cake->_name.'</p><p class = "price_tag">$'.$cake->_price.'</p><button id = "'.$counter.'" onClick="addToCart(this.id)">Add to cart</button></td>';
                 $counter++;
            }
            echo '</tr>';
            ?>
                 </table>
    </div>
    <div class="div_shopping_cart" id="shopping_cart">
        <img src="images/shopping_cart_icon.png" alt= "Shopping cart icon" height="50" width="50">
        <a href="assign03_cart.php" id="shopping_cart_span">Shopping cart</a>
        <p id='total_items_in_cart'>0 items</p>
    </div>
    <div class="div_delivery" id="link_delivery">Delivery terms:<br><strong>FREE</strong> delivery on all orders above $30, all other orders delivery fee <i>$10</i></div>
</div>

</body>
</html>