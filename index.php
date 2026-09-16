<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login System</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <style>
        .wrapper {
            width: 400px;
            margin: 100px auto;
        }

        .login-box {
            padding: 30px;
        }

        .login-title {
            text-align: center;
            margin-bottom: 30px;
        }
    </style>
</head>

<body>

    <div class="wrapper">
        <div class="card login-box">

            <h2 class="login-title">Login</h2>

            <form action="login.php" method="post">

                <div class="form-group">
                    <label>Username</label>
                    <input type="text" name="username" class="form-control" required>
                </div>

                <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="password" class="form-control" required>
                </div>

                <button type="submit" class="btn btn-primary btn-block">
                    <i class="fa fa-sign-in"></i> Login
                </button>

            </form>

        </div>
    </div>

</body>
</html>