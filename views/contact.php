<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <title>Contact</title>
    <style>
        @media (max-width:992px) {
            .ff p {
                font-size: 20px;
            }
            .ff h1{
                font-size: 50px;
            }
            .rr div{
                text-align:center ;
            }
        }
    </style>
</head>

<body>
    <?php
    $title = "Contact";
    require"./navbar.php";
    require('topbar.php');

    ?>
    <div class="container-fluid p-0">
        <div class="pt-5 pb-5 text-center">
            <h1>Get In Touch With Us</h1>
            <p class="text-muted">For More Information About Our Product & Services. Please Feel Free To Drop Us <br>An Email. Our Staff Always Be There To Help You Out. Do Not Hesitate</p>
        </div>
       
       
        <div class="row pb-5 pt-5 container m-auto">
            <div class="col-lg-6 ll">
                <div>
                    <h3 style="font-size:30px;">Address</h3>
                    <p>236 5th SE Avenue, New <br>york NY10000, United <br>State</p>
                </div>
                <div>
                    <h3 style="font-size:30px;">Phone</h3>
                    <p>Mobile: +(84) 546-6789 <br>Hotline: +(84) 456-6789</p>
                </div>
                <div>
                    <h3 style="font-size:30px;">Working Time</h3>
                    <p>Monday-Friday: 9:00-<br>22:00 <br>Saturday-Sunday: 9:00-<br>21:00</p>
                </div>
            </div>
            <div class="col-lg-6  p-0">
                <label class="mb-3 fw-bold">Your name</label>
                <input type="text" class="form-control w-75 mb-4" placeholder="Abc">
                <label class="mb-3 fw-bold">Email address</label>
                <input type="text" class="form-control w-75 mb-4" placeholder="Abc@def.com">
                <label class="mb-3 fw-bold">Subject</label>
                <input type="text" class="form-control w-75 mb-4" placeholder="This is an optional">
                <label class="mb-3 fw-bold">Message</label>
                <textarea type="text" class="form-control w-75 mb-4" placeholder="Hi! i'd like to ask about" rows="4"></textarea>
                <button type="submit" class="btn btn-outline-dark mt-4">Submit</button>
            </div>

        </div>
        <?php
        require("footer.php")
        ?>
    </div>
</body>

</html>