<?php
include './configuration.php';
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM `notes` WHERE `id`='$id'";
    $result = mysqli_query($connection, $sql);
    $fetch = mysqli_fetch_assoc($result);
    $title = $fetch['title'];
    $desc = $fetch['description'];
    $sql2 = "INSERT INTO `complete` (`title`,`description`) VALUES ('$title','$desc')";
    mysqli_query($connection, $sql2);
    $sql3 = "DELETE FROM notes WHERE id='$id'";
    mysqli_query($connection, $sql3);
    header('Location:index');
}
