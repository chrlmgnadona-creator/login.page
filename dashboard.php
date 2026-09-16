<?php

session_start();

if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("Location: index.php");
    exit();
}

require_once "config.php";

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <style>
        .wrapper {
            width: 900px;
            margin: 50px auto;
        }

        table tr td:last-child {
            width: 150px;
        }
    </style>

    <script>
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>
</head>

<body>

<div class="wrapper">

    <div class="container-fluid">

        <div class="row">

            <div class="col-md-12">

                <div class="mt-5 mb-3 clearfix">

                    <h2 class="pull-left">
                        Users Details
                    </h2>

                    <a href="create.php" class="btn btn-success pull-right">
                        <i class="fa fa-plus"></i> Add New User
                    </a>

                </div>

                <div class="alert alert-success">
                    Welcome, <strong><?php echo htmlspecialchars($_SESSION["username"]); ?></strong>!
                </div>

                <?php

                $sql = "SELECT id, username FROM users";

                if($result = mysqli_query($link, $sql)){

                    if(mysqli_num_rows($result) > 0){

                        echo '<table class="table table-bordered table-striped">';

                            echo "<thead>";

                                echo "<tr>";

                                    echo "<th>#</th>";
                                    echo "<th>Username</th>";
                                    echo "<th>Action</th>";

                                echo "</tr>";

                            echo "</thead>";

                            echo "<tbody>";

                            while($row = mysqli_fetch_array($result)){

                                echo "<tr>";

                                    echo "<td>" . $row["id"] . "</td>";

                                    echo "<td>" . htmlspecialchars($row["username"]) . "</td>";

                                    echo "<td>";

                                        echo '<a href="read.php?id=' . $row["id"] . '" class="mr-3" title="View Record" data-toggle="tooltip">';
                                        echo '<span class="fa fa-eye"></span>';
                                        echo '</a>';

                                        echo '<a href="update.php?id=' . $row["id"] . '" class="mr-3" title="Update Record" data-toggle="tooltip">';
                                        echo '<span class="fa fa-pencil"></span>';
                                        echo '</a>';

                                        echo '<a href="delete.php?id=' . $row["id"] . '" title="Delete Record" data-toggle="tooltip">';
                                        echo '<span class="fa fa-trash"></span>';
                                        echo '</a>';

                                    echo "</td>";

                                echo "</tr>";
                            }

                            echo "</tbody>";

                        echo "</table>";

                        mysqli_free_result($result);

                    } else {

                        echo '<div class="alert alert-danger"><em>No users were found.</em></div>';

                    }

                } else {

                    echo "Oops! Something went wrong. Please try again later.";

                }

                mysqli_close($link);

                ?>

                <a href="logout.php" class="btn btn-danger">
                    <i class="fa fa-sign-out"></i> Logout
                </a>

            </div>

        </div>

    </div>

</div>

</body>
</html>