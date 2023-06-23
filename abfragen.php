<?php
include('mysql.php');

  $mysqlineu=mysqli_connect($dbhost,$dbuser,$dbpass, $dbname);
   if (mysqli_connect_errno())      die ("Connect failed: " . mysqli_connect_error());     
   mysqli_set_charset($mysqlineu, "utf8");  


if(isset($_POST['zeit']) and isset($_POST['treffer']) and isset($_POST['fehler']) and isset($_POST['game'])){
     $zeit=mysqli_real_escape_string($mysqlineu,$_POST['zeit']);
     $treffer=mysqli_real_escape_string($mysqlineu,$_POST['treffer']);
     $fehler=mysqli_real_escape_string($mysqlineu,$_POST['fehler']);
      $game=mysqli_real_escape_string($mysqlineu,$_POST['game']);
     $query="SELECT * FROM `$tabelle` WHERE `zeit`>'$zeit'"; 
     $result=mysqli_query($mysqlineu,$query);
     if($result){
          if (mysqli_num_rows($result) >= 1) {
               echo $menge_liste-mysqli_num_rows($result)-1;
          }
          if (mysqli_num_rows($result) == 0) {
               echo 'Erster Platz';
          }
     }else{
          echo "Keine Einträge  oder du bist der beste";
     }
}else{
     if(isset($_POST['show'])){
           $game=mysqli_real_escape_string($mysqlineu,$_POST['game']);
               $show=mysqli_real_escape_string($mysqlineu,$_POST['show']);
               $query="SELECT * FROM `$tabelle` WHERE `spiel`='memory".$game."' ORDER BY `zeit`+0 ASC LIMIT 0,$show"; 
             //  echo $query;
               $result = mysqli_query($mysqlineu, $query);
         // print_r($result);
               if($result){
                    if (mysqli_num_rows($result) >= 1) {
                    $r=1;
                         while($row=mysqli_fetch_array($result)){
                              $datum=date("Y-m-d H:i:s",$row['datum']);
                              echo "<tr><td>$r</td><td>".$row['spiel']."</td>
                              <td>".$row['name']."</td>
                              <td>$datum</td>
                              <td>".$row['zeit']."</td>
                              <td>".$row['fehler']."</td>
                              <td>".$row['treffer']."</td>
                              </tr>";
                              $r++;
                        }
                    }else{
                         echo "Keine Einträge";
                    }
               }

     }else{
die('Direkaufruf nicht erlaubt');
}
}        
?>