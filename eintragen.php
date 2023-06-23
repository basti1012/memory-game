<?php
include('mysql.php');


  $mysqlineu=mysqli_connect($dbhost,$dbuser,$dbpass, $dbname);
   if (mysqli_connect_errno())      die ("Connect failed: " . mysqli_connect_error());     
   mysqli_set_charset($mysqlineu, "utf8");  

if(isset($_POST['zeit']) and isset($_POST['treffer']) and isset($_POST['fehler']) and isset($_POST['name'])){

$speren = array("*", "INFORMATION_SCHEMA","DISTINCT","AS NUMERIC","BENCHMARK","AS NCHAR","'","`",'"',";");
for($rr=0;$rr<count($speren);$rr++){
    $pos1 = strpos($_POST['name'], $speren[$rr]);
    $pos2 = strpos($_POST['fehler'], $speren[$rr]);
    $pos3 = strpos($_POST['treffer'], $speren[$rr]);
    $pos4 = strpos($_POST['game'], $speren[$rr]);    
    if ($pos1 === false and $pos2 === false and $pos3 === false and $pos4 === false) {

    } else {

        die('Zur Info,ich habe deinen SQL Injectionsversuch gemerkt');
    }
}


        $name=mysqli_real_escape_string($mysqlineu,$_POST['name']);
        $zeit=mysqli_real_escape_string($mysqlineu,$_POST['zeit']);
        $treffer=mysqli_real_escape_string($mysqlineu,$_POST['treffer']);
        $fehler=mysqli_real_escape_string($mysqlineu,$_POST['fehler']);
   $game=mysqli_real_escape_string($mysqlineu,$_POST['game']);
        $query = "Insert into `$tabelle`
                (`name`, `zeit`,`fehler`,`datum`,`treffer`,`spiel`)
                  values ('%s', '%s', '%s','%s','%s','%s')";
          
        $query = sprintf($query, mysqli_real_escape_string($mysqlineu, $name),
        mysqli_real_escape_string($mysqlineu, $zeit),
        mysqli_real_escape_string($mysqlineu, $fehler),
        mysqli_real_escape_string($mysqlineu, date('U')),
        mysqli_real_escape_string($mysqlineu, $treffer),
        mysqli_real_escape_string($mysqlineu, 'memory'.$game));
        $result = mysqli_query($mysqlineu, $query);
        if($result){
             echo 1;//mysqli_insert_id($mysqlineu);
        }else{
             echo "err";
           //   die ("MySQL-Error: " . mysqli_error($mysqlineu));
        }
}else{
die('Direkaufruf nicht erlaubt');
}
?>