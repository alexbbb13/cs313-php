<?php

//  This function reads the form "query string"
//
// This function handles both an http "get".
/*
 *
 *
 * Write a PHP program to process the form you created in week 6.
+Your HTML file must be named assign11.html (copy assign06.html to assign11.html and modify it for this assignment)
+You must name your main PHP program assign11.php. You will also need a second php program (name it assign11_a.php)
+You should use the same form you created in week 06 which has the JavaScript validation. If you chose to use a different form it must
+include the same number and type of fields that were required for the assignment in week 6. Modify your form element to use either a "get"
+or "post" method attribute and modify the "action" attribute to reference your PHP program.
+Your assign11.php file should be a PHP program which returns an HTML document which is a Purchase Review / Confirmation page.
+The purchase confirmation page must include the following.
+a title
+a heading
+first and last name
+address
+phone #
+a list of the items selected for purchase and their respective costs.
+total cost of the items being purchased
+the credit card type selected for use
the credit card expiration date -display using the month and year (i.e. January 2013)
+a <form> element
+with an "action" attribute that references a 2nd PHP program (assign11_a.php) and with two "submit" buttons.
+a confirm purchase button - which submits this new form
+a cancel purchase button - which also submits this new form
The 2nd PHP program will simply return an html document to the browser indicating the purchase was either confirmed or cancelled.
In the following directory on Linux (/home/ercanbracks/cs213-examples/php/getFormData.php) is a sample PHP program which demonstrates
accessing the query string from a form passing 3 items using the HTTP "GET" method.
Place all your files (assign11.html, assign11.php, assign11_a.php) in your public_html/week11 directory.
Test your PHP program by accessing your assign11.html file located in your public_html directory "http://157.201.194.254/~yourID/week11/assign11.html (
Links to an external site.)Links to an external site." or if tunneling use "http://localhost/~yourID/week11/assign11.html (Links to an external site.)
Links to an external site.”
 */
$firstName = $_GET['first_name'];
$lastName = $_GET['last_name'];
$address = $_GET['address'];
$phone = $_GET['phone'];
if (isset($_GET['checkboxvar']))
{
    $checkboxvar = ($_GET['checkboxvar']);
}
$cardType = $_GET['card_type'];
$creditCard = $_GET['credit_card'];
$expiryDate = $_GET['exp_date'];
$products = array("Cupcake" => 1.99,"Oreo" =>0.99,"Pizza" =>7.99 ,"Burger" => 3.99, "Cola" => 0.99);
?>



<!DOCTYPE html>
<html lang = "en">
<meta charset = "utf-8" />
<meta charset="UTF-8">
<link rel = "stylesheet"
      type = "text/css"
      href = "style.css" />
<title>Order Confirmation</title>
<body>
<h1>Order Confirmation</h1>
<br />
<br />
<h2>
<?php
print "Customer: $lastName, $firstName<br />";
print "Address: $address<br />";
print "Phone: $phone<br />";
?>
</h2>

<h3>Order details:</h3>
<table id="shopping_cart" name="shopping_cart" class="input_field">
<tr>
    <th>Item</th>
    <th>Price</th>
</tr>

    <?php
    $i = 0;
    $total = 0;
    foreach ($products as $product => $price) {
        //var_dump($product);
        //var_dump($price);
        if (isset($checkboxvar) && in_array($i, $checkboxvar)) {
            print "<tr>
                <td>$product</td>
                <td>$price</td>
                </tr>";
            $total = $total + $price;
        }
        $i++;
    }
    print "<tr>
<td>Total:</td>
<td>$total</td>
</tr></table>";

$properDate = getProperDate($expiryDate);
print "<h2>
Credit card type: $cardType<br />
Credit card expiration: $properDate<br />
</h2>
";

function getProperDate($date){
    $date = "01/" . $date;
    $d1 = str_replace('/', '-', $date);
    $d2 = date('F, Y', strtotime($d1));
    return $d2;
}?>

    <form action="assign11_a.php" method="get">
        <input type="submit" name="action" class = "button-entity" value="Confirm">
        <input type="submit" name="action" class = "button-entity" value="Cancel">
    </form>
</body>
</html>

