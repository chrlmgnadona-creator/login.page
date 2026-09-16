<?php

require_once "config.php";

if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){

    $sql = "SELECT id, username FROM users WHERE id = ?";

    if($stmt = mysqli_prepare($link, $sql)){

        mysqli_stmt_bind_param($stmt, "i", $param_id);

        $param_id = trim($_GET["id"]);

        if(mysqli_stmt_execute($stmt)){

            $result = mysqli_stmt_get_result($stmt);

            if(mysqli_num_rows($result) == 1){

                $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

            } else {

                echo "No user found.";
                exit();

            }

        } else {

            echo "Oops! Something went wrong.";
            exit();

        }

        mysqli_stmt_close($stmt);

    }

} else {

    echo "Invalid user ID.";
    exit();

}

mysqli_close($link);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View User</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <style>
        .wrapper {
            width: 500px;
            margin: 50px auto;
        }

        .user-info {
            margin-top: 20px;
        }
    </style>
</head>

<body>

<div class="wrapper">

    <div class="container-fluid">

        <div class="row">

            <div class="col-md-12">

                <h2 class="mt-5 mb-3">View User</h2>

                <div class="card user-info">

                    <div class="card-body">

                        <div class="form-group">
                            <label><strong>ID</strong></label>

                            <p class="form-control">
                                <?php echo $row["id"]; ?>
                            </p>
                        </div>

                        <div class="form-group">
                            <label><strong>Username</strong></label>

                            <p class="form-control">
                                <?php echo htmlspecialchars($row["username"]); ?>
                            </p>
                        </div>

                        <a href="dashboard.php" class="btn btn-primary">
                            <i class="fa fa-arrow-left"></i> Back
                        </a>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

</body>
</html>