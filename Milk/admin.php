<?php
require_once ('db.php');
session_start();
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
            <a id="log" href="login.php">SIGN IN </a>
        </div>
    </div>
    <!-- Main Program Page -->
    <span class="loader"></span>
    <div class="contaner">
        <?php
        $pho = mysqli_query($con, "SELECT * FROM `login`");
        ?>
        <div class="sel">
            <form action="<?php $_SERVER['PHP_SELF']; ?>" method="post" class="formselect">
                <select name="cusno" id="cus_no" class="option-but">
                    <?php
                    while ($login = mysqli_fetch_assoc($pho)) {
                        ?>
                        <option value="<?php echo $login['phoneno']; ?>"><?php echo $login['phoneno']; ?></option>
                        <?php
                    }
                    ?>
                </select>
                <input type="submit" name="search" value="Search" class="option-but">
                <input type="submit" name="all" value="View All" class="option-but">
            </form>
            <?php
            if (isset($_POST['search'])) {
                $number = $_POST['cusno'];
                $order = mysqli_query($con, "SELECT * FROM `order` where phoneno = '$number'");
                $singl = mysqli_query($con, "SELECT * FROM `order` where phoneno = '$number'");
                $singlerow = mysqli_fetch_assoc($singl);
                if (!is_null($singlerow)) {
                    ?>
                    <div class="currentorder">
                        <table>
                            <tr>
                                <td><?php echo $singlerow['name']; ?></td>
                                <td><?php echo $singlerow['address']; ?></td>
                                <td><a class="pbay" href="admindeleteitem.php?id=<?php echo $number; ?>"
                                        style="text-decoration: none;">Order Delivered</a></td>
                            </tr>
                        </table>
                    </div>
                    <?php
                }
            }
            if (isset($_POST['all'])) {
                $order = mysqli_query($con, "SELECT * FROM `order`");
            }
            ?>
            <div class="table">
                <table>
                    <tr>
                        <th>Item No</th>
                        <th>Item Name</th>
                        <th>qty</th>
                        <th>Name</th>
                        <th>Address</th>
                    </tr>
                    <?php
                    if (isset($_POST['search']) or isset($_POST['all'])) {
                        while ($ordertable = mysqli_fetch_assoc($order)) { ?>
                            <tr>
                                <td><?php echo $ordertable['itemno']; ?></td>
                                <td><?php echo $ordertable['itemname']; ?></td>
                                <td><?php echo $ordertable['qty']; ?></td>
                                <td><?php echo $ordertable['name']; ?></td>
                                <td><?php echo $ordertable['address']; ?></td>
                            </tr>
                            <?php
                        }
                    } ?>
                </table>
            </div>
        </div>
    </div>





    <div class="slid-page">
        <?php
        $img = mysqli_query($con, "SELECT * FROM `items`");
        $i = 0;
        while ($row1 = mysqli_fetch_assoc($img)) {
            $counting[$i] = $row1['itemno'];
            ?>
            <div class="page">
                <div class="top">
                    <img src="<?php echo $row1['img']; ?>">
                </div>
                <div class="botm font-black">
                    <p><?php echo $row1['itemname']; ?></p>
                    <a class="pbay" href="deleteitem.php?id=<?php echo $row1['itemno']; ?>">Remove</a>
                </div>
            </div>
            <?php
            $i++;
        }
        ?>
    </div>
    <div class="contaner">
        <div class="main-add">
            <form action="varifivation.php" method="post">
                <input type="text" name="image" placeholder="Enter the image url"><br>
                <input type="text" name="no" placeholder="Enter your item Code"><br>
                <input type="text" name="itemname" placeholder="Enter item Name"><br>
                <input type="text" name="price" placeholder="Enter price"><br>
                <input type="text" name="qty" placeholder="Enter Qty"><br>
                <button name="addtocard" class="butn">Add to Card</button><br>
            </form>
        </div>
    </div>



    <!-- end of page  -->
    <div class="end-bar">
        <div class="left-end">

        </div>
        <div class="right-end font-text">
            <p>Contect - +91 **********</p>
            <p>Emil ID - XYZ@gmail.com</p>
            <p>Show Address - Pathrdi Phata Nashik.</p>
        </div>
    </div>
</body>

</html>
<script>
    window.addEventListener("load", () => {
        const loader = document.querySelector(".loader");

        loader.classList.add("loader-hidden");
    })
    $(document).ready(function () {
        $('.pbay').click(function () {
            window.location.href = "order.php";
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
        transition: opacity 1.75s, visibility 0.75s;
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
        border-top-color: #17759C;
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
    }

    .nav-but a {
        padding: 10px 20px;
        color: white;
        cursor: pointer;
        font-size: 1.2rem;
        font-family: "Montserrat", sans-serif;
        text-decoration: none;
    }

    /* scrolling Page */
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

    /* Add to card */
    .contaner {
        width: 100%;
        display: flex;
        justify-content: center;
    }

    .main-add {
        background-color: rgb(229, 229, 229);
        display: flex;
        justify-content: center;
        padding: 10px;
        border-radius: 5px;
    }

    .main-add input {
        padding: 10px 30px;
        background-color: #fff;
        border: 0px;
        border-radius: 5px;
        margin: 5px;
    }

    .butn {
        background-color: lightblue;
        padding: 10px 30px;
        border: 0px;
        border-radius: 5px;
        margin: 5px;
        width: 223px;
    }

    /* table */
    .currentorder table {
        background-color: #fff;
        width: 100%;
        padding: 10px;
        margin: 10px 0px;
        border-radius: 5px;
    }

    .table table {
        background-color: white;
        padding: 50px 100px;
        border-radius: 15px;
    }

    .table table tr th {
        background-color: #17759C;
        color: white;
    }

    .table table tr td {
        padding: 10px 30px;
        border-top: 1px black solid;
    }

    .formselect {
        width: 100%;
        display: flex;
        justify-content: center;
        background-color: #fff;
        padding: 20px 0px;
        margin: 10px 0px;
        border-radius: 5px;
    }

    .option-but {
        padding: 10px 30px;
        margin: 0px 10px;
        box-shadow: 0.5px 4px 8px black;
        border: 0px solid;
        background-color: aliceblue;
        border-radius: 3px;
    }

    .option-but:hover {
        color: #17759C;
    }

    .option-but:active {
        box-shadow: 0px 1px 3px black;
    }

    /* end page */
    .end-bar {
        position: sticky;
        bottom: 0;
        display: flex;
        justify-content: space-between;
        flex-direction: row;
        width: 100%;
        height: 80px;
        background-color: black;
        align-items: center;
    }

    .right-end p {
        font-size: 0.8rem;
        margin-right: 30px;
    }

    /* text*/
    .font-text {
        color: white;
        font-family: "Montserrat", sans-serif;
    }

    /* button */
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
        .sel {
            width: 100%;
        }

        .currentorder table {
            color: white;
        }

        .table table {
            padding: 0px;
            width: 100%;
            overflow: hidden;
            border-radius: 0px;
        }

        .table table tr td {
            padding: 0px;
        }

        .currentorder table {
            color: black;
            border-radius: 0px;
        }
    }
</style>