<?php
$connection = mysqli_connect('localhost', 'Itachi', 'Uchiha', 'inotes');
if (isset($_POST['submit'])) {
    $id = $_POST['id_to_delete'];
    $sql = "DELETE FROM notes WHERE id='$id'";
    mysqli_query($connection, $sql);
}
header('Location: index');
