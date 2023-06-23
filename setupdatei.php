<!DOCTYPE html>
<html lang="de">
  <head>
    <meta charset="utf-8">
    <title>Installation</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="style.css" rel="stylesheet">
  </head>
  <body>
<?php
function setup(){
   if(empty($_POST['dbhost']) OR empty($_POST['dbpw']) OR  empty($_POST['dbname']) OR  empty($_POST['dbuser']) OR empty($_POST['name_tabelle'])){
      echo "<div class='error'>Bitte fülle alle Felder aus</div>";
      echo "<a href='javascript:history.back()'>Zurück</a>";
   }else{
      $zeile='<?php $tabelle="'.$_POST['name_tabelle'].'";$host="'.$_POST['dbhost'].'";$dbname="'.$_POST['dbname'].'";$dbuser= "'.$_POST['dbuser'].'";$dbpass= "'.$_POST['dbpw'].'"; ?>';
      file_put_contents("mysql.php", $zeile);
      include('mysql.php');
  $mysqlineu=mysqli_connect($dbhost,$dbuser,$dbpass, $dbname);
   if (mysqli_connect_errno())      die ("Connect failed: " . mysqli_connect_error());     
   mysqli_set_charset($mysqlineu, "utf8");  




/*
$result2 = mysqli_query($mysqli, $query)  or die ("MySQL-Error: " . mysqli_error($mysqli));
if($result2) {   
     die("Datenbak  homepage wurde erstellt ");
}else{
     echo "FEHLER bei erstellen der Datenbank  Chat  bitte erstelle sie Manual";
}



*/












         $install_query="CREATE TABLE `$tabelle`(
          `id` int unsigned NOT NULL AUTO_INCREMENT,
         `spiel` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
         `name` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
         `zeit` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
         `fehler` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
         `datum` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
         `treffer` varchar(25) COLLATE utf8_unicode_ci NOT NULL,      
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)

) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci";
 
  //  ) ENGINE=MyISAM AUTO_INCREMENT=1;";
    
   if(mysqli_query($mysqlineu,$install_query)){

           echo "<div class='succes'>Tabelle $tabelle wurde erstellt</div>";
           $eins=true;
        }else{
           $eins=false;
           echo "<div class='error'>Fehler beim erstellen der Tabelle $tabelle  </div>";
              die ("MySQL-Error: " . mysqli_error($mysqlineu));
        }


      $filename2 = 'mysqli.php';
      if (file_exists($filename2) AND $eins==true){
          if(isset($_POST['kill'])){
              //unlink('setupdatein.php');
              //unlink('install.php');
              echo "<div class='succes'>Setup Datein wurden gelöscht</div>";
          }
      }else{
           if(isset($_POST['kill'])){
               echo "<div class='error'>Setupdatein wurde nicht gelöscht</div>";
           }
      }
      echo "<br><a href='index.php'>Zum Spiel</a>";
   }
}
if(isset($_POST['dbpw'])){
    setup();
}
?>
</body>
</html>