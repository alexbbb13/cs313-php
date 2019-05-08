<html>
<body>
<head>
   <title>Display selections</title>
</head>

<?php
echo "username:" . "<br>" .   $_POST["Name"] . "<br><br>";
echo "Email:" . "<br>" . "<a href= 'mailto:'" .  $_POST["Email"] . ">" . $_POST["Email"] . "</a><br><br>";
echo "Major:" . "<br>" . $_POST["Major"] . "<br><br>";
echo "Comments:" . "<br>"  . $_POST["comments"] . "<br><br>";

$state = array("NA"=>"North America", "SA"=>"South America", "EU"=>"Europe", "EU"=>"Europe", "EU"=>"Asia", "AU"=>"Australia", "AF"=>"Africa", "AN"=>"Antartica");

echo "Continents Vistited:" . "<br>";
    if(isset($_POST['continent'])) {
      $continents = $_POST['continent'];

    foreach ($continents as $contValue){
        $fullName = $state[$contValue];
   echo $fullName."<br />";
  }}
  
  
  
?>
</body>
</html>