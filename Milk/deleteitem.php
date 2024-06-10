<?php
    require_once('db.php');
        $delete=mysqli_query($con,"DELETE FROM `items` WHERE `itemno`='$_GET[id]'");
        header('location:admin.php');
?>