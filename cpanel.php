<?php include('config.php'); ?>
<title>Parametres</title>
<?php include('navbar.php'); ?>
<br><br>
<section class="container-fluid">
    <div class="one">
		<div class="list-group">
			<a href="cpanel.php?action=profile" class="list-group-item list-group-item-action bg-light"><i class="fas fa-user"></i> Profile</a>
			<a href="cpanel.php?action=chmp" class="list-group-item list-group-item-action"><i class="fas fa-edit"></i> Changer Mot de Pass</a>
			<a href="cpanel.php?action=mesDPS" class="list-group-item list-group-item-action"><i class="fas fa-list-alt"></i> Mes DPS</a>
			<?php if(isset($_SESSION['role_user']) && $_SESSION['role_user']=='admin'){ ?>
			<a href="cpanel.php?action=parametres" class="list-group-item list-group-item-action bg-light"><i class="fas fa-cogs"></i> Parametres</a>
			<a href="cpanel.php?action=ajoutU" class="list-group-item list-group-item-action"><i class="fas fa-user-plus"></i> Ajouter Utilisateur</a>
			<a href="cpanel.php?action=CtrlU" class="list-group-item list-group-item-action"><i class="fas fa-users"></i> Controler Utilisateurs</a>
			<a href="cpanel.php?action=CtrlS" class="list-group-item list-group-item-action"><i class="fas fa-sitemap"></i> Controler le Site</a>
			<?php } ?>
			<a href="logout.php" class="list-group-item list-group-item-action bg-light"><i class="fas fa-sign-out-alt"></i> Se Deconnecter</a>
			<!--<a href="#" class="list-group-item list-group-item-action disabled">Vestibulum at eros</a>-->
		</div>
	</div>
	<!--Container-->
    <div class="two">
		<!-- Profile -->
		<?php 
			if(isset($_GET["action"]) && $_GET["action"] == "profile")	{	
		?>
		<h4>Profile</h4>
		<div class='alert alert-warning'><strong>Oo!</strong> Actuellement vous pouvez changer le <a href="cpanel.php?action=chmp">Mot de Pass</a> et afficher tes <a href ="cpanel.php?action=mesDPS">DPS</a>.</div>
		<?php } //END of Profile ?>
		
		<!-- Changer Mot de Pass -->
		<?php 
			if(isset($_GET["action"]) && $_GET["action"] == "chmp")	{	
		?>
		<h4>Profile->>Changer Mot de Pass</h4>
		<br><br>
		<?php
			if(isset($_POST['changemp'])){ 
				$query = "SELECT * FROM users where nom_user ='".$_SESSION['nom_user']."'";
				$rs = mysqli_query($connect,$query);
				if(mysqli_num_rows($rs) > 0){
					$row = mysqli_fetch_assoc($rs);
					$pass_user = $row['pass_user'];
					$pass_user_nv = mysqli_real_escape_string($connect,$_POST['pass_user']);
					if($pass_user == md5($pass_user_nv)){
						echo "<div class='alert alert-danger'><strong>Oops!</strong> le nouveau mot  de pass doit etre different de l'ancien.</div>";
					}else{
						if ($_POST['pass_user'] != $_POST['pass_user_confirm']){
							echo "<div class='alert alert-danger'><strong>Oops!</strong> le nouveau mot de pass et la confirmation doit etre les meme valeurs.</div>";
						}else{
							$pass_user_nv = $_POST['pass_user'];
							$pass_user_nv = md5($pass_user_nv);
							$updte = "UPDATE users SET pass_user = '".$pass_user_nv."' WHERE nom_user = '".$_SESSION['nom_user']."'";
							$rs2 = mysqli_query($connect,$updte);
							 if ($rs2 == true){
								echo "<div class='alert alert-success'><strong>Ok!</strong> le nouveau mot de pass est mise a jour avec success.</div>";
							}else{
								echo "<div class='alert alert-danger'><strong>Oops!</strong> Erreur au cour de mise a jour de mot de pass.</div>";
							}  
						}
					}
				}else{
					echo "<div class='alert alert-danger'><strong>Oops!</strong> Erreur y a pas cette utilisateur.</div>";
				}
			}
		?>
			<form class="form-horizontal" role="form" method="POST" action="cpanel.php?action=chmp">
				<div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="sr-only" for="password">Mot de Pass</label>
                        <div class="input-group mb-2 mr-sm-2 mb-sm-0">
                            <div class="input-group-addon" style="width: 6.2rem">Nouveau <i class="fa fa-key"></i></div>
                            <input type="password" name="pass_user" class="form-control" id="pass_user"
                                   placeholder="Mot de Pass" required>
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
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="sr-only" for="password">Confirmer Mot de Pass</label>
                        <div class="input-group mb-2 mr-sm-2 mb-sm-0">
                            <div class="input-group-addon" style="width: 6.2rem">Confirmer <i class="fa fa-key"></i></div>
                            <input type="password" name="pass_user_confirm" class="form-control" id="pass_user_confirm"
                                   placeholder="Mot de Pass" onChange="checkPasswordMatch();" required>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-control-feedback">
                        <span class="text-danger align-middle" id="divCheckPasswordMatch">
                        <!-- Put password error message here -->    
                        </span>
                    </div>
                </div>
            </div>
			<div class="row" style="padding-top: 1rem">
                <div class="col-md-3"></div>
                <div class="col-md-6">
                    <button type="submit" class="btn btn-success float-right" name="changemp"><i class="fas fa-save"></i> Sauvgarder</button>
                </div>
            </div>
			</form>
		<?php } //END of changermot de pass ?>
		
		<!-- user list DPS-->
		<?php 
			if(isset($_GET["action"]) && $_GET["action"] == "mesDPS")	{	
		?>
		<h4>Profile->>Mes Demandes de Prestation de Service (DPS)</h4>
		<table class="table table-striped table-bordered" id="info_tbl">
			<thead>
			<tr>
				<th>Date de DPS</th>
				<th>Numero d'imputation</th>
				<th>Numero de DPS</th>
				<th>Objet</th>
				<th>Action</th>
			</tr>
			</thead>
			<tbody>
			<?php  
				$query ="SELECT * FROM dps_table WHERE id_user = ".$_SESSION['id_user']." ORDER BY id_dps";  
				$result = mysqli_query($connect, $query);  
                          while($row = mysqli_fetch_array($result))  
                          {  
                               echo '  
                               <tr>  
                                    <td>'.$row["date_dps"].'</td>  
                                    <td>'.$row["imputation"].'</td>  
                                    <td>'.$row["num_dps"].'</td>  
                                    <td>'.$row["objet_dps"].'</td>  
									<td><div class="dropdown">
                                        <button class="btn btn-secondary btn-lg dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                                            <a class="dropdown-item" href="#">Afficher</a>
                                            <a class="dropdown-item" href="#">Modifier</a>
                                            <a class="dropdown-item" href="#">Supprimer</a>
                                        </div>
                                        </div>
                                    </td>
                               </tr>  
                               ';  
                          }  
                          ?>
            </tbody>
			</table>
		<?php } //END of changermot de pass ?>
		<!-- Controiler les droit d'access-->
		<?php if($_SESSION['role_user']=='admin'){ ?>
		<!-- parametres -->
		<?php 
			if(isset($_GET["action"]) && $_GET["action"] == "parametres")	{	
		?>
		<h4>Parametres</h4>
		<div class='alert alert-warning'><strong>Oo!</strong> Actuellement vous pouvez <a href="cpanel.php?action=CtrlU">Controlez</a> ou <a href="cpanel.php?action=ajoutU">Ajouter</a> les Utilisateurs et <a href="cpanel.php?action=CtrlS">le Site</a>.</div>
		<?php } //END of Parametres ?>
		
		<!-- Ajouter Utilisateur -->
		<?php 
			if(isset($_GET["action"]) && $_GET["action"] == "ajoutU")	{	
		?>
		<h4>Parametres->>Ajouter Utilisateurs</h4>
		<br>
		<?php
			if(isset($_POST['save'])){        
				$query = "INSERT INTO users (nom_user, role_user, pass_user) 
				VALUES (?,?,?)";
				$stmt = mysqli_prepare($connect, $query);
				$pass_user = md5($_POST['pass_user']);
				$stmt->bind_param("sss", $_POST['nom_user'], $_POST['role_user'], $pass_user);
				//$stmt->execute();
				if ($stmt->execute()) { 
					echo "<div class='alert alert-success'><strong>OK!</strong> L'utilisateur est  ajouter avec succès. Pour authuntifier vous pouvez consulter la page d'<a href='login.php'> Se Connecter</a>.</div>";
					} else {
						echo "<div class='alert alert-danger'><strong>Oops!</strong> y a un erreur. Vous pouvez contacter l'adminstrateur de site.</div>";
				}
			}
			if($_SESSION['role_user']=='admin'){
    ?>
        <form class="form-horizontal" role="form" method="POST" action="cpanel.php?action=ajoutU">
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
                            <div class="input-group-addon" style="width: 2.6rem"><i class="fas fa-at"></i></div>
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
                            <div class="input-group-addon" style="width: 2.6rem"><i class="fas fa-key"></i></div>
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
                        <label class="sr-only" for="email">Role Utilisateur</label>
                        <div class="input-group mb-2 mr-sm-2 mb-sm-0">
                            <div class="input-group-addon" style="width: 2.6rem"><i class="fas fa-user"></i></div>
                            <select id="dropdown1" width="478" name="role_user" >
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
                    <button type="submit" class="btn btn-success float-right" name="save"><i class="fa fa-plus-circle"></i> Enregister</button>
                </div>
            </div>
        </form>
		<?php }else{
			echo "<div class='alert alert-danger'><strong>Oops!</strong> vous n'etes pas les droit d'access a cette page.</div>";
		}?>
		<?php } //END of Ajouter Utilisateur ?>
		
		<!-- Controler Utilisateurs -->
		<?php 
			if(isset($_GET["action"]) && $_GET["action"] == "CtrlU")	{	
		?>
		<h4>Parametres->>Controler Utilisateurs</h4>
			<table class="table table-striped table-bordered" id="info_tbl">
			<thead>
				<tr>
					<th>Nom utilisateur</th>
					<th>Role utilisateur</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
			<?php  
				$query ="SELECT * FROM users ORDER BY id_user";  
				$result = mysqli_query($connect, $query);  
                          while($row = mysqli_fetch_array($result))  
                          {  
                               echo '  
                               <tr>  
                                    <td>'.$row["nom_user"].'</td>  
                                    <td>'.$row["role_user"].'</td> 
									<td><center>
                                        <div class="dropdown">
                                        <button class="btn btn-secondary btn-lg dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">        
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                                            <a class="dropdown-item" href="#">Afficher</a>
                                            <a class="dropdown-item" href="#">Modifier</a>
                                            <a class="dropdown-item" href="#">Supprimer</a>
                                        </div>
                                        </div></center>
                                    </td>
                               </tr>  
                               ';  
                          }  
                          ?>
			</tbody>
			</table>
		<?php } //END of Controler Utilisateurs ?>
		
		<!-- Controler Site -->
		<?php 
			if(isset($_GET["action"]) && $_GET["action"] == "CtrlS")	{	
		?>
		<h4>Parametres->>Controler Site</h4>
		<?php } //END of Controler Site ?>
		<?php } ?>
		<!-- /Controller les droit d'access-->
		
	</div>
	<!--/Container-->
</section>
<?php include('footer.php'); ?>
