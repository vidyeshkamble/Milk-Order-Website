<?php
require_once ('db.php');
session_start();
if (isset($_SESSION['id'])) {
    $temp = $_SESSION['id'];
    $name = mysqli_query($con, "SELECT name FROM login where phoneno = $temp");
    $row = mysqli_fetch_row($name);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Milk</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="https://www.prabhat-india.in/images/PBT_LOGO.png">
    <script src="https://code.jquery.com/jquery-3.7.1.slim.js"
        integrity="sha256-UgvvN8vBkgO0luPSUl2s8TIlOSYRoGFAX4jlCIm9Adc=" crossorigin="anonymous"></script>
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
            <a href="purchase.php">Order</a>
        </div>
        <div class="small-screen">
            <i class="fa-solid fa-bars open"></i>
        </div>
        <div class="navside">
            <i class="fa-solid fa-xmark close" id="close"></i>
            <a id="log" href="login.php">SIGN IN </a>
            <a href="purchase.php">Order</a>
        </div>
    </div>
    <span class="loader"></span>
    <?php
    if (isset($_SESSION['id'])) {
        ?>
        <div class="contaner font-text">
            <p> Wellcome <span style="color:brown; font-size:1.3rem;"><?php echo $row[0]; ?></span> on Milk Order...!</p>
        </div>
        <?php
        if (isset($_REQUEST['id'])) {
            $add = 0;
            $item = mysqli_query($con, "SELECT * FROM items WHERE itemno = '$_REQUEST[id]'");
            while ($row1 = mysqli_fetch_assoc($item)) {
                ?>
                <div class="page">
                    <div class="pg_left">
                        <form action="./purchase.php" method="get">
                            <img src="<?php echo $row1['img']; ?>">
                            <p><?php echo $row1['itemname']; ?></p>
                            <p><?php echo $row1['qty']; ?></p>
                            <p><?php echo "₹" . $row1['price'] . "\-"; ?></p>
                            <p><?php $_SESSION['current'] = $row1['itemno']; ?></p>
                            <input type="submit" class="pbay" name="goto" value="Purchase" onclick="done()">
                        </form>
                    </div>
                </div>
                <!-- Option Section -->
                <div class="slid-page">
                    <?php
            }

            $img = mysqli_query($con, "SELECT * FROM `items` where `itemno` != '$_REQUEST[id]' ");
            $i = 0;
            while ($row2 = mysqli_fetch_assoc($img)) {
                $counting[$i] = $row2['itemno'];
                ?>
                    <div class="page">
                        <div class="top">
                            <img src="<?php echo $row2['img']; ?>">
                        </div>
                        <div class="botm font-black">
                            <p><?php echo $row2['itemname']; ?></p>
                            <a href="order.php?id=<?php echo $counting[$i]; ?>" class="pbay"> Buy</a>
                        </div>
                    </div>
                    <?php
                    $i++;
            }
            ?>
            </div>
            <?php
        }
    } else {
        ?>
        <div class="error contaner">
            <p>Please Sign in First</p>
            <button><a href="./login.php" style="text-decoration: none;">Sign in</a></button>
        </div>
        <?php
    }
    ?>
</body>

</html>
<script>
    window.addEventListener("load", () => {
        const loader = document.querySelector(".loader");

        loader.classList.add("loader-hidden");
    })
    function done() {
        alert("One Item Added");
    }
    $(document).ready(function () {
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
        font-family: "Red Hat Display", sans-serif;
        font-optical-sizing: auto;
        font-style: normal;
    }

    ::-webkit-scrollbar {
        display: none;
    }

    * {
        margin: 0;
        padding: 0;
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

    /* error */
    .error {
        color: white;
        background-color: #17759C;
        margin-top: 30px;
        padding: 10px 0px;
    }

    .error button {
        padding: 3px 10px;
        background-color: aliceblue;
        border: 0px solid;
        border-radius: 5px;
        margin: 0px 10px;
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

    .navside {
        display: none;
    }

    /* Main Body */
    .contaner {
        width: 100%;
        display: flex;
        justify-content: center;
        overflow: hidden;
    }

    .font-text {
        color: white;
        font-family: "Montserrat", sans-serif;
    }

    .font-black {
        color: black;
        font-family: "Montserrat", sans-serif;
    }

    .pg_left img {
        height: 150px;
    }

    /* page Option */
    .slid-page {
        background-color: black;
        display: flex;
        overflow-x: auto;
    }

    .slid-page::-webkit-scrollbar {
        display: none;
    }

    .page {
        display: flex;
        justify-content: center;
        background-color: #fff;
        min-width: 230px;
        height: 300px;
        flex-direction: column;
        align-items: center;
        text-align: center;
        margin: 10px;
        border-radius: 20px;
    }

    .top img {
        height: 150px;
    }

    .botm {
        width: 100%;
        margin: 10px;
        display: flex;
        align-items: center;
        flex-direction: column;
    }

    .pbay {
        width: 100px;
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