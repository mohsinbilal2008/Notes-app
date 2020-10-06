<?php
$connection = mysqli_connect('localhost', 'Itachi', 'Uchiha', 'inotes');
$title = mysqli_real_escape_string($connection, $_POST['title']);
$desc = mysqli_real_escape_string($connection, $_POST['description']);
$sql = "INSERT INTO notes(title,description) VALUES ('$title','$desc')";
mysqli_query($connection, $sql);
header('Location: index');
