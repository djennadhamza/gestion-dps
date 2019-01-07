<?php 
include('config.php'); 
session_start();
if(isset($_SESSION['nom_user'])){
	header("location:dps_table.php");
}
?>
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<!------ Include the above in your HEAD tag ---------->
<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Standard Meta -->
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">

    <!-- Site Properties -->
    <title>Authuntification</title>

    <!-- Stylesheets -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css">
</head>
<body>
        <div class="container">
		<br><br><br><br><br><br><br><br><br><br><br><br>
		<?php
			if(isset($_POST['submit'])){        
				$nom_user = mysqli_real_escape_string($connect,$_POST['nom_user']);
				$pass_user = mysqli_real_escape_string($connect,$_POST['pass_user']);
				$pass_user = md5($pass_user);
				$query = "SELECT * FROM users WHERE nom_user = '$nom_user' AND pass_user = '$pass_user'";
				$rs = mysqli_query($connect,$query);
				if(mysqli_num_rows($rs) > 0){
					$_SESSION['nom_user'] = $nom_user;
					$row = mysqli_fetch_assoc($rs);
					$_SESSION['role_user'] = $row['role_user'];
					$_SESSION['id_user'] = $row['id_user'];
					header("location:dps_table.php");
				}
				else{
					echo "<div class='alert alert-danger'><strong>Oops!</strong> y a un erreur. verfier votre nom  utilsateur et mot de pass </div>";
				}
			}

    ?>
        <form class="form-horizontal" role="form" method="POST" action="login.php" autocomplete="off">
            <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-6">
                    <h2>SVP Connectez Vous</h2>
                    <hr>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-6">
                    <div class="form-group has-danger">
                        <label class="sr-only" for="email">Nom Utilisateur</label>
                        <div class="input-group mb-2 mr-sm-2 mb-sm-0">
                            <div class="input-group-addon" style="width: 2.6rem"><i class="fa fa-at"></i></div>
                            <input type="text" name="nom_user" class="form-control" id="nom_user"
                                   placeholder="nom.prenom" required autocomplete="off">
                        </div>
                    </div>
                </div>
                <!--<div class="col-md-3">
                    <div class="form-control-feedback">
                        <span class="text-danger align-middle">
                            <i class="fa fa-close"></i> Example error message
                        </span>
                    </div>
                </div>-->
            </div>
            <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="sr-only" for="password">Mot de Pass</label>
                        <div class="input-group mb-2 mr-sm-2 mb-sm-0">
                            <div class="input-group-addon" style="width: 2.6rem"><i class="fa fa-key"></i></div>
                            <input type="password" name="pass_user" class="form-control" id="pass_user"
                                   placeholder="Mot de Pass" required autocomplete="off">
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-control-feedback">
                        <span class="text-danger align-middle">
                        <!-- Put password error message here -->    
                        </span>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-6" style="padding-top: .35rem">
                    <div class="form-check mb-2 mr-sm-2 mb-sm-0">
                        <label class="form-check-label">
                            <input class="form-check-input" name="remember"
                                   type="checkbox" >
                            <span style="padding-bottom: .15rem">Rester Connecter</span>
                        </label>
                    </div>
                </div>
            </div>
            <div class="row" style="padding-top: 1rem">
                <div class="col-md-3"></div>
                <div class="col-md-6">
                    <button type="submit" class="btn btn-success" name="submit"><i class="fa fa-sign-in"></i> Se Connecter</button>
                    <a class="btn btn-link" href="/password/reset">Oubliez Vous Mot de Pass?</a>
                </div>
            </div>
        </form>
    </div>
</body>
</html>