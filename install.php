<!doctype html>
<html lang="de">
<head>
<style>

*{
  margin:0;
  padding:0;
}
body{
  padding-top:50px;
  text-align:center;
}
.infotext{
  display:none;
  position:fixed;
  top:20px;
  left:20px;
  background:black;
  width:200px;
  border:2px solid red;
  border-radius:10px;
  padding:10px;
  text-align:center;
  color:white;
}
.info:hover >.infotext{
  display:block;
}
.info{
font-weight:900;
  font-size:22px;
}
form{
  width:80vw;
  margin:0 auto;
  border:3px solid grey;
  border-radius:20px;
  padding:20px;
}
form h1{
  text-align:center;
  text-decoration:underline;
}
form label{
  margin:3px 0;
  display:flex;
}
label p{
  width:250px;
}
.succes{
    font-size:25px;
    color:green;
}
.error{
    font-size:25px;
    color:red;
}
.erstelle,.anmelden{
    max-width:300px;
width:80vw;
text-align:center;
}
.input_feld {
  width: 90%;
  margin: 5px;
  font-size: 18px;
  background-color: #eee;
  border: none;
  height: 25px;
  border-radius: 4px;
  box-shadow: inset 0 0 4px #aaa;
  color: #404040;
  padding: 5px;
}
.input_feld_info{
  width:calc(100% - 80px);
}
.input_feld:focus,
.input_feld:hover {
  box-shadow: 0 0 8px #4FBDEC;
  outline-width: 0;
}
form.create{
    text-align: center;
}

</style>
</head>
<body>
<?php
$pfad=$_SERVER['PHP_SELF'];
$HOST=$_SERVER['HTTP_HOST'];
$pfad=explode('/',$pfad);
$count_ordner=count($pfad)-1;
for($f=0;$f<$count_ordner;$f++){
    $HOST.=$pfad[$f].'/';
}
$filename3='mysql.php';
if (file_exists($filename3)) {
   echo "Die Setup Datei wurde schon ausgeführt<br>";
   $filename1 = 'setupdatei.php';
   if (file_exists($filename1)) {
       echo "Setupdatei.php exestiert noch im Ordner<br> und kann ggf noch Manuell ausgeführt werden<br>";
   }else{
       echo "Die dazugehöhrigen Setupdatein wurden vom System gelöscht<br>";
   }
   exit;
} else {
?>
<div id="setupcontainer">
<h1>Anleitung und Setup</h1>
 
<p>1.Starten Sie den Setup mit dem öffnen der index.php.
<p>Glückwunsch, das haben SIE gemacht sonst könnten SIE das hier nicht lesen.</p>
 
<p>2.Nach erfolgreicher Installation können SIE memory spielenn</p>

<u>Sie können in diesen Spiel noch weitere Bilder hinzufügen.
Beachten Sie das die Bilder eine fortlaufende Zahl haben .
26 Bilder sind schon vorhanden dann brauchen die nächten Bilder nur 27.png,28.png,29.png usw benennen.</p>
<p>Andern sie dann noch die Select Listen auf die Anzahl der Bilder die sie jetzt in den Image Ordener geladen haben,
je mehr select sie eintragen um so mehr  verschiedene Highscore Liste haben sie dann.
Die Anzahl der Bilder hat jeweils eine eigene Liste</p>

</div>
<form id="install" name="eingabe" action="setupdatei.php" method="post">   
     <h1>Setup starten</h1>
     <label>  Datenbank Host:  </label> 
          <input type="text" id="dbhost" name="dbhost" class="input_feld">

     <label> Datenbank Name:  </label> 
          <input type="text" id="dbname" name="dbname" class="input_feld">
  
     <label>   Datenbank User:   </label> 
          <input type="text" id="dbuser" name="dbuser" class="input_feld">
     <label>   Datenbank passwort:   </label> 
          <input type="text" id="dbpw" name="dbpw" class="input_feld">

     <label>   Name der Tabelle:   </label> 
          <input type="text" id="name_tabelle" name="name_tabelle" value="memorybestenliste" class="input_feld">

  <!--
     <label>
         <p>Setupdatei Löschen ?*</p>
         <input type="checkbox" name="kill" value="kill"> 
              <div class="info">[?]
                  <span class="infotext">
                       Nach erfolgreicher Installation werden die Setupdatein gelöscht.Werden in der Regel auch nicht mehr gebraucht.
                  </span>
              </div>
     </label>
     <label>
          <p>Bilder auch Löschen ?*</p>
          <input type="checkbox" name="kill_bild" value="kill_bild">  
          <div class="info">[?]
              <span class="infotext">
                  Nach erfolgreicher Installation werden auch die Bilder der Installations Anleitung gelöscht
              </span>
          </div>
     </label>
  -->
  <label>
        <input type="submit" class="buttonstyle" value="Setup Starten">
  </label>
    <!--
  <small>*Die Setupdatein werden nach erfolgreicher Installation vom Server gelöscht.</small>
-->
  <h5>Es wird eine mysql.php Datei erstellt.</h5>
</form>
<?php
}
?>