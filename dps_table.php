<?php include('config.php'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Demande de Préstation de Service</title>
  <?php include('navbar.php');?>
    <br/>
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
include("footer.php");
?>