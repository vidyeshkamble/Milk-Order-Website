<?php
    require_once('db.php');
        mysqli_query($con,"DELETE FROM `order` WHERE `phoneno`='$_GET[id]'");
        header('location:admin.php');
?>