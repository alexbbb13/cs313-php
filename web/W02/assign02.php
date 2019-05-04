<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" name="viewport" content="width=devicewidth, initial-scale=1.0">
    <title>Alex B's Home Page</title>
    <link rel = "stylesheet"
          type = "text/css"
          href = "w02style.css" />
</head>
<body>
    <h2>Welcome to Alex B's Home Page</h2>
    <hr>
    <ul>
        <li><a href="assign02.php">Home</a></li>
        <li><a href="../assignments.html">Assignments</a></li>
    </ul>
    <img alt="Picture of A.B" width="30%", height="30%" src="me.jpg"  >

            <p>My name is Alex B. I was born and live in <b>Moscow, Russia</b>. I am married, and we have have two boys age 8 and 2.</p>
            <p> Last four years I am working as an Android developer <br>
            I am trying to get a degree because I do not have formal education in the field.
                I study in BYUI after gradiation from the <b>Pathway program</b>.</p>

            <p>My major is <b>Software Engineering</b>, as I aim to get as much structured IT field knowledge as possible,
                because I was a fan of computers and programming since childhood.
            </p>
     <hr>
        <p class="timestamp">
        <?php
            echo 'Created at: '. date('Y-m-d');
        ?>
        </p>
    </div>

</body>
</html>