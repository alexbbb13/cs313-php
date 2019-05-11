<?php
class Cake {
    public $_icon;
    public $_name;
    public $_price;


    public function __construct ($i, $n, $p) {
            $this ->_icon = $i;
            $this ->_name = $n;
            $this ->_price = $p;
            }

    public function __destruct () {
            }
    }

    $cakes = array(
            new Cake("images/big_cake_01.png", "1/3 Big cake", "9.99"),
            new Cake("images/big_cake_02.png", "1/3 Another Big cake", "11.99"),
            new Cake("images/big_cake_03.png", "1/3 Special Big cake", "13.99"),
            new Cake("images/big_cake_01.png", "1/2 Big cake", "20.99"),
            new Cake("images/big_cake_02.png", "1/2 Another Big cake", "19.99"),
            new Cake("images/big_cake_03.png", "1/2 Special Big cake", "22.99"),
            new Cake("images/big_cake_03.png", "1/2 Special Big cake", "22.99"),
            new Cake("images/big_cake_01.png", "Big cake", "27.99"),
            new Cake("images/big_cake_02.png", "Another Big cake", "27.99"),
            new Cake("images/big_cake_03.png", "Special Big cake", "27.99")
            );
?>