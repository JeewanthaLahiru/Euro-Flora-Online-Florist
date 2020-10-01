<?php
    include "connection.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="styles/index.css">
    <title>Euro Flora</title>
</head>
<body>
<div class="navBar" id="navBarId">
    <a href="index.php" class="logo_icon"><img src="images/logo-small.png" alt=""></a>
    <a href="javascript:void(0)" class="icon" onclick="navBarFunction()"><i class="fa fa-bars"></i></a>
    <a href=""><i class="fa fa-comment" aria-hidden="true"></i> Chat</a>
    <a href=""><i class="fa fa-phone" aria-hidden="true"></i> Order by phone</a>
    <a href=""><i class="fa fa-cogs" aria-hidden="true"></i> How to order</a>
    <a href=""><i class="fa fa-camera" aria-hidden="true"></i> Gallery</a>
    <a href="addproduct.php"><i class="fa fa-th-large" aria-hidden="true"></i> The florist</a>
    <a href=""><i class="fa fa-envelope" aria-hidden="true"></i> Contact us</a>
    <a href="index.php"><i class="fa fa-home" aria-hidden="true"></i> Home</a>
</div>

<div class="body">
    <div class="grid-container">
        <?php
            $sql = "SELECT * FROM products";
            if($stmt = $conn->prepare($sql)){
                $stmt->execute();
                while($row = $stmt->fetch()){
                    echo "<div class='grid-item'>";
                    echo "<img src='data:".$row['image_mime'].";base64,".base64_encode($row['image_data'])."'>";
                    echo "<h3>".$row['product_name']."</h3>";
                    echo "<p>".$row['product_description']."</p>";
                    echo "<h4>".$row['product_price']."</h4>";
                    echo "</div>";
                }
            }else{
                echo "there was an error";
            }
        ?>
    </div>
</div>


<script src="scripts/index.js"></script>
    
</body>
</html>