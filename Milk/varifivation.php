<?php
require_once ('db.php');
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.jquery.com/jquery-3.7.1.slim.js"
        integrity="sha256-UgvvN8vBkgO0luPSUl2s8TIlOSYRoGFAX4jlCIm9Adc=" crossorigin="anonymous"></script>
    <title>Milk</title>
    <link rel="shortcut icon" href="https://www.prabhat-india.in/images/PBT_LOGO.png">
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
        <div class="logo">
            <img src="https://i.pinimg.com/736x/8d/04/9f/8d049f478b5c76d00d3598db37a503a9.jpg">
        </div>
        <div class="info">
            <button id="home">Home</button>
            <button id="log">Login</button>
            <button id="sig">Sign up</button>
        </div>
    </div>
    <span class="loader"></span>
    <!-- main page -->
    <div class="contaner">
        <?php
        if (isset($_POST['user']))
            if ($_POST['user'] === '1237894560' && $_POST['pass'] === 'admin') {
                header('location:admin.php');
            } else {
                if (isset($_POST['s'])) {
                    $mo = $_POST['user'];
                    $_SESSION['id'] = $mo;
                    $pas = $_POST['pass'];
                    if ($mo === '' || $pas === '') {
                        ?>
                        <div class="page-error">
                            <p>Enter Mobile no and Password</p>
                            <input type="button" id="out" value="Back" />
                        </div>

                        <?php
                    }
                    $stemp = 0;
                    $sign = mysqli_query($con, "SELECT * FROM sign");
                    if (isset($sign)) {
                        while ($srow = mysqli_fetch_assoc($sign)) {
                            if ($srow['phoneno'] == $mo && $srow['password'] == $pas) {
                                $stemp = 1;
                            }
                        }
                        if ($stemp == 0) {
                            ?>
                            <div class="page-error">
                                <p>User not Found</p>
                                <input type="button" id="out" value="Back" />
                            </div>
                            <?php
                        }
                        if ($stemp == 1) {
                            header('location:home.php');
                        }
                    }
                }
            }
        ?>
        <!-- Login Varifivation -->
        <?php
        if (isset($_POST['inset-table'])) {
            $name = $_POST['name'];
            $mobile = $_POST['mobile'];
            $emil = $_POST['emil'];
            $address = $_POST['address'];
            $pass = $_POST['password'];
            $conpass = $_POST['conform-password'];
            if ($name === '' || $mobile === '' || $emil === '' || $address === '' || $pass === '' || $conpass === '') {
                ?>
                <div class="page-error">
                    <p>Enter Proper Information</p>
                    <input type="button" id="out" value="Back" />
                </div>
                <?php
            }
            $temp = 0;
            $find = mysqli_query($con, "SELECT * FROM login");
            while ($row = mysqli_fetch_assoc($find)) {
                if ($row['phoneno'] == $mobile) {
                    $temp = 1;
                }
            }
            if ($temp == 1) {
                ?>
                <div class="page-error">
                    <p>User order has been Created</p>
                    <input type="button" id="out" value="Back" />
                </div>

                <?php
            } else
                if ($conpass == $pass) {
                    $in = mysqli_query($con, "INSERT INTO login (`name`, `phoneno`, `email`, `address`) VALUES ('$name','$mobile','$emil','$address');");
                    $sin = mysqli_query($con, "INSERT INTO sign (`phoneno`, `password`) VALUES ('$mobile','$pass')");
                    if (isset($in)) {
                        ?>
                        <div class="page-error">
                            <p>New Login Has been Created</p>

                            <input type="button" id="out" value="Back" />
                        </div>

                        <?php
                    }
                } else {
                    ?>
                    <div class="page-error">
                        <p>Not Match</p>
                        <input type="button" id="out" value="Back" />
                    </div>

                    <?php
                }
        }
        ?>
        <!-- add to card -->
        <?php
        if (isset($_POST['addtocard'])) {
            if ($_POST['image'] === '' || $_POST['no'] === '' || $_POST['itemname'] === '' || $_POST['price'] === '' || $_POST['qty'] === '') {
                ?>
                <div class="page-error">
                    <p>Enter Proper values</p>
                    <a href="admin.php">Back</a>
                </div>
                <?php
            } else {
                $card = mysqli_query($con, "INSERT INTO `items`(`img`, `itemno`, `itemname`, `price`, `qty`) VALUES ('$_POST[image]','$_POST[no]','$_POST[itemname]','$_POST[price]','$_POST[qty]')");
                if (isset($card)) {
                    header('location:admin.php');
                } else {
                    ?>
                    <div class="page-error">
                        <p>Problem to Add item</p>
                        <a href="admin.php">Back</a>
                    </div>
                    <?php
                }
            }
        }
        ?>
    </div>
</body>

</html>
<script>
    window.addEventListener("load", () => {
        const loader = document.querySelector(".loader");

        loader.classList.add("loader-hidden");
    })
    $(document).ready(function () {
        $('#out').click(function () {
            window.location.href = "login.php";
        });
        $('#in').click(function () {
            window.location.href = "home.php";
        });
    });
</script>
<style>
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

    html {
        font-family: "Red Hat Display", sans-serif;
        font-optical-sizing: auto;
        font-style: normal;
    }

    .nav-bar {
        width: 100%;
        height: 100px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        background: transparent;
        backdrop-filter: blur(10px);
        position: fixed;
        top: 0;
        z-index: 1;
    }

    .logo img {
        height: 100px;
        mix-blend-mode: multiply;
    }

    .info button {
        border: 0px;
        background-color: darkslategray;
        color: white;
        padding: 10px 15px;
        border-radius: 5px;
    }

    /* main page CSS */
    .contaner {
        width: 100%;
        height: 98vh;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .page-error {
        background-color: darkslategray;
        padding: 10px;
        border-radius: 10px;
        color: white;
    }
</style>