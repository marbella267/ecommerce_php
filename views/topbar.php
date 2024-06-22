<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .div {
            width: 100%;
            height: 250px;
            flex-shrink: 0;
            background: url('../img/Rectangle\ 1.png'), lightgray 50% / cover no-repeat;
            margin: auto;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
        }

        .h1 {
            margin: 10px 0;
            color: #000;
            font-family: Poppins;
            font-size: 61px;
            font-style: normal;
            font-weight: 500;
            line-height: normal;
            text-align: center;

        }

        img {
            width: 100px;
            object-fit: cover;
            margin-bottom: -40px;
        }

        .path {
            font-weight: bold;
            font-size: 16px;
            margin-left: -5px;
            padding: 0;
        }
    </style>
</head>

<body>
    <div class="div">
        <div>
            <img src="../img/logo.png" alt="">
        </div>
        <h1 class="h1"><?php if(isset($title))echo$title ?></h1>
        <div class="path">Home > <span style=" font-weight: normal;"><?php if(isset($title))echo$title ?></span> </div>
    </div>
</body>

</html>