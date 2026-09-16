<?php

require_once "config.php";

if(isset($_POST["id"]) && !empty($_POST["id"])){

    $id = $_POST["id"];

    $sql = "DELETE FROM users WHERE id = ?";

    if($stmt = mysqli_prepare($link, $sql)){

        mysqli_stmt_bind_param($stmt, "i", $param_id);

        $param_id = $id;

        if(mysqli_stmt_execute($stmt)){

            header("Location: dashboard.php");
            exit();

        } else {

            echo "Oops! Something went wrong. Please try again later.";

        }

        mysqli_stmt_close($stmt);
    }

    mysqli_close($link);

} else {

    if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){

        $id = trim($_GET["id"]);

    } else {

        header("Location: dashboard.php");
        exit();

    }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Delete User</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <style>
        .wrapper {
            width: 500px;
            margin: 100px auto;
        }
    </style>
</head>

<body>

<div class="wrapper">

    <div class="container-fluid">

        <div class="row">

            <div class="col-md-12">

                <div class="alert alert-danger">

                    <h4>Delete User</h4>

                    <p>
                        Are you sure you want to delete this user?
                    </p>

                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">

                        <input type="hidden" name="id" value="<?php echo $id; ?>">

                        <input type="submit" class="btn btn-danger" value="Yes, Delete">

                        <a href="dashboard.php" class="btn btn-secondary">
                            Cancel
                        </a>

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>

</body>
</html>