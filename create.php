<?php

require_once "config.php";

$username = "";
$password = "";
$username_err = "";
$password_err = "";

if($_SERVER["REQUEST_METHOD"] == "POST"){

    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter a username.";
    } else {
        $sql = "SELECT id FROM users WHERE username = ?";

        if($stmt = mysqli_prepare($link, $sql)){
            mysqli_stmt_bind_param($stmt, "s", $param_username);

            $param_username = trim($_POST["username"]);

            if(mysqli_stmt_execute($stmt)){
                mysqli_stmt_store_result($stmt);

                if(mysqli_stmt_num_rows($stmt) == 1){
                    $username_err = "This username is already taken.";
                } else {
                    $username = trim($_POST["username"]);
                }
            }

            mysqli_stmt_close($stmt);
        }
    }

    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter a password.";
    } else {
        $password = trim($_POST["password"]);
    }

    if(empty($username_err) && empty($password_err)){

        $sql = "INSERT INTO users (username, password) VALUES (?, ?)";

        if($stmt = mysqli_prepare($link, $sql)){
            mysqli_stmt_bind_param($stmt, "ss", $param_username, $param_password);

            $param_username = $username;
            $param_password = password_hash($password, PASSWORD_DEFAULT);

            if(mysqli_stmt_execute($stmt)){
                header("Location: dashboard.php");
                exit();
            }

            mysqli_stmt_close($stmt);
        }
    }

    mysqli_close($link);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add User</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

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

                <h2 class="mt-5">Add New User</h2>

                <p>Please fill in the fields to create a new user.</p>

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

                    <input type="submit" class="btn btn-primary" value="Create User">

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
