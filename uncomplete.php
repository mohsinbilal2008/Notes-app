<?php
include './configuration.php';
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM `complete` WHERE `id`='$id'";
    $result = mysqli_query($connection, $sql);
    $fetch = mysqli_fetch_assoc($result);
    $title = $fetch['title'];
    $desc = $fetch['description'];
    $sql2 = "INSERT INTO `notes` (`title`,`description`) VALUES ('$title','$desc')";
    mysqli_query($connection, $sql2);
    $sql3 = "DELETE FROM complete WHERE id='$id'";
    mysqli_query($connection, $sql3);
    header('Location:index');
} else {
    header('Location:index.php?error=no_id');
}
