<?php 
include('config.php'); 
?>
<!------ Include the above in your HEAD tag ---------->
<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Standard Meta -->
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
<?php include('navbar.php');?>
    <!-- Site Properties -->
    <title>Enregistrer nouveaux utilisateur</title>

    <!-- Stylesheets -->

</head>
<body>
        <div class="container">
		<br><br><br><br><br><br><br><br><br><br><br><br>
		<?php
			if(isset($_POST['submit'])){        
				$query = "INSERT INTO users (nom_user, role_user, pass_user) 
				VALUES (?,?,?)";
				$stmt = mysqli_prepare($connect, $query);
				$pass_user = md5($_POST['pass_user']);
				$stmt->bind_param("sss", $_POST['nom_user'], $_POST['role_user'], $pass_user);
				//$stmt->execute();
				if ($stmt->execute()) { 
					echo "<div class='alert alert-success'><strong>OK!</strong> L'utilisateur est  ajouter avec succès. Pour authuntifier vous pouvez consulter la page d'<a href='login.php'>Se Connecter</a>.</div>";
					} else {
						echo "<div class='alert alert-danger'><strong>Oops!</strong> y a un erreur. Vous pouvez contacter l'adminstrateur de site.</div>";
				}
			}
			if($_SESSION['role_user']=='admin'){
    ?>
        <form class="form-horizontal" role="form" method="POST" action="register.php">
            <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-6">
                    <h2>Enregistrer un nouveaux utilisateur</h2>
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
                                   placeholder="nom.prenom" required>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="sr-only" for="password">Mot de Pass</label>
                        <div class="input-group mb-2 mr-sm-2 mb-sm-0">
                            <div class="input-group-addon" style="width: 2.6rem"><i class="fa fa-key"></i></div>
                            <input type="password" name="pass_user" class="form-control" id="pass_user"
                                   placeholder="Mot de Pass" required>
                        </div>
                    </div>
                </div>
            </div>
			<div class="row">
				<div class="col-md-3"></div>
				<div class="col-md-6">
				<div class="form-group has-danger">
                        <label class="sr-only" for="email">Nom Utilisateur</label>
                        <div class="input-group mb-2 mr-sm-2 mb-sm-0">
                            <div class="input-group-addon" style="width: 2.6rem"><i class="fa fa-user"></i></div>
                            <select id="dropdown1" width="495" name="role_user" >
								<option value="0">SVP Choisissez...</option>
								<?php
									$roles_user = get_enum_values($connect,'users','role_user');
									foreach($roles_user as $role_user){
										echo"<option value='".$role_user."'>".$role_user."</option>";
									}
								?>
							</select>
							<script>$('#dropdown1').dropdown();</script>
                        </div>
                    </div>
				</div>
			</div>
            <div class="row" style="padding-top: 1rem">
                <div class="col-md-3"></div>
                <div class="col-md-6">
                    <button type="submit" class="btn btn-success" name="submit"><i class="fa fa-plus-circle"></i> Enregister</button>
                </div>
            </div>
        </form>
		<?php }else{
			echo "<div class='alert alert-danger'><strong>Oops!</strong> vous n'etes pas les droit d'access a cette page.</div>";
		}?>
    </div>
</body>
</html>