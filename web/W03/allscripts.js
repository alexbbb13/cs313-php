    var selectedItems = Array();
    var totalItems = 0;

    function addToCart(clicked_id)
    {
        if(typeof selectedItems[clicked_id] === 'undefined') {
            selectedItems[clicked_id] = 1;
            totalItems++;
        } else {
            selectedItems[clicked_id] = selectedItems[clicked_id] + 1;
        }
        document.getElementById("total_items_in_cart").textContent = totalItems + " items";
        setCookie("shoppingCart", JSON.stringify(selectedItems), 1);
    }

   function removeFromCart(clicked_id)
    {
        var selectedItems = JSON.parse(getCookie("shoppingCart"));
            selectedItems[clicked_id] = null;
        //document.getElementById("total_items_in_cart").textContent = totalItems + " items";
        setCookie("shoppingCart", JSON.stringify(selectedItems), 1);
        window.location.reload();
    }

    function addValue(inc_clicked_id, value)
    {
        var parsed = inc_clicked_id.split("_");
        var clicked_id = parsed[1];
        var selectedItems = JSON.parse(getCookie("shoppingCart"));
        var newValue = selectedItems[clicked_id] + value; 
            if (newValue >=0) {
                selectedItems[clicked_id] = newValue;
                updateQuantity(clicked_id, newValue);
                setCookie("shoppingCart", JSON.stringify(selectedItems), 1);        
            }
    }

    function updateQuantity(itemId, quantity){
        document.getElementById("quantity_"+itemId).textContent = quantity;
    }

    function setCookie(cname, cvalue, exdays) {
        var d = new Date();
        d.setTime(d.getTime() + (exdays*24*60*60*1000));
        var expires = "expires="+ d.toUTCString();
        document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
    }

    function getCookie(cname) {
        var name = cname + "=";
        var decodedCookie = decodeURIComponent(document.cookie);
        var ca = decodedCookie.split(';');
        for(var i = 0; i <ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == ' ') {
            c = c.substring(1);
            }
        if (c.indexOf(name) == 0) {
            return c.substring(name.length, c.length);
            }
        }
    return "";
    }