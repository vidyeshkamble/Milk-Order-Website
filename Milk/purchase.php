<?php
session_start();
$totle = 0;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Milk</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="https://www.prabhat-india.in/images/PBT_LOGO.png">
    <script src="https://code.jquery.com/jquery-3.7.1.slim.js"
        integrity="sha256-UgvvN8vBkgO0luPSUl2s8TIlOSYRoGFAX4jlCIm9Adc=" crossorigin="anonymous">
        </script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Red+Hat+Display:ital,wght@0,300..900;1,300..900&display=swap"
        rel="stylesheet">
</head>

<body>
    <div class="nav-bar">
        <div class="nav-logo">
            <img src="https://www.prabhat-india.in/images/PBT_LOGO.png">
        </div>
        <div class="nav-but">
            <a id="home" href="home.php">HOME</a>
            <a id="log" href="login.php">SIGN IN </a>
            <a href="order.php?id=<?php echo $_SESSION['current']; ?>">ORDER MORE</a>
        </div>
        <div class="small-screen">
            <i class="fa-solid fa-bars open"></i>
        </div>
        <div class="navside">
            <i class="fa-solid fa-xmark close" id="close"></i>
            <a id="log" href="login.php">SIGN IN </a>
            <a href="order.php?id=<?php echo $_SESSION['current']; ?>">ORDER MORE</a>
        </div>
    </div>
    <span class="loader"></span>
    <?php
    require_once ('db.php');

    $name = mysqli_query($con, "SELECT * FROM login where phoneno = $_SESSION[id]");
    while ($row1 = mysqli_fetch_assoc($name)) {
        $rname = $row1['name'];
        $rassress = $row1['address'];
        $rphoneno = $row1['phoneno'];
    }

    $item = mysqli_query($con, "SELECT * FROM `items` WHERE `itemno` = '$_SESSION[current]'");
    if (isset($_GET['goto'])) {
        while ($row = mysqli_fetch_assoc($item)) {
            $insert = "INSERT INTO `order`(`itemno`, `itemname`, `qty` , `price` , `name`, `address`, `phoneno`) VALUES ('$row[itemno]','$row[itemname]','$row[qty]','$row[price]','$rname','$rassress','$_SESSION[id]')";
            $query = mysqli_query($con, $insert);
        }
    }
    $order = mysqli_query($con, "SELECT * FROM `order` WHERE phoneno = $_SESSION[id]");
    ?>
    <?php
    if (isset($_GET['goto'])) {
        $solve=$_SESSION['current'];
        header("location:order.php?id=$solve");
    }
    ?>
    <div class="main-table">
        <table>
            <tr>
                <th>Name</th>   
                <th>Qty</th>
                <th>Price</th>
                <th>Delete</th>
            </tr>
            <?php
            while ($ord = mysqli_fetch_assoc($order)) {
                ?>
                <tr>
                    <td><?php echo $ord['itemname']; ?></td>
                    <td><?php echo $ord['qty']; ?></td>
                    <td><?php echo "₹" . $ord['price'] . "\-";
                    $totle = $ord['price'] + $totle;
                    ?></td>
                    <td><a href="delete.php?id=<?php echo $ord['itemno']; ?>"><i class="fa-solid fa-trash"></i> Delete</a>
                    </td>
                </tr>
                <?php
            }
            ?>
            <tr>
                <td></td>
                <td>TOTLE :-</td>
                <td><?php echo "₹" . $totle . "\-"; ?></td>
                <td></td>
            </tr>
        </table>
    </div>
    <div class="pay-togo">
        <button class="pbay" id="on"><i class="fa-solid fa-bag-shopping"></i> Place Order</button>
    </div>

    <div class="payment" id="payment">
        <h3>Payment</h3><br>
        <a>Scan the QR code on the the Payment Application.</a>
        <img
            src="https://img.freepik.com/free-vector/scan-me-qr-code_78370-2915.jpg?size=338&ext=jpg&ga=GA1.1.672697106.1717286400&semt=ais_user">
        <button id="closeing" class="pay-done"><i class="fa-solid fa-xmark"></i></button>
        <a href="home.php" class="pay-done"><i class="fa-solid fa-check"></i> Payment Done</a>
    </div>

    <div class="test">
    </div>
    <div class="tt">
    </div>
</body>

