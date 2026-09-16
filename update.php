<?php

require_once "config.php";

$username = "";
$password = "";
$username_err = "";
$password_err = "";

if(isset($_POST["id"]) && !empty($_POST["id"])){

    $id = $_POST["id"];

    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter a username.";
    } else {
        $username = trim($_POST["username"]);
    }

    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter a password.";
    } else {
        $password = trim($_POST["password"]);
    }

    if(empty($username_err) && empty($password_err)){

        $sql = "UPDATE users SET username = ?, password = ? WHERE id = ?";

        if($stmt = mysqli_prepare($link, $sql)){

            mysqli_stmt_bind_param($stmt, "ssi", $param_username, $param_password, $param_id);

            $param_username = $username;
            $param_password = password_hash($password, PASSWORD_DEFAULT);
            $param_id = $id;

            if(mysqli_stmt_execute($stmt)){

                header("Location: dashboard.php");
                exit();

            } else {

                echo "Oops! Something went wrong. Please try again later.";

            }

            mysqli_stmt_close($stmt);
        }
    }

    mysqli_close($link);

} else {

    if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){

        $id = trim($_GET["id"]);

        $sql = "SELECT id, username FROM users WHERE id = ?";

        if($stmt = mysqli_prepare($link, $sql)){

            mysqli_stmt_bind_param($stmt, "i", $param_id);

            $param_id = $id;

            if(mysqli_stmt_execute($stmt)){

                $result = mysqli_stmt_get_result($stmt);

                if(mysqli_num_rows($result) == 1){

                    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

                    $username = $row["username"];

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

        mysqli_close($link);

    } else {

        echo "Invalid user ID.";
        exit();

    }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Update User</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <style>
        .wrapper {
            width: 500px;
            margin: 50px auto;
        }
    </style>
</head>

<body>

<div class="wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">

                <h2 class="mt-5">Update User</h2>

                <p>Please edit the user's information.</p>

                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">

                    <div class="form-group">
                        <label>Username</label>

                        <input
                            type="text"
                            name="username"
                            class="form-control <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>"
                            value="<?php echo htmlspecialchars($username); ?>"
                        >

                        <span class="invalid-feedback">
                            <?php echo $username_err; ?>
                        </span>
                    </div>

                    <div class="form-group">
                        <label>Password</label>

                        <input
                            type="password"
                            name="password"
                            class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>"
                        >

                        <span class="invalid-feedback">
                            <?php echo $password_err; ?>
                        </span>
                    </div>

                    <input type="hidden" name="id" value="<?php echo $id; ?>">

                    <input type="submit" class="btn btn-primary" value="Update User">

                    <a href="dashboard.php" class="btn btn-secondary">
                        Cancel
                    </a>

                </form>

            </div>
        </div>
    </div>
</div>

</body>
</html>