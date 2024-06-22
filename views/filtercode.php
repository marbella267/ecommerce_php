<?php
$isset = false;

// Connect to Database
try {
    $conn = new mysqli("localhost", "root", "", "e-commerce");
} catch (Exception $e) {
    die("Connection failed: ".$e->getMessage());
}

// Fetch All Categories
$categoriesQuery = "SELECT * FROM `category`"; // Adjust the table name if needed
$categoriesResult = $conn->query($categoriesQuery);
$categoriesData = $categoriesResult->fetch_all(MYSQLI_ASSOC);

// Create an associative array for categories
$categories = [];
foreach ($categoriesData as $category) {
    $categories[$category["category_name"]] = $category["category_id"];
}

// Fetch All Products
$query = "SELECT * FROM `products`";
$result = $conn->query($query);
$data = $result->fetch_all(MYSQLI_ASSOC);
$filteredData = $data;

// Filter By Category
function filterByCategory(&$filteredData, $catID)
{
    $filteredByCat = array_filter($filteredData, function ($data) use ($catID) {
        return $data["category_id"] == $catID;
    });
    $filteredData = $filteredByCat;
}

// Filter By Price Range
function filterByPriceRange(&$filteredData, $start, $end)
{
    $filteredByPrice = array_filter($filteredData, function ($data) use ($start, $end) {
        return $data["price"] >= $start && $data["price"] <= $end;
    });
    $filteredData = $filteredByPrice;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $cat = $_POST["filterCat"];
    $start = $_POST["filterPriceStart"];
    $end = $_POST["filterPriceEnd"];
    filterByCategory($filteredData, $categories[$cat]);
    filterByPriceRange($filteredData, $start, $end);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> FILTER </title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
    <style>
        ::-webkit-scrollbar {
            scroll-behavior: smooth;
        }
    </style>
</head>

<body>
    <div class="container m-5 d-flex " style="justify-content:space-around">

        <button class="btn btn-outline-dark " style="width: 100px;" type="button" data-bs-toggle="dropdown"><svg xmlns="http://www.w3.org/2000/svg" width="17" height="17" fill="currentColor" class="bi bi-sliders" style="margin-right: 10px;" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M11.5 2a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3M9.05 3a2.5 2.5 0 0 1 4.9 0H16v1h-2.05a2.5 2.5 0 0 1-4.9 0H0V3zM4.5 7a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3M2.05 8a2.5 2.5 0 0 1 4.9 0H16v1H6.95a2.5 2.5 0 0 1-4.9 0H0V8zm9.45 4a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3m-2.45 1a2.5 2.5 0 0 1 4.9 0H16v1h-2.05a2.5 2.5 0 0 1-4.9 0H0v-1z" />
            </svg>Filter</button>
        <div class="dropdown-menu p-4 w-25">


            <form method="post" class="form align_items-cente">
                <div class="mb-3">
                    <label for="category" class="mb-2"> <strong>Category :</strong></label>
                    <select class="form-control" name="filterCat" placeholder="Select Category">
                        <?php foreach ($categories as $categoryName => $categoryId) : ?>
                            <option value="<?php echo $categoryName; ?>"><?php echo ucfirst($categoryName); ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="price-range" class="mb-2"><strong>Price Range :</strong></label>
                    <input type="number" class="form-control mb-3" name="filterPriceStart" placeholder=" Enter the Start Of Price Range ... ">
                    <input type="number" class="form-control " name="filterPriceEnd" placeholder=" Enter the End Of Price Range ... ">
                </div>
                <button type="submit" class="btn btn-primary">Apply Filter</button>
            </form>

        </div>
        <div class="buttons-container">
            <button class="btn" onclick="changeLayout('list')">
                Change to List View
                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-list-nested" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M4.5 11.5A.5.5 0 0 1 5 11h10a.5.5 0 0 1 0 1H5a.5.5 0 0 1-.5-.5m-2-4A.5.5 0 0 1 3 7h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5m-2-4A.5.5 0 0 1 1 3h10a.5.5 0 0 1 0 1H1a.5.5 0 0 1-.5-.5" />
                </svg>
            </button>
            <button class="btn" onclick="changeLayout('grid')">
                Change to Grid View
                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-columns-gap" viewBox="0 0 16 16">
                    <path d="M6 1v3H1V1zM1 0a1 1 0 0 0-1 1v3a1 1 0 0 0 1 1h5a1 1 0 0 0 1-1V1a1 1 0 0 0-1-1zm14 12v3h-5v-3zm-5-1a1 1 0 0 0-1 1v3a1 1 0 0 0 1 1h5a1 1 0 0 0 1-1v-3a1 1 0 0 0-1-1zM6 8v7H1V8zM1 7a1 1 0 0 0-1 1v7a1 1 0 0 0 1 1h5a1 1 0 0 0 1-1V8a1 1 0 0 0-1-1zm14-6v7h-5V1zm-5-1a1 1 0 0 0-1 1v7a1 1 0 0 0 1 1h5a1 1 0 0 0 1-1V1a1 1 0 0 0-1-1z" />
                </svg>
            </button>
        </div>
    </div>
    <div class="row" id="product-items" style="align-items:stretch; justify-content:space-evenly;">
        <?php foreach ($filteredData as $product) : ?>
            <div class='col-3 p-3  card' style="width:340px ; border:none; align-items:stretch;">
                <img src='<?php echo $product["product_img"]; ?>' style='height:250px; object-fit: contain;' />
                <div class='card-body text-center'>
                    <h3 class='card-title'><?php echo $product["product_name"]; ?></h3>
                    <p class='card-content'>Quantity: <?php echo $product["quantity"]; ?></p>
                    <p class='card-content'>Brief: <?php echo $product["brief"]; ?></p>
                    <p class='card-content'>Status: <?php echo $product["status"]; ?></p>
                    <h4 class='card-content'><?php echo $product["price"] . '$'; ?></h4>
                </div>
            </div>
        <?php endforeach; ?>

        <?php if (empty($filteredData)) : ?>
            <p class="text-center">No products found.</p>
        <?php endif; ?>



    </div>
    <script>
        function changeLayout(layout) {
            const productItems = document.getElementById('product-items');

            if (layout === 'list') {
                productItems.innerHTML = '<?php foreach ($filteredData as $product) : ?>' +
                    '<div class="col-3 p-3 card" style="width:340px; border:none; align-items:stretch;">' +
                    '<img src="<?php echo $product["product_img"]; ?>" style="height:250px; object-fit: contain;" />' +
                    '<div class="card-body text-center">' +
                    '<h3 class="card-title"><?php echo $product["product_name"]; ?></h3>' +
                    '<p class="card-content">Quantity: <?php echo $product["quantity"]; ?></p>' +
                    '<p class="card-content">Brief: <?php echo $product["brief"]; ?></p>' +
                    '<p class="card-content">Status: <?php echo $product["status"]; ?></p>' +
                    '<h4 class="card-content"><?php echo $product["price"] . "$"; ?></h4>' +
                    '</div>' +
                    '</div>' +
                    '<?php endforeach; ?> ';

            } else if (layout === 'grid') {
                productItems.innerHTML = '<?php foreach ($filteredData as $product) : ?>' +
                    '<div class="col-6 p-3 card" style="width:500px; border:none; align-items:stretch;">' +
                    '<img src="<?php echo $product["product_img"]; ?>" style="height:250px; object-fit: contain;" />' +
                    '<div class="card-body text-center">' +
                    '<h3 class="card-title"><?php echo $product["product_name"]; ?></h3>' +
                    '<p class="card-content">Quantity: <?php echo $product["quantity"]; ?></p>' +
                    '<p class="card-content">Brief: <?php echo $product["brief"]; ?></p>' +
                    '<p class="card-content">Status: <?php echo $product["status"]; ?></p>' +
                    '<p class="card-content">Status: <?php echo $product["description"]; ?></p>' +
                    '<h4 class="card-content"><?php echo $product["price"] . "$"; ?></h4>' +
                    '</div>' +
                    '</div>' +
                    '<?php endforeach; ?>';
            }
        }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>