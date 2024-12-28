<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="css/login-style.css">
    <link rel="icon" type="image/x-icon" href="img/justice.png">
    
</head>
<body>
<section>
    <div class="container main">
     
        <div class="card log-div mx-auto shadow-lg card-bg">
            <div class="card-header bg-purp">
                <h1 class="text-center col-wh">Login</h1>
            </div>
            <div class="card-body bg-l-purp">
                <form method="post" action="login-check.php">
                    <div class="form-floating mt-3">
                        <input type="text" name="uname" class="form-control card-bg" placeholder="Enter Username">
                        <label for="uname">Username</label>
                    </div>
                    <div class="form-floating mt-4">
                        <input type="password" name="pwd" class="form-control card-bg" placeholder="Enter Password">
                        <label for="pwd">Password</label>
                    </div>
                    <div>
                        <a href="#" class="float-end mt-2 text-decoration-none">Forgot Password?</a>
                    </div>
                    <input type="submit" value="Login" class="btn bg-purp col-wh radius mx-auto mt-5 d-block btn-log">
                </form>
            </div>
            <div class="card-footer text-center bg-purp col-wh">
                Don't have an account? <a href="register-user.php" class="text-decoration-none col-wh">Register</a>
            </div>
        </div>
    </div>
</section>
</body>
</html>