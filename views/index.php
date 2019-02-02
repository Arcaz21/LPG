<?php include "../controllers/signInFunction.php";
if(isset($_SESSION['role']) && ($_SESSION['role'] == "registrar")){
    header('Location: registrar1.php');
}if(isset($_SESSION['role']) && ($_SESSION['role'] == "admin")){
    header('Location: admin1.php');
}else{
session_start();
session_destroy(); 
}
 ?>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login</title>
    <!-- BOOTSTRAP STYLES-->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
     <!-- FONTAWESOME STYLES-->
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
        <!-- CUSTOM STYLES-->
    <link href="assets/css/custom.css" rel="stylesheet" />
        <!-- favicon-->
<!--     <link rel="icon" href="assets/img/favicon.png -->

</head>
<center>
<body style="background:#F3F3F3">
<!--     <center>
        <br>
    <img style="height:100; position:absolute; z-index:-1; margin-top: -300; top:50%; left:50%; transform:translate(-50%, -50%);" src="assets/img/POD.png"/></center> -->
    <?php if(isset($ERROR)): ?>
    <div style="max-width: 50%;" class="alert alert-danger">
        <h3>Invalid Username/Password. Please Try Again</h3>

    </div>
    <?php endif; //unset($_SESSION['loginError']); ?>
    <div class="panel panel-primary" style="width: 500; margin-top: 55; position: absolute;top: 50%;left: 50%;transform: translate(-50%, -50%);">
    <!-- To check if naka log in -->
        <?php 
                        if ($LOGGED_IN){
                            $db = new userModel();
                            $data = $db->getUse($username);

                        
                            if ($data->role == "admin"):
                                session_start();
                                $_SESSION['username'] =  $data->username;
                                $_SESSION['password'] =  $data->password;
                                $_SESSION['role'] =  $data->role;
                                header("location:dashboard.php");
                            endif; 

                            // if ($data->role == "root"):       
                            //     session_start();
                            //     $_SESSION['username'] =  $data->username;
                            //     $_SESSION['password'] =  $data->password;
                            //     $_SESSION['role'] =  $data->role;
                            //      header("location:admin2.php");           
                            // endif;
                        }
                     ?>


        <?php if (!$LOGGED_IN): ?>
            <div class="panel-heading"  >
                 
                <h2>Please Log In to Use</h2>
            </div>

            <form action="<?php $_PHP_SELF ?>" method="POST">
                    <div class="input-group">
                        <div class="six columns">
                            <h3>Username</h3>
                            <input class="form-control"  id="username" name="username" type="text" required>
                        </div>
                    </div>

                    <div class="input-group">
                        <div class="six columns">
                            <h3>Password</h3>
                            <input class="form-control" id="password" name="password" type="password" required>
                        </div>
                    </div>
                    <br>
                    <div class="panel-footer" style="margin-bottom: -13px">
                    <input class="btn btn-success" value="LOG ME IN" type="submit" name="submit">
                    </div>
                </form>
            </div><br>
        <?php endif; ?>
    </div>
    <!-- <img src="assets/img/build_1.png" style="margin-top:33.5%; margin-left:-59%; height:30%; width:auto;"> -->
</body>