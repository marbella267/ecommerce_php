<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <!-- <link href="style/main.css" rel="stylesheet"> -->
    <style>
        @media (max-width:992px) {
            .ff p {
                font-size: 20px;
            }

            .ff h1 {
                font-size: 50px;
            }

            .rr div {
                text-align: center;
            }

            .main-cont {
                padding: 0 20px;
            }
        }

        .btn-default {
            position: absolute;
            top: 80%;
            left: 50%;
            width: 200px;
            height: 50px;
            font-size: 20px;
            font-weight: 500;
            border: 0;
            background-color: white;
            border-radius: 30px;
            transition: 0.4s all;
            transform: translate(-50%, -50%);
        }

        .btn-default a {
            text-decoration: none;
            color: black;
            transition: 0.4s all;
            display: block;
        }

        .btn-default:hover {
            background-color: #c02234;
        }

        .btn-default:hover a {
            color: white;
        }

        .img {
            transition: 0.6s all;
        }

        .img:hover {
            transform: scale(1.1);
        }

        .cont {
            cursor: pointer;
        }

        .cont2 {
            overflow: hidden;
        }

        .kitchen-cont {
            padding: 0 70px !important;
        }

        .last-cont .btn-default {
            top: 85%;
        }
        .header{
            color: #1a2854;
            line-height: 24px;
            font-weight: 700;
        }
        .header::before,
        .header::after {
            background-color: #9e9e9e !important;
            position: absolute;
            content: "";
            width: 80px;
            height: 2px;
            background: #000;
            top: 48%;
        }

        .header::before {
            left: -95px;
        }

        .header::after {
            right: -95px;
        }
    </style>
</head>

<body>
    <div class="container-fluid p-0">
        <?php
        require "navbar.php";
        ?>

        <div>
            <div class="container-fluid">
                <img src="../img/Web-Banner-CountDown-07.png" class="w-100" alt="">
            </div>
        </div>
        <div class=" d-flex justify-content-center my-5">
            <h3 class="header m-auto position-relative d-inline-block"> Shop by Room </h3>
        </div>
        <div class="container-fluid row row-cols-xl-2 row-cols-lg-1 row-cols-sm-1 m-auto mt-5 px-lg-5">
            <div class="col my-3 position-relative cont">
                <div class=" p-0 m-0 cont2">
                    <img class="w-100 img" src="../img/bedroom.jpg" alt="">
                </div>
                <button class="btn-default">
                    <a href="http://localhost/ecommerce_php/views/products.php" class=" text-decoration-none">Bedroom</a>
                </button>
            </div>
            <div class="col my-3 position-relative cont">
                <div class=" p-0 m-0 cont2">
                    <img class="w-100 img" src="../img/livingroom.jpg" alt="">
                </div>
                <button class="btn-default">
                    <a href="http://localhost/ecommerce_php/views/products.php" class=" text-decoration-none">Living Room</a>
                </button>
            </div>
            <div class="col my-3 position-relative cont">
                <div class=" p-0 m-0 cont2">
                    <img class="w-100 img" src="../img/outdoor.jpg" alt="">
                </div>
                <button class="btn-default">
                    <a href="http://localhost/ecommerce_php/views/products.php" class=" text-decoration-none">Outdoor</a>
                </button>
            </div>
            <div class="col my-3 position-relative cont">
                <div class=" p-0 m-0 cont2">
                    <img class="w-100 img" src="../img/diningroom.jpg" alt="">
                </div>
                <button class="btn-default">
                    <a href="http://localhost/ecommerce_php/views/products.php" class=" text-decoration-none">Dining Room</a>
                </button>
            </div>

        </div>
        <div class=" d-flex justify-content-center my-5">
            <h3 class="header m-auto position-relative d-inline-block"> Trending Products</h3>
        </div>
        <div class="container-fluid row row-cols-lg-3 row-cols-md-2 row-cols-sm-1 m-auto my-3 ">
            <div class="col my-3 position-relative cont">
                <div class=" p-0 m-0 cont2">
                    <img class="w-100 img" src="../img/Hammoks.jpg" alt="">
                </div>
                <button class="btn-default">
                    <a href="http://localhost/ecommerce_php/views/products.php" class=" text-decoration-none">Shop Now</a>
                </button>
            </div>
            <div class="col my-3 position-relative cont">
                <div class=" p-0 m-0 cont2">
                    <img class="w-100 img" src="../img/bean bags.jpg" alt="">
                </div>
                <button class="btn-default">
                    <a href="http://localhost/ecommerce_php/views/products.php" class=" text-decoration-none">Shop Now</a>
                </button>
            </div>
            <div class="col my-3 position-relative cont">
                <div class=" p-0 m-0 cont2">
                    <img class="w-100 img" src="../img/recliner chair.jpg" alt="">
                </div>
                <button class="btn-default">
                    <a href="http://localhost/ecommerce_php/views/products.php" class=" text-decoration-none">Shop Now</a>
                </button>
            </div>
        </div>
        <div class=" d-flex justify-content-center">
            <h3 class="header m-auto position-relative d-inline-block"> Our Kitchen </h3>
        </div>
        <div class="container-fluid kitchen-cont">
            <div>
                <img src="../img/kitchen.jpg" class="w-100 my-5" alt="">
            </div>
            <div class="row row-cols-md-2 row-cols-sm-1 last-cont">
                <div class="col my-3 position-relative cont">
                    <div class=" p-0 m-0 cont2">
                        <img class="w-100 img" src="../img/shoe racks.jpg" alt="">
                    </div>
                    <button class="btn-default">
                        <a href="http://localhost/ecommerce_php/views/products.php" class=" text-decoration-none">Shop Now</a>
                    </button>
                </div>
                <div class="col my-3 position-relative cont">
                    <div class="p-0 m-0 cont2">
                        <img class="w-100 img" src="../img/tv-benches.jpg" alt="">
                    </div>
                    <button class="btn-default">
                        <a href="http://localhost/ecommerce_php/views/products.php" class=" text-decoration-none">Shop Now</a>
                    </button>
                </div>
            </div>
        </div>
        <div class=" d-flex justify-content-center my-5">
            <h3 class="header m-auto position-relative d-inline-block"> Follow us on Instagram </h3>
        </div>
        <?php
        require("./footer.php");
        ?>
    </div>
</body>

</html>