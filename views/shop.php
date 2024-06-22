<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Cards</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>

<body>
    <?php
        require '../views/navbar.php';
    ?>
    <br><br>
    <div class="container">
        <div class="row">
            <?php
            require '../modules/product.php';
            require '../modules/Connection.php';
            if($_SERVER["REQUEST_METHOD"]=="POST"){
                $Search=$_REQUEST["Search_Product"];
            };
            $conn = new Connection();
            $product = new product($conn);
            $rows = $product->get_products_by_search($Search);
            
            if (!empty($rows)) {
                foreach ($rows as $product) 
                {
            
            
            ?>
            
            <div class="col-md-4">
                <div class="card mb-4" >
                    <img src="<?php echo $product['product_img']; ?>" class="card-img-top" alt="Product img" style="height: 250px;">
                    <div class="card-body">
                        <h5 class="card-title">
                            <?php echo $product['product_name']; ?>
                        </h5>
                        <p class="card-text"> Price:
                            <?php echo $product['price']; ?>
                        </p>
                        <a class='btn btn-primary' href="http://localhost/ecommerce_php/views/product.php/?id=<?php  echo $product['product_id']?>">
                            Details
                </a>                    </div>
                </div>
            </div>

            <?php
                }
            } else {
                echo "<p>No products found.</p>";
            }
            ?>

        </div>
    </div>
</body>
</html>