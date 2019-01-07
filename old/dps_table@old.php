<?php include('header.php'); ?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <title>Acceuil</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">-->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="css/style.css" >
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
  <script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>  
  <script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>            
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css" />
</head>
<body>
<nav class="navbar navbar-default">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="#">Gestion de DPS</a>
    </div>
    <ul class="nav navbar-nav">
      <li class="active"><a href="dps_table.php">Accueil</a></li>
      <li><a href="ajout_dps.php">Ajouter</a></li>
      <li><a href="#">Modifier</a></li>
    </ul>
      <ul class="nav navbar-nav navbar-right">
      <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Dropdown <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="#">Profile</a></li>
            <li><a href="#">Paramtres</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="#">Se Déconnecter</a></li>
          </ul>
        </li>
    </ul>
  </div>
    
</nav>
<div class="container-fluid">
  <h2>Demande de Préstation de Service</h2>
  <p>Cette table est fourner par les agents de direction de distribution d'élécricité et gaz du DJELFA :</p>            
  <table class="table table-striped table-bordered" id="info_tbl">
    <thead>
      <tr>
        <th>Date de DPS</th>
        <th>Numero d'imputation</th>
        <th>Numero de DPS</th>
        <th>Adressé Par</th>
        <th>Adressé Vers</th>
        <th>Type</th>
        <th>Discription</th>
        <th>Matricule</th>
        <th>Objet</th>
      </tr>
    </thead>
    <tbody>
      <?php  
        $query ="SELECT * FROM dps_table ORDER BY id_dps";  
        $result = mysqli_query($connect, $query);  
                          while($row = mysqli_fetch_array($result))  
                          {  
                               echo '  
                               <tr>  
                                    <td>'.$row["date_dps"].'</td>  
                                    <td>'.$row["imputation"].'</td>  
                                    <td>'.$row["num_dps"].'</td>  
                                    <td>'.$row["dps_par"].'</td>  
                                    <td>'.$row["dps_vers"].'</td>  
                                    <td>'.$row["type_dps"].'</td>  
                                    <td>'.$row["nom_dps"].'</td>  
                                    <td>'.$row["matricule"].'</td>  
                                    <td>'.$row["objet_dps"].'</td>  
                               </tr>  
                               ';  
                          }  
                          ?>
    </tbody>
  </table>
</div>
</body>
</html>
<?php
include('footer.php');
?>
