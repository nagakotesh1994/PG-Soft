<?php
include 'DB_OPR/DB.php';
if (isset($_SESSION['LoginId'])) {
    echo "<script>window.location.href = 'Dashboard.php';</script>";
}

PG_Table_Users();
$conn = DB_Connect();

if (isset($_REQUEST['submit'])) {
    $status = Check_Login($_REQUEST);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php echo $pages_titles['home_page_title']; ?>
    <?php include 'HeaderIncludes.php'; ?>
</head>

<body class="hold-transition login-page">
    <div class="login-box">
        <!-- /.login-logo -->
        <div class="card card-outline card-primary">
            <div class="card-header text-center">
                <a href="#" class="h1"><b>PG</b>Soft</a>
            </div>
            <div class="card-body">
                <!-- <p class="login-box-msg">Sign in to start your session</p> -->

                <form method="post">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" name="pg_id" id="pg_id" placeholder="your PG ID" autofocus>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>

                    <div class="input-group mb-3">
                        <input type="text" class="form-control" name="LoginId" id="LoginId" placeholder="Email / Phone No" autofocus>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>

                    <div class="input-group mb-3">
                        <input type="password" class="form-control" name="password" id="password" placeholder="Password">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-8">
                            <div class="icheck-primary">
                                <input type="checkbox" id="remember">
                                <!-- <label for="remember">
                                    Remember Me
                                </label> -->
                            </div>
                        </div>
                        <!-- /.col -->
                        <div class="col-4">
                            <button type="submit" name="submit" class="btn btn-primary btn-block">Sign In</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>

                <!-- <div class="social-auth-links text-center mt-2 mb-3">
                    <a href="#" class="btn btn-block btn-primary">
                        <i class="fab fa-facebook mr-2"></i> Sign in using Facebook
                    </a>
                    <a href="#" class="btn btn-block btn-danger">
                        <i class="fab fa-google-plus mr-2"></i> Sign in using Google+
                    </a>
                </div> -->
                <!-- /.social-auth-links -->

                <!-- <p class="mb-1">
                    <a href="forgot-password.html">I forgot my password</a>
                </p> -->
                <p class="mb-0">
                    <!-- <a href="register.html" class="text-center">Register a new membership</a> -->
                </p>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    <!-- /.login-box -->

    <?php include 'FooterIncludes.php'; ?>

    <?php if (isset($_REQUEST['submit'])) {
        echo @$messages[$status];
        //echo $status;
        if ($status == 1) {
            echo "<script>window.location.href = 'Dashboard.php';</script>";
        }
    }
    ?>
</body>

</html>