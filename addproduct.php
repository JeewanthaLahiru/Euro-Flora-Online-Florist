<?php
    include "connection.php";

    $product_name = $product_price = $product_description = "";
    $product_name_err = $product_price_err = $product_description_err = $product_image_err = "";

    if($_SERVER["REQUEST_METHOD"]=="POST" && isset($_REQUEST["add_product"])){
        if(empty(trim($_REQUEST["product_name"]))){
            $product_name_err = "please enter a name";
        }else{
            $product_name = trim($_REQUEST["product_name"]);
        }

        if(empty(trim($_REQUEST["product_description"]))){
            $product_description_err = "please enter a description";
        }else{
            $product_description = trim($_REQUEST["product_description"]);
        }

        if(empty(trim($_REQUEST["product_price"]))){
            $product_price_err = "please enter a price";
        }else{
            $product_price = $_REQUEST["product_price"];
        }

        if($_FILES["product_image"]["size"] == 0){
            $product_image_err = "please upload an image";
        }else{
            $image_name = $_FILES["product_image"]["name"];
            $image_type = $_FILES["product_image"]["type"];
            $image_data = file_get_contents($_FILES["product_image"]["tmp_name"]); 
        }

        if(empty($product_name_err) && empty($product_description_err) && empty($product_price_err) && empty($product_image_err)){
            $sql = "INSERT INTO `products`(`product_name`, `product_description`, `product_price`, `image_name`, `image_mime`, `image_data`) VALUES (:pname,:pdesc,:pprice,:name,:mime,:data)";
            if($stmt = $conn->prepare($sql)){
                $stmt->bindParam(":pname",$product_name);
                $stmt->bindParam(":pdesc",$product_description);
                $stmt->bindParam(":pprice",$product_price);
                $stmt->bindParam(":name",$image_name);
                $stmt->bindParam(":mime",$image_type);
                $stmt->bindParam(":data",$image_data);

                if($stmt->execute()){
                    header("location:addproduct.php?msg=1");
                }else{
                    echo "There was an error";
                }
            }else{
                echo "there was an error";
            }
        }
    }

    $home_message = "";
    if(isset($_REQUEST["msg"])){
        if($_REQUEST["msg"]==1){
            $home_message = "product added successfully";
        }
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Euro Flora</title>
</head>
<body>
    <p><?php echo $home_message?></p>

    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post" enctype="multipart/form-data">

        <input type="text" name="product_name" id="" placeholder="Product name">
        <p><?php echo $product_name_err ?></p>

        <input type="text" name="product_description" id="" placeholder="Description">
        <p><?php echo $product_description_err ?></p>

        <input type="text" name="product_price" id="" placeholder="Price">
        <p><?php echo $product_price_err ?></p>

        <input type="file" name="product_image" id="">
        <p><?php echo $product_image_err ?></p>

        <input type="submit" value="Add Product" name="add_product">
    
    </form>
    
</body>
</html>