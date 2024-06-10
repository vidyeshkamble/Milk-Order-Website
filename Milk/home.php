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
    <link rel="stylesheet" href="home.css">
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
        </div>
        <div class="small-screen">
            <i class="fa-solid fa-bars open"></i>
        </div>
        <div class="navside">
            <i class="fa-solid fa-xmark close" id="close"></i>
            <a href="home.php">HOME</a>
            <a class="gosign" href="login.php">SIGN IN</a>
        </div>
    </div>

    <!-- Main Program Page -->
    <span class="loader"></span>
    <?php
    if (isset($_SESSION['id'])) {
        ?>
        <div class="contaner font-text">
            <p> Welcome <span style="color:brown; font-size:1.3rem;"><?php echo $row[0]; ?></span> on Milk Order...!</p>
        </div>
        <?php
    }
    ?>

    <div class="contaner">
        <div class="first-con">
            <div class="fc-left font-text">
                <h2>Amul Taaza</h2>
                <p>Amul milk meets the FSSAI standards<br> for the respective type of milk.</p>
                <br>
                <h4>Packing</h4>
                <p>Pol Pack- 500ml,1L,2L,6L,170ml</p><br><br>
                <a href="order.php?id=<?php echo 'H-001'; ?>" class="pbay" style="padding:10px 30px;">Buy</a>
            </div>
            <div class="fc-right">
                <img src="https://amul.com/files/products/amul-tazza.png">
            </div>
        </div>
    </div>
    <div class="contaner">
        <div class="Secound-con">
            <div class="sc-left font-text">
                <h2>Amul Ice Cream</h2>
                <p>Tricone, Butterscotch 120 ml</p><br>
                <p>Creamy Butterscotch icecream inside<br> Crispy wafer biscuit cone India s most loved<br> ice cream
                    cone.
                </p><br><br>
                <a href="order.php?id=<?php echo "M-002C"; ?>" class="pbay"
                    style="padding:10px 20px; text-align:center"><i class="fa-solid fa-cart-shopping"></i> Buy</a>
            </div>
            <div class="sc-right">
                <img src="https://logos-world.net/wp-content/uploads/2023/04/Amul.png">
            </div>
        </div>
    </div>
    <div class="contaner">
        <div class="search">
            <img src="https://t4.ftcdn.net/jpg/03/62/85/23/360_F_362852339_fIaziqbgttYpEeES3isi0o8pZP0qOTnt.jpg">
            <div class="sear">
                <i class="fas fa-search alin"></i>
                <input type="search" placeholder="Purchase Amul item">
            </div>
        </div>
    </div>
    <div class="holder">
        <video src="./Video/Untitled video - Made with Clipchamp.mp4" autoplay muted loop>
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
                    <a href="order.php?id=<?php echo $counting[$i]; ?>" class="pbay"> Buy</a>
                </div>
            </div>
            <?php
            $i++;
        }

        ?>
    </div>
    <!-- <div class="contaner"> -->
    <div class="pic">
        <img src="https://mir-s3-cdn-cf.behance.net/project_modules/fs/8b2483111495833.6002f625dc8c3.jpg">
        <button class="pbay chocolate">Buy</button>
    </div>
    <!-- </div> -->
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