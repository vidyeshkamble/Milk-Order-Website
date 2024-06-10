<?php
require_once ('db.php');
session_start();
?>
<!DOCTYPE html>
<html>

<head>
    <title>Milk</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="https://www.prabhat-india.in/images/PBT_LOGO.png">
    <script src="https://code.jquery.com/jquery-3.7.1.slim.js"
        integrity="sha256-UgvvN8vBkgO0luPSUl2s8TIlOSYRoGFAX4jlCIm9Adc=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Red+Hat+Display:ital,wght@0,300..900;1,300..900&display=swap"
        rel="stylesheet">
</head>

<body>
    <!-- nav bar -->
    <div class="nav-bar">
        <div class="nav-logo">
            <img src="https://www.prabhat-india.in/images/PBT_LOGO.png">
        </div>
        <div class="nav-but">
            <a id="home">HOME</a>
            <a class="gosign">SIGN IN</a>
            <a class="log">LOGIN</a>
            <?php
            if (isset($_SESSION['id'])) {
                ?><a class="opt" href="./logout.php" style="text-decoration: none;">LOGOUT</a><?php
            }
            ?>
        </div>
        <div class="small-screen">
            <i class="fa-solid fa-bars open"></i>
        </div>
        <div class="navside">
            <i class="fa-solid fa-xmark close" id="close"></i>
            <a href="home.php">HOME</a>
            <a class="gosign">SIGN IN</a>
            <a class="log">LOGIN</a>
            <?php
            if (isset($_SESSION['id'])) {
                ?><a class="opt" href="./logout.php" style="text-decoration: none;">LOGOUT</a><?php
            }
            ?>
        </div>
    </div>
    <!-- Sign in page -->
    <span class="loader"></span>
    <div class="contener">
        <div class="page">
            <div class="page-left sign">
                <form method="post" action="varifivation.php">

                    <input type="text" id="phone" name="user" placeholder="Enter Mobile no" maxlength="10"
                        pattern="[0-9]{10}" required><br>
                    <input type="password" name="pass" placeholder="Enter Password"><br>
                    <button class="pbay" name="s" role="button">Sign In</button>
                </form>
            </div>
            <div class="page-right">
                <img src="https://drinkmilk.co.uk/wp-content/uploads/2020/05/milk_2pint.png">
            </div>


            <!-- Login in page -->


            <form method="post" action="varifivation.php">
                <div class="login">
                    <input type="text" name="name" placeholder="Enter Full Name" maxlength="30"><br>
                    <input type="tel" id="phone" name="mobile" placeholder="Enter Phone no" maxlength="10"
                        pattern="[0-9]{10}" required><br>
                    <input type="email" name="emil" placeholder="Enter Email ID" maxlength="30"><br>
                    <input type="text" name="address" placeholder="Enter Address" maxlength="60"><br>

                    <input type="password" name="password" placeholder="Enter Password"><br>
                    <input type="password" name="conform-password" placeholder="Conform Password"><br>
                    <input type="submit" class="pbay" id="inset-table" name="inset-table">
                    <!-- <button name="inset-table">Submit</button> -->
                </div>
            </form>
        </div>

</html>
<script>
    window.addEventListener("load", () => {
        const loader = document.querySelector(".loader");

        loader.classList.add("loader-hidden");
    })
    $(document).ready(function () {
        $('.login').hide();
        $('.next').hide();
        $('.gosign').click(function () {
            $('.sign').hide();
            $('.login').show();
            $('.next').hide();
        });
        $('.log').click(function () {
            $('.sign').show();
            $('.login').hide();
            $('.next').hide();
        });
        $('#home').click(function () {
            window.location.href = "home.php";
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
    .html {
        font-family: "Red Hat Display", sans-serif;
        font-optical-sizing: auto;
        font-style: normal;
    }

    .pbay {
        width: 100%;
        border-radius: 4px;
        box-shadow: 1px 1px 5px black;
        padding: 0px;
        background-color: #17759C;
        color: white;
        border: 0px;
        margin-top: 10px;
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

    /* ************ */
    html {
        background-color: rgb(230, 209, 223);
        overflow: hidden;
        font-family: "Red Hat Display", sans-serif;
        font-optical-sizing: auto;
        font-style: normal;
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
    }

    .nav-logo img {
        height: 10vh;
        mix-blend-mode: multiply;
    }

    .nav-but a {
        padding: 10px 20px;
        color: black;
        cursor: pointer;
    }

    .navside {
        display: none;
    }

    .small-screen {
        display: none;
    }

    /* opt */

    /* main page contaner */
    .contener {
        width: 100%;
        height: 100%;
        display: flex;
        flex-direction: column;
        align-items: center;
        /* background-color: rebeccapurple; */
    }

    .page {
        background-color: #EE6B6E;
        display: flex;
        align-items: center;
        padding: 40px;
        border-radius: 50px;
        margin-top: 130px;
    }

    .page-left {
        padding: 0px 100px 0px 0px;
    }

    input {
        padding: 10px 30px 8px 5px;
        background-color: #EE6B6E;
        border-top: 0px;
        border-left: 0px;
        border-right: 0px;
        border-bottom: 1px solid;
        border-color: white;
        margin: 10px;
    }

    input::placeholder {
        color: white;
    }

    input[type=text]:focus {
        border: 0px solid #555;
        background-color: #EE6B6E;
    }

    .page-left button {
        padding: 10px 100px;
    }

    .page-right img {
        height: 400px;
    }

    @media screen and (max-width: 800px) {
        button.pbay {
            font-size: 1rem;
            padding: 10px 50px;
            margin-left: 10px;
        }

        .contener {
            overflow: hidden;
        }

        .page {
            border-radius: 0px;
            display: flex;
            justify-content: center;
        }

        .page-left {
            padding: 0px 0px 0px 70px;
        }

        .page-right img {
            height: 200px;
        }

        .navside {
            background-color: rgba(255, 255, 255, 0.378);
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
            text-decoration: none;
            background-color: rgba(255, 255, 255, 0.772);
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
        }
    }
</style>