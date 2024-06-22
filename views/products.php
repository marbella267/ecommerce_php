<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Cards</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../views/buttonstyle.css?v=<?php echo time(); ?>">
    <!-- Font Awesome Cdn Link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>

<body>
    <div class="container-fluid p-0">
        <?php
        require '../modules/product.php';
        require '../modules/Connection.php';
        require("./navbar.php");
        $title = "Shop";
        require("topbar.php");
        $con = new Connection();
        $product = new product($con);
        $num_of_products = count($product->GetProducts());
        $start = 0;
        $product_per_page = 12;
        $num_pages = ceil($num_of_products / $product_per_page);
        $page = 1;
        if (isset($_GET['page'])) {
            $page = $_GET['page'];
            $start = ($page - 1) * $product_per_page;
        }
        //showing products
        $products = $product->Get7AvailableProducts($start, $product_per_page); ?>
        

        <div class="container mt-5">
            <div class="row row-cols-4 row-cols-lg-4 row-cols-md-2 row-cols-sm-1">
                <?php
                if (!empty($products)) {
                    foreach ($products as $product) {
                ?>
                        <div class="col my-3">
                            <div class="card h-100 border-0">
                                <img src="<?php echo $product['product_img']; ?>" class="card-img-top border-bottom border-top">
                                <div class="card-body">
                                    <h5 class="card-title mt-3 h-25 text-center pt-3"><?php echo $product['product_name']; ?></h5>
                                    <p class="card-text h-50 d-flex align-items-center"><?php
                                        echo $product['brief'];
                                        ?>
                                    </p>
                                    <a class='btn w-100' style="background-color: #FBEBB5;" href="http://localhost/ecommerce_php/views/product.php/?id=<?php echo $product['product_id'] ?>">
                                        Details
                                    </a>
                                </div>
                            </div>
                            <!-- <div class="card border-0 d-flex justify-content-between">
                                <div class="w-100 card-img-top">
                                    <img src="<?php echo $product['product_img']; ?>" class="w-100 h-100" style="" alt="Product img">
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title">
                                        <?php echo $product['product_name']; ?>
                                    </h5>
                                    <p class="card-text fw-bold fs-5"> Price:
                                        <?php
                                        $formatted_price = number_format($product['price'], 2, '.', ',');
                                        echo $formatted_price;
                                        ?>
                                        <sup>£</sup>
                                    </p>
                                    <a class='btn w-100' style="background-color: #FBEBB5;" href="http://localhost/ecommerce_php/views/product.php/?id=<?php echo $product['product_id'] ?>">
                                        Details
                                    </a>
                                </div>
                            </div> -->
                        </div>
                <?php
                    }
                } else {
                    echo "<p>No products found.</p>";
                }
                ?>
            </div>
        </div>
        <?php
        echo "<div class=' buttonsdiv'><h5 class='text-center text-muted'>showing   $page  of  $num_pages  pages</h5>"; ?>
        <?php
        echo  "
    <ul class='pagination justify-content-center ul'>
    ";
        if (isset($_GET['page']) && $_GET['page'] > 1) {
            $page = $_GET['page'] - 1;

            echo " <li class='page-item'>
        <a class='page-link btn01' href='?page=$page'><span aria-hidden='true'>&laquo;</span></a>
      </li> ";
        } else {
            echo "<li class='page-item'>
        <a class='page-link' href='#' > <span aria-hidden='true'>&laquo;</span></a>
      </li>";
        }

        ?>
        <?php
        for ($i = 1; $i <= $num_pages; $i++) {
            echo "<li class='page-item'><a class='page-link' href='?page=$i'>$i</a></li>";
        }
        ?>
        <?php
        if (isset($_GET['page']) && $_GET['page'] < $num_pages) {
            $page = $_GET['page'] + 1;
            echo " <li class='page-item'>
        <a class='page-link' href='?page=$page'> <span aria-hidden='true'>&raquo;</span></a>
      </li>";
        } else {
            echo " <li class='page-item'>
        <a class='page-link' href=''> <span aria-hidden='true'>&raquo;</span></a>
      </li>";
        } ?>
        </ul>
    </div>
    <?php
    require('./footer.php');
    ?>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>