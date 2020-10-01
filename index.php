<?php
    include "connection.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="styles/index2.css">
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
    <div class="section_two">
        <h1><span>Malshan Flora</span> your online florist to deliver flowers in kotikawatta</h1>
    </div>

    <div class="section_three">
        <div class="imageLeft">
            <img src="images/euroflora-florist-flower-bouquet.jpg" alt="">
            <div>
                <h4>SEPTEMBER OFFERS: TODAY -15%</h4>
                <hr>
                <p>Delivery service included</p>
            </div>
        </div>
        <div class="imageRight">
            <img src="images/cheyanne.jpg" alt="">
        </div>
    </div>
    <hr><hr>

    <div class="grid-container">
        <?php

            if(!isset($_REQUEST['pgn'])){
                $page = 1;
            }else{
                $page = $_REQUEST['pgn'];
            }
            $results_per_page = 4;
            $starting_number = ($page-1)*$results_per_page;
            $sql0 = "SELECT * FROM products";
            if($stat=$conn->prepare($sql0)){
                $stat->execute();
                $number_of_results = $stat->rowCount();
            }
            $sql = "SELECT * FROM products LIMIT ".$starting_number.",".$results_per_page;
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
            if(isset($_REQUEST['pgn'])){
                $lest_page = $_REQUEST['pgn']-1;
                $increase_page = $_REQUEST['pgn']+1;
            }
        ?>
    </div>

    <div class="pagination">
        <a href="<?php if(isset($_REQUEST['pgn'])){if($page==1){ echo 'index.php';}else{ echo 'index.php?pgn='.$lest_page;}} ?>"><i class='fa fa-caret-left' aria-hidden='true'></i></a>
        <?php
            $number_of_pages = ceil($number_of_results/$results_per_page);
            for($x=1;$x<=$number_of_pages;$x++){
                echo "<a href='index.php?pgn=".$x."'>".$x."</a>";
            }
            
        ?>
        <a href="<?php if(isset($_REQUEST['pgn'])){if($page<=$number_of_pages){ echo 'index.php';}else{ echo 'index.php?pgn='.$increase_page;}}else{ echo 'index.php?pgn=2'; } ?>"><i class='fa fa-caret-right' aria-hidden='true'></i></a>
    </div>
</div>


<script src="scripts/index.js"></script>
    
</body>
</html>