</html>
<script>
    window.addEventListener("load", () => {
        const loader = document.querySelector(".loader");

        loader.classList.add("loader-hidden");
    })
    $(document).ready(function () {
        $('#payment').hide();
        $('#closeing').click(function () {
            $('#payment').hide();
        });
        $('#on').click(function () {
            $('#payment').show();
        });
        $('#close').click(function () {
            $('.navside').css("right", "-400px");
            $('.small-screen').show();
        });
        $('.open').click(function () {
            $('.navside').css("right", "0");
            $('.small-screen').hide();
        });
    });
</script>
<style>
    html {
        background-color: black;
        overflow: hidden;
        font-family: "Red Hat Display", sans-serif;
        font-optical-sizing: auto;
        font-style: normal;
    }

    /* loader */
    .loader {
        position: fixed;
        top: 0;
        left: 0;
        width: 100vw;
        height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
        background-color: #f7f9fb;
        transition: opacity 0.75s, visibility 0.75s;
    }

    .loader-hidden {
        opacity: 0;
        visibility: hidden;
    }

    .loader::after {
        content: "";
        width: 75px;
        height: 75px;
        border: 15px solid #dddddd;
        border-top-color: #744985;
        border-radius: 50%;
        animation: loading 0.75s ease infinite;
    }

    @keyframes loading {
        from {
            transform: rotate(0turn);
        }

        to {
            transform: rotate(1turn);
        }
    }

    ::-webkit-scrollbar {
        display: none;
    }

    * {
        margin: 0;
        padding: 0;
    }

    .nav-bar {
        display: flex;
        width: 100%;
        justify-content: space-evenly;
        align-items: center;
        position: sticky;
        backdrop-filter: blur(180px);
        top: 0;
        z-index: 1;
    }

    .nav-logo img {
        height: 10vh;
        mix-blend-mode: multiply;
    }

    .nav-but a {
        padding: 10px 20px;
        color: white;
        cursor: pointer;
        font-size: 1.2rem;
        font-family: "Montserrat", sans-serif;
        text-decoration: none;
    }

    .small-screen {
        display: none;
    }

    .navside {
        display: none;
    }

    /* Main Body */
    .main-table {
        margin-top: 20px;
        width: 100%;
        height: auto;
        display: flex;
        justify-content: center;
    }

    table tr th,
    td {
        color: white;
        padding: 5px;
    }

    table {
        width: 600px;
    }

    table a {
        color: black;
        text-decoration: none;
        background-color: lightcoral;
        padding: 1px 4px;
        border-radius: 4px;
    }

    .pay-togo {
        width: 100%;
        text-align: center;
    }

    /* payment page */
    .payment {
        background-color: #17759C;
        padding: 70px 100px;
        position: absolute;
        top: 100px;
        left: 50%;
        transform: translate(-50%);
        color: white;
        width: 150px;
        display: flex;
        text-align: center;
        flex-direction: column;
        border-radius: 10px;
    }

    .payment img {
        margin-top: 30px;
    }

    .pay-done {
        margin-top: 20px;
        background-color: white;
        color: black;
        border: 0px;
        padding: 4px;
        border-radius: 5px;
        text-decoration: none;
    }

    /* Button */
    .pbay {
        width: 200px;
        border-radius: 4px;
        box-shadow: 1px 1px 5px black;
        padding: 10px;
        background-color: #17759C;
        color: white;
        border: 0px;
        margin-top: 10px;
        text-decoration: none;
    }

    .pbay:hover {
        background-color: #fff;
        color: #17759C;
        border: 1px solid black;
        transition: 0.5s;
    }

    .pbay:active {
        box-shadow: 0px 0px 0px;
        transition: 0.1s;
    }

    .test {
        width: 10px;
        height: 60px;
        background-color: white;
        position: absolute;
        top: 0px;
    }

    .tt {
        width: 10px;
        height: 60px;
        background-color: white;
        position: absolute;
        top: 0px;
        right: 0;
    }

    @media screen and (max-width: 800px) {
        .navside {
            background-color: gray;
            position: absolute;
            width: 60%;
            display: flex;
            top: 0;
            right: -400px;
            height: 100vh;
            flex-direction: column;
            padding: 120px 20px;
            backdrop-filter: blur(10px);
            transition: 0.8s ease-out
        }

        .navside a {
            width: 60%;
            margin: 1px;
            padding: 10px;
            background-color: rgba(255, 255, 255, 0.772);
            text-decoration: none;
        }

        .nav-bar {
            justify-content: space-between;
        }

        .nav-bar .nav-but {
            display: none;
        }

        .close {
            width: 100%;
            display: flex;
            justify-content: end;
            margin-bottom: 50px;
            font-size: 1.3rem;
        }

        .small-screen {
            display: block;
            margin: 0px 20px;
            color: white;
        }
    }
</style>