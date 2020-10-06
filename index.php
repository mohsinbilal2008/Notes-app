<?php

include 'configuration.php';



?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="style.css">

    <title>Todo App</title>
</head>

<body style="padding: 0 2vw;">


    <div class="container">
        <h1 class="my-3">iNotes</h1>
        <form class="my-2" action="add.php" method="post">
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" name="title" class="form-control" id="title" autocomplete="off">
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea class="form-control" name="description" id="description" rows="3" autocomplete="off"></textarea>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Add Note</button>
            </div>
        </form>
        <form method="post" style="display:flex; margin-bottom:10px">
            <select class="custom-select" name="select">
                <option value="all">All</option>
                <option value="completed">Completed</option>
                <option value="uncompleted">Uncompleted</option>
            </select>
            <input type="submit" class="btn btn-primary" name="selsub" style="margin-left:10px;" value="Get">
        </form>
        <table class="table" id="myTable">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">title</th>
                    <th scope="col">Description</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (!isset($_POST['selsub'])) {
                    $sql2 = "SELECT * FROM notes";
                    $result = mysqli_query($connection, $sql2);
                    $i = 0;
                    while ($fetch = mysqli_fetch_assoc($result)) {
                        $i++;
                        echo "<tr>
                <th scope='row'>$i</th>
                <td>" . $fetch['title'] . "</td>
                <td>" . $fetch['description'] . "</td>
                <td style='display:flex'>
                <form method='post' action='complete.php?id=" . $fetch['id'] . "'>
                    <button type='submit' style='margin-right:5px' class='btn btn-success' name='submit'>Complete</button>
                </form>
                <a href='./edit.php?id=" . $fetch['id'] . "' class='btn btn-primary'>Edit</a>
                <form method='post' action='delete.php'>
                    <input type='hidden' value=" . $fetch['id'] . " name='id_to_delete'>
                    <button type='submit' style='margin-left:5px' class='btn btn-danger' name='submit'>Delete</button>
                </form>
                </td>
                
              </tr>";
                    }

                ?>
                <?php
                    $sql3 = "SELECT * FROM complete";
                    $result2 = mysqli_query($connection, $sql3);
                    $i = 0;
                    while ($fetch2 = mysqli_fetch_assoc($result2)) {
                        $i++;
                        echo "<tr>
                <th scope='row'>$i</th>
                <td>" . $fetch2['title'] . "</td>
                <td>" . $fetch2['description'] . "</td>
                <td style='display:flex'>
                <p style='margin-right:5px;color:green;' class='mh-100 align-middle'>Completed</p>
                <form method='post' action='uncomplete.php?id=" . $fetch2['id'] . "'>
                    <button type='submit' style='margin-right:5px' class='btn btn-danger' name='submit'>Uncomplete</button>
                </form>
                <form method='post' action='comdelete.php'>
                    <input type='hidden' value=" . $fetch2['id'] . " name='id_to_delete'>
                    <button type='submit' style='margin-left:5px' class='btn btn-primary' name='submit2'>Delete</button>
                </form>
                </td>
                
              </tr>";
                    }
                }
                ?>
                <?php
                if (isset($_POST['selsub'])) {
                    switch ($_POST['select']) {
                        case 'all':
                            $sql2 = "SELECT * FROM notes";
                            $result = mysqli_query($connection, $sql2);
                            $i = 0;
                            while ($fetch = mysqli_fetch_assoc($result)) {
                                $i++;
                                echo "<tr>
                <th scope='row'>$i</th>
                <td>" . $fetch['title'] . "</td>
                <td>" . $fetch['description'] . "</td>
                <td style='display:flex'>
                <form method='post' action='complete.php?id=" . $fetch['id'] . "'>
                    <button type='submit' style='margin-right:5px' class='btn btn-success' name='submit'>Complete</button>
                </form>
                <a href='./edit.php?id=" . $fetch['id'] . "' class='btn btn-primary'>Edit</a>
                <form method='post' action='delete.php'>
                    <input type='hidden' value=" . $fetch['id'] . " name='id_to_delete'>
                    <button type='submit' style='margin-left:5px' class='btn btn-danger' name='submit'>Delete</button>
                </form>
                </td>
                
              </tr>";
                            };
                            $sql3 = "SELECT * FROM complete";
                            $result2 = mysqli_query($connection, $sql3);
                            $i = 0;
                            while ($fetch2 = mysqli_fetch_assoc($result2)) {
                                $i++;
                                echo "<tr>
                <th scope='row'>$i</th>
                <td>" . $fetch2['title'] . "</td>
                <td>" . $fetch2['description'] . "</td>
                <td style='display:flex'>
                <p style='margin-right:5px;color:green;' class='mh-100 align-middle'>Completed</p>
                <form method='post' action='uncomplete.php?id=" . $fetch2['id'] . "'>
                    <button type='submit' style='margin-right:5px' class='btn btn-danger' name='submit'>Uncomplete</button>
                </form>
                <form method='post' action='comdelete.php'>
                    <input type='hidden' value=" . $fetch2['id'] . " name='id_to_delete'>
                    <button type='submit' style='margin-left:5px' class='btn btn-primary' name='submit2'>Delete</button>
                </form>
                </td>
                
              </tr>";
                            }
                            break;
                        case 'uncompleted':
                            $sql2 = "SELECT * FROM notes";
                            $result = mysqli_query($connection, $sql2);
                            $i = 0;
                            while ($fetch = mysqli_fetch_assoc($result)) {
                                $i++;
                                echo "<tr>
                <th scope='row'>$i</th>
                <td>" . $fetch['title'] . "</td>
                <td>" . $fetch['description'] . "</td>
                <td style='display:flex'>
                <form method='post' action='complete.php?id=" . $fetch['id'] . "'>
                    <button type='submit' style='margin-right:5px' class='btn btn-success' name='submit'>Complete</button>
                </form>
                <a href='./edit.php?id=" . $fetch['id'] . "' class='btn btn-primary'>Edit</a>
                <form method='post' action='delete.php'>
                    <input type='hidden' value=" . $fetch['id'] . " name='id_to_delete'>
                    <button type='submit' style='margin-left:5px' class='btn btn-danger' name='submit'>Delete</button>
                </form>
                </td>
                
              </tr>";
                            }
                            break;
                        case 'completed':
                            $sql3 = "SELECT * FROM complete";
                            $result2 = mysqli_query($connection, $sql3);
                            $i = 0;
                            while ($fetch2 = mysqli_fetch_assoc($result2)) {
                                $i++;
                                echo "<tr>
                <th scope='row'>$i</th>
                <td>" . $fetch2['title'] . "</td>
                <td>" . $fetch2['description'] . "</td>
                <td style='display:flex'>
                <p style='margin-right:5px;color:green;' class='mh-100 align-middle'>Completed</p>
                <form method='post' action='uncomplete.php?id=" . $fetch2['id'] . "'>
                    <button type='submit' style='margin-right:5px' class='btn btn-danger' name='submit'>Uncomplete</button>
                </form>
                <form method='post' action='comdelete.php'>
                    <input type='hidden' value=" . $fetch2['id'] . " name='id_to_delete'>
                    <button type='submit' style='margin-left:5px' class='btn btn-primary' name='submit2'>Delete</button>
                </form>
                </td>
                
              </tr>";
                            }
                            break;
                    }
                }
                ?>
            </tbody>
        </table>
    </div>



    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
    <script src="//cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script src="//cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#myTable').DataTable();
        });
    </script>
</body>

</html>