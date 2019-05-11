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
            //echo 'row';
            echo '<td><p class="shop_item"><img src="'.$cake->_icon.'" alt = "Cake"><p>'.$cake->_name.'</p><p class = "price_tag">$'.$cake->_price.'</p><button id = "'.$counter.'" onClick="addToCart(this.id)">Add to cart</button></td>';
            $counter++;
            }
            echo '</tr>';
            ?>
            <!--
            <tr id = "link_cakes">
                <td><p class="shop_item"><img src="images/big_cake_01.png" alt = "Cake"><p>1/3 Big cake</p><p class = "price_tag">$9.99</p><button id = "0" onClick="addToCart(this.id)">Add to cart</button></td>
                <td><p class="shop_item"><img src="images/big_cake_02.png" alt = "Cake"><p>1/3 Another Big cake</p><p class = "price_tag">$10.99</p><button id = "1" onClick="addToCart(this.id)">Add to cart</button></td>
                <td><p class="shop_item"><img src="images/big_cake_03.png" alt = "Cake"><p>1/3 Special Big cake</p><p class = "price_tag">$11.99</p><button id = "2" onClick="addToCart(this.id)">Add to cart</button></td>
            </tr>
            -->
            <!--
            <tr>
                <td><p class="shop_item"><img src="images/big_cake_01.png" alt = "Cake"><p>1/2 Big cake</p><p class = "price_tag">$20.99</p><button>Add to cart</button></td>
                <td><p class="shop_item"><img src="images/big_cake_02.png" alt = "Cake"><p>1/2 Another Big cake</p><p class = "price_tag">$19.99</p><button>Add to cart</button></td>
                <td><p class="shop_item"><img src="images/big_cake_03.png" alt = "Cake"><p>1/2 Special Big cake</p><p class = "price_tag">$22.99</p><button>Add to cart</button></td>
            </tr>
            <tr>
                <td><p class="shop_item"><img src="images/big_cake_01.png" alt = "Cake"><p>Big cake</p><p class = "price_tag">$27.99</p><button>Add to cart</button></td>
                <td><p class="shop_item"><img src="images/big_cake_02.png" alt = "Cake"><p>Another Big cake</p><p class = "price_tag">$29.99</p><button>Add to cart</button></td>
                <td><p class="shop_item"><img src="images/big_cake_03.png" alt = "Cake"><p>Special Big cake</p><p class = "price_tag">$31.99</p><button>Add to cart</button></td>
            </tr>
            <tr id = "link_birthday_cakes">
                <td><p class="shop_item"><img src="images/birthday_cake_01.png" alt = "Cake"><p>Birthday cake</p><p class = "price_tag">$27.99</p><button>Add to cart</button></td>
                <td><p class="shop_item"><img src="images/birthday_cake_02.png" alt = "Cake"><p>Special Birthday cake</p><p class = "price_tag">$27.99</p><button>Add to cart</button></td>
                <td><p class="shop_item"><img src="images/birthday_cake_01.png" alt = "Cake"><p>Another Birthday cake</p><p class = "price_tag">$27.99</p><button>Add to cart</button></td>
            </tr>
            <tr>
                <td><p class="shop_item"><img src="images/birthday_cake_01.png" alt = "Cake"><p>Birthday cake II</p><p class = "price_tag">$33.99</p><button>Add to cart</button></td>
                <td><p class="shop_item"><img src="images/birthday_cake_02.png" alt = "Cake"><p>Special Birthday cake II</p><p class = "price_tag">$35.99</p><button>Add to cart</button></td>
                <td><p class="shop_item"><img src="images/big_cake_03.png" alt = "Cake"><p>Birthtday cake MK II</p><p class = "price_tag">$34.99</p><button>Add to cart</button></td>
            </tr>
            <tr>
                <td><p class="shop_item"><img src="images/birthday_cake_01.png" alt = "Cake"><p>Birthday cake MK IV</p><p class = "price_tag">$39.99</p><button>Add to cart</button></td>
                <td><p class="shop_item"><img src="images/birthday_cake_02.png" alt = "Cake"><p>Special Birthday cake MK II</p><p class = "price_tag">$40.99</p><button>Add to cart</button></td>
                <td><p class="shop_item"><img src="images/big_cake_03.png" alt = "Cake"><p>Birthtday cake MK V</p><p class = "price_tag">$44.99</p><button>Add to cart</button></td>
            </tr>
            <tr id = "link_cupcakes">
                <td><p class="shop_item"><img src="images/cupcake_01.png" alt = "Cake"><p>Cupcake I</p><p class = "price_tag">$2.99</p><button>Add to cart</button></td>
                <td><p class="shop_item"><img src="images/cupcake_02.png" alt = "Cake"><p>Cupcake II</p><p class = "price_tag">$2.99</p><button>Add to cart</button></td>
                <td><p class="shop_item"><img src="images/cupcake_03.png" alt = "Cake"><p>Cupcake II</p><p class = "price_tag">$2.99</p><button>Add to cart</button></td>
            </tr>
            <tr>
                <td><p class="shop_item"><img src="images/cupcake_04.png" alt = "Cake"><p>Cupcake IV</p><p class = "price_tag">$2.99</p><button>Add to cart</button></td>
                <td><p class="shop_item"><img src="images/cupcake_01.png" alt = "Cake"><p>Cupcake V</p><p class = "price_tag">$2.99</p><button>Add to cart</button></td>
                <td><p class="shop_item"><img src="images/cupcake_02.png" alt = "Cake"><p>Cupcake VI</p><p class = "price_tag">$2.99</p><button>Add to cart</button></td>
            </tr>
            <tr>
                <td><p class="shop_item"><img src="images/cupcake_01.png" alt = "Cake"><p>Cupcake I Sugar Free</p><p class = "price_tag">$2.99</p><button>Add to cart</button></td>
                <td><p class="shop_item"><img src="images/cupcake_02.png" alt = "Cake"><p>Cupcake II Sugar Free</p><p class = "price_tag">$2.99</p><button>Add to cart</button></td>
                <td><p class="shop_item"><img src="images/cupcake_03.png" alt = "Cake"><p>Cupcake II Sugar Free</p><p class = "price_tag">$2.99</p><button>Add to cart</button></td>
            </tr>
            <tr>
                <td><p class="shop_item"><img src="images/cupcake_04.png" alt = "Cake"><p>Cupcake IV Sugar Free</p><p class = "price_tag">$2.99</p><button>Add to cart</button></td>
                <td><p class="shop_item"><img src="images/cupcake_01.png" alt = "Cake"><p>Cupcake V Sugar Free</p><p class = "price_tag">$2.99</p><button>Add to cart</button></td>
                <td><p class="shop_item"><img src="images/cupcake_02.png" alt = "Cake"><p>Cupcake VI Sugar Free</p><p class = "price_tag">$2.99</p><button>Add to cart</button></td>
            </tr>
            <tr id = "link_donuts">
                <td><p class="shop_item"><img src="images/doughnut_01.png" alt = "Cake"><p>Dougnut Chocolate</p><p class = "price_tag">$1.99</p><button>Add to cart</button></td>
                <td><p class="shop_item"><img src="images/doughnut_02.png" alt = "Cake"><p>Dougnut Lemon</p><p class = "price_tag">$1.99</p><button>Add to cart</button></td>
                <td><p class="shop_item"><img src="images/doughnut_03.png" alt = "Cake"><p>Dougnut Creamy</p><p class = "price_tag">$1.99</p><button>Add to cart</button></td>

            </tr>
            <tr>
                <td><p class="shop_item"><img src="images/doughnut_01.png" alt = "Cake"><p>3 x Dougnut Chocolate</p><p class = "price_tag">$4.99</p><button>Add to cart</button></td>
                <td><p class="shop_item"><img src="images/doughnut_02.png" alt = "Cake"><p>3 x Dougnut Lemon</p><p class = "price_tag">$4.99</p><button>Add to cart</button></td>
                <td><p class="shop_item"><img src="images/doughnut_03.png" alt = "Cake"><p>3 x Dougnut Creamy</p><p class = "price_tag">$4.99</p><button>Add to cart</button></td>
            </tr>
            -->
        </table>
    </div>
    <div class="div_shopping_cart" id="shopping_cart">
        <img src="images/shopping_cart_icon.png" alt= "Shopping cart icon" height="50" width="50">
        <a href="assign03_2.php" id="shopping_cart_span">Shopping cart</a>
        <p id='total_items_in_cart'>0 items</p>
    </div>
    <div class="div_delivery" id="link_delivery">Delivery terms:<br><strong>FREE</strong> delivery on all orders above $30, all other orders delivery fee <i>$10</i></div>
</div>

</body>
</html>