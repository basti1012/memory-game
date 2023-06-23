<?php

include('mysqli.php');

  $mysqlineu=mysqli_connect($dbhost,$dbuser,$dbpass, $dbname);
   if (mysqli_connect_errno())      die ("Connect failed: " . mysqli_connect_error());     
   mysqli_set_charset($mysqlineu, "utf8");  
   $query="SELECT * FROM `memory_bestenliste`"; 
   $result=mysqli_query($mysqlineu,$query);
   if($result){
          if (mysqli_num_rows($result) >= 1) {
               $menge_liste=mysqli_num_rows($result);
          }
    }
?>