<?php include('config.php'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Ajouter Des Pièces</title>
 <?php include('navbar.php');?>
    <br/>
<div class="container">
  <h2>Ajouter des Demande de Prestation de Service (DPS)</h2>
  <p>toutes les informations mentionnées sur la responsabilité de L'agent qui remplit ce formulaire </p>   
    <?php
    if(isset($_POST['submit'])){        
        $query = "INSERT INTO dps_table (date_dps, imputation, num_dps, dps_par, dps_vers, type_dps, nom_dps, matricule, objet_dps, id_user) 
        VALUES (?,?,?,?,?,?,?,?,?,?)";
        $objet_dps = nl2br(htmlentities($_POST['objet_dps'], ENT_QUOTES, 'UTF-8'));
		$id_user = $_SESSION['id_user'];
        $stmt = mysqli_prepare($connect, $query);
        $stmt->bind_param("ssdssssssd", $_POST['date_dps'], $_POST['imputation'], $_POST['num_dps'], $_POST['dps_par'], $_POST['dps_vers'], $_POST['type_dps'], $_POST['nom_dps'], $_POST['matricule'], $objet_dps,$id_user);
        //$stmt->execute();
        if ($stmt->execute()) { 
            echo "<div class='alert alert-success'><strong>OK!</strong> Les information sont ajouter avec succès. Pour visualiser la resultat vous pouvez consulter la page d'<a href='dps_table.php'>Accueil</a>.</div>";
        } else {
            echo "<div class='alert alert-danger'><strong>Oops!</strong> y a un erreur. Vous pouvez contacter l'adminstrateur de site.</div>";
        }
    }

    ?>
     <form action="ajout_dps.php" method="post" class="needs-validation" novalidate>
  <table class="table table-bordered">
    <thead>
      <tr>
        <th>Ajouter des information</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>Date de Demmande DPS<sub style="color:red; font-weight: bold"> Obligatoire</sub></td>
        <td>
            <input id="datepicker1" width="200" name="date_dps" autocomplete="off" required />
            <script>
                $('#datepicker1').datepicker({
                    uiLibrary: 'bootstrap4',
                    format: 'yyyy/mm/dd'
                });
            </script>
        </td>
      </tr>
      <tr>
          <td>Imputation<sub style="color:red; font-weight: bold"> Obligatoire</sub></td>
          <td><input type="text" class="form-control" id="usr" name="imputation" autocomplete="off" required>
              <div class="invalid-feedback">SVP donnez l'Imputation.</div>
          </td>
      </tr>
      <tr>
          <td>Numero de DPS<sub style="color:red; font-weight: bold"> Obligatoire</sub></td>
          <td><input type="text" class="form-control" id="usr" name="num_dps" autocomplete="off" required>
              <div class="invalid-feedback">SVP donnez le numero de DPS.</div>
          </td>
      </tr>
      <tr>
        <td>Adresée Par :<sub style="color:red; font-weight: bold"> Obligatoire</sub></td>
        <td>
            <select id="dropdown1" width="200" name="dps_par" required>
                <option value="">SVP Choisissez...</option>
                <?php
                    $dps_pars = get_enum_values($connect,'dps_table','dps_par');
                    foreach($dps_pars as $dps_par){
                        echo"<option value='".$dps_par."'>".$dps_par."</option>";
                    }
                ?>
            </select>
			<div class="invalid-feedback">SVP donnez le numero de DPS.</div>
            <script>
                $('#dropdown1').dropdown();
            </script>
          </td>
      </tr>
        <tr>
            <td>Adresée Vers :<sub style="color:red; font-weight: bold"> Obligatoire</sub></td>
            <td>
                <select id="dropdown2" width="200" name="dps_vers" required>
                    <option value="0">SVP Choisissez...</option>
                    <?php
                        $dps_verss = get_enum_values($connect,'dps_table','dps_vers');
                        foreach($dps_verss as $dps_vers){
                            echo"<option value='".$dps_vers."'>".$dps_vers."</option>";
                        }
                    ?>
                </select>
                <script>
                    $('#dropdown2').dropdown();
                </script>
           </td>
      </tr>
      <tr>
            <td>Type DPS :<sub style="color:green; font-weight: bold"> Si Nécessaire</sub></td>
            <td>
                <select id="dropdown3" width="200" name="type_dps" required>
                    <option value="0">SVP Choisissez...</option>
                    <?php
                        $types_dps = get_enum_values($connect,'dps_table','type_dps');
                        foreach($types_dps as $type_dps){
                            echo"<option value='".$type_dps."'>".$type_dps."</option>";
                        }
                    ?>
                </select>
                <script>
                    $('#dropdown3').dropdown();
                </script>
           </td>
      </tr>
      <tr>
            <td>Discription :<sub style="color:green; font-weight: bold"> Si Nécessaire</sub></td>
            <td>
                <select id="dropdown4" width="200" name="nom_dps" required>
                    <option value="0">SVP Choisissez...</option>
                    <?php
                        $noms_dps = get_enum_values($connect,'dps_table','nom_dps');
                        foreach($noms_dps as $nom_dps){
                            echo"<option value='".$nom_dps."'>".$nom_dps."</option>";
                        }
                    ?>
                </select>
                <script>
                    $('#dropdown4').dropdown();
                </script>
           </td>
      </tr>
      <tr>
            <td>Matricule :<sub style="color:green; font-weight: bold"> Si Nécessaire</sub></td>
            <td>
                <select id="dropdown5" width="200" name="matricule" required>
                    <option value="0">SVP Choisissez...</option>
                    <?php
                        $matricules = get_enum_values($connect,'dps_table','matricule');
                        foreach($matricules as $matricule){
                            echo"<option value='".$matricule."'>".$matricule."</option>";
                        }
                    ?>
                </select>
                <script>
                    $('#dropdown5').dropdown();
                </script>
           </td>
      </tr>
      <tr>
          <td>Objet de DPS<sub style="color:red; font-weight: bold"> Obligatoire</sub></td>
          <td><textarea class="form-control" rows="5" id="comment" name="objet_dps" autocomplete="off" required></textarea>
              <div class="invalid-feedback">SVP donnez l'objet de DPS</div>
          </td>
      </tr>
    </tbody>
    </table>
    <center>
        <button type="submit" class="btn btn-outline-dark btn-lg" name="submit">Ajouter Les info</button>
    </center>
    </form>
    
</div>
</body>
</html>
<?php
include('footer.php');
?>