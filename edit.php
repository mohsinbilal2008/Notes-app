<?php if (isset($_GET['id'])) {
    include './configuration.php';
    $id = $_GET['id'];
    $sql = "SELECT * FROM `notes` WHERE id=$id";
    $result = mysqli_query($connection, $sql);
    $fetch = mysqli_fetch_assoc($result);
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    </head>

    <body>
        <?php
        if (isset($_POST['editsubmit'])) {
            $title = $_POST['titleedit'];
            $description = $_POST['descriptionedit'];
            $sql78 = "UPDATE `notes` SET `title`= '$title' WHERE `id`=" . $_GET['id'];
            mysqli_query($connection, $sql78);
            $sql785 = "UPDATE `notes` SET `description`= '$description' WHERE `id`=" . $_GET['id'];
            mysqli_query($connection, $sql785);
            header('Location:./index');
        }
        ?>
        <div class="container">
            <h1 class="my-3">Edit Note</h1>
            <form class="my-2" method="post">
                <div class="form-group">
                    <label for="titleedit">Title</label>
                    <input type="text" name="titleedit" class="form-control" id="titleedit" autocomplete="off" value="<?php echo $fetch['title']; ?>">
                </div>
                <div class="form-group">
                    <label for="descriptionedit">Description</label>
                    <textarea class="form-control" name="descriptionedit" id="descriptionedit" rows="3" autocomplete="off"><?php echo $fetch['description']; ?></textarea>
                </div>
                <div class="form-group">
                    <button type="submit" name="editsubmit" class="btn btn-primary">Edit Note</button>
                </div>
            </form>
            <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
            <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
            <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
            <script src="//cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
            <script src="//cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
    </body>

    </html>
<?php } ?>