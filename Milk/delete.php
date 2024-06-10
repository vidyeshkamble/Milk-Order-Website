<?php
    require_once('db.php');
        $delete=mysqli_query($con,"DELETE FROM `order` WHERE `itemno`='$_GET[id]'");
        header('location:purchase.php');
?>