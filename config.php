 <?php  
 $connect = mysqli_connect("localhost", "root", "", "mondb");
// fonction pour recuperer les type, marque et matricule de veicule 
function get_enum_values($connect, $table, $field )
{
    $query ="SHOW COLUMNS FROM ".$table." LIKE '".$field."'";
    $result = mysqli_query($connect, $query );

    $row = mysqli_fetch_array($result , MYSQL_NUM );
    #extract the values
    #the values are enclosed in single quotes
    #and separated by commas
    $regex = "/'(.*?)'/";
    preg_match_all( $regex , $row[1], $enum_array );
    $enum_fields = $enum_array[1];
    
    return ($enum_fields);
    
}

function afficherDPS($dps ){
    echo $dps;
}

 ?>


