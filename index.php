<?php
if(file_exists('mysql.php')){
?>
<!doctype html>
<html lang="de">
<head>
<title>Memory spiel</title>
<style>
#memorycontainer {
    display: flex;
    flex-direction: column;
    border: 2px solid black;
    width: 98%;
    max-width:800px;
    margin: 0 auto;
    overflow: hidden;
    flex-wrap: wrap;
    align-content: space-around;
    align-items: stretch;
    justify-content: space-evenly;
}
.infos {
    display: flex;
    flex-direction: row;
    margin: 10px;
    justify-content: space-evenly;
    align-items: center;
}
h1 {
    font-size:55px;
    margin:10px;
    text-align: center;
}
#container { 
    margin: 0 auto;
}
ol { 
    padding: 0; 
    margin: 0;
}
li {
    padding: 0;
    margin: 10px;
    list-style: none;
    outline: solid;
    width: 100px;
    height: 100px;
    background:rgb(223 230 203);
}
img { 
    width: 100%;
    height: 100%;
}
.info_boxen,select{
    max-width:200px;
    width:40%;
    border:1px solid black;
    border-radius:10px;
    padding:10px;
    background:rgb(223 230 203);
}
ol {
    height: 100%;
    display: flex;
    flex-wrap: wrap;
    flex-direction: row;
    justify-content: space-between;
    align-items: stretch;
    align-content: stretch;
}
#endbox {
    width: 50%;
    max-width: 300px;
    min-height: 250px;
    border: 2px solid red;
    border-radius: 10px;
    background: white;
    display: none;
    flex-direction: column;
    overflow: hidden;
    z-index:12;
    padding: 10px;
    position: fixed;
    top: 50%;
    left: 50%;
    padding:10px;
    transform: translate(-50% , -50%);
    flex-wrap: nowrap;
    justify-content: space-around;
}
#ende_h1 {
    text-decoration: underline;
    display: flex;
    margin: 0;
    padding: 0;
    text-align: center;
    flex-direction: row;
    flex-wrap: nowrap;
    justify-content: space-around;
}
#ende_text{
    padding:0 10px;
}

#background{
    position:fixed;
    top:0;
    right:0;
    bottom:0;
    left:0;
    display:none;
    z-index:10;
    width:100vw;
    height:100vh;
    background:rgba(0,0,0,0.6);
}
#ende_buttons{
    display:flex;
}
#ende_buttons input{
    flex:1;
    height:25px;
}

#sendebox{
    display:none;
    flex-direction:column;
}
#sendebox label{
    text-align:center;
}
#sendebox div{
    display:flex;
}
#sendebox div input{
    width:45%;
    padding:4px;
    display:flex;
}
#tabelle_bestenliste{
    position:absolute;
    top:0;
    right:0;
    bottom:0;
    left:0;
    display:none;
    overflow: auto;
    z-index:10;
    width:100vw;
    height:100vh;
    background:rgba(0,0,0,0.6);
}
#tabelle_bestenliste table{
    width: 90%;
    max-width: 900px;
    border: 2px solid black;
    background: white;
    overflow: scroll;
    z-index: 12;
    padding: 10px;
    position: absolute;
    top: 50px;
    left: calc(90vw - 85vw);
    padding: 10px;
    max-height: 70vh;
}
#tabelle_bestenliste th{
    font-weight:900;
}
#tabelle_bestenliste td{
    border-collapse:collapse;
    border:1px solid black;
}
#memoy_close_bestenliste{
    position:absolute;
    right:0;
    top:0;
    text-align:center;
    width:30px;
    height:30px;
    background:red;
    color:white;
    font-size:27px;
}
#memoy_close_bestenliste:hover{
    background:green;
    cursor:pointer;
    transition: all 500ms;
}
@media (max-width: 571px) {
    #ende_h1 {
        font-size: 25px;
    }
    li{
        width:16vw;
    }
}
label {
    display: flex;
    flex-direction: row;
    width: 100%;
    justify-content: space-between;
    flex-wrap: nowrap;
}
</style>
<script src="jquery.js"></script>
</head>
<body>
<div class="column" id="memorycontainer">
    <div id="tabelle_bestenliste">
        <div id="memoy_close_bestenliste">X</div>
            <table>
                <tr>
                    <th>Nr.</th>
                    <th>Spiel</th>
                    <th>>Name</th>
                    <th>Datum</th>
                    <th>Zeít</th>
                    <th>Fehlver</th>
                    <th>Treffer</th>
                </tr>
                <tbody id="listeinhalt"></tbody>
            </table> 
        </div>
        <div id="background"></div>
        <div id="endbox">
            <h1 id="ende_h1">Gewonnen</h1>
            <p id="ende_text"></p>
            <div id="ende_buttons">
                <input type="button" id="ende_best" value="eintragen">
                <input type="button" id="ende_no" value="Abrechen">
            </div>
            <div id="sendebox">
                <label>Dein Name</label>
                <div>
                    <input type="text" id="memory_user">
                    <input type="button" id="absenden" value="Eintragen">
                </div>
            </div>
        </div>
        <h1>MEMORY</h1>
        <div class="infos">
            <label>  
                <select id="memory_pare_abfrage">
                    <option value="2">4</option>
                    <option value="3">6</option> 
                    <option value="4">8</option>
                    <option value="5">10</option>
                    <option value="6">12</option>
                    <option value="7">14</option>
                     <option value="8">16</option>
                    <option value="9">18</option> 
                    <option value="10">20</option>
                    <option value="11">22</option>
                    <option value="12">24</option>
                    <option value="13">26</option>                   
                </select>
                <input class="info_boxen" type="button" id="memory_bestenliste" value="Highscorelisten auswahl">
            </label>
       </div>
       <div class="infos">
           <div class="info_boxen" id="memory_timer">TIME</div>
           <span  class="info_boxen" id="treff">Gesamt :</span>
           <span  class="info_boxen" id="fehle">Fehler :</span>
       </div>

       <div class="row_start infos">
       <label> 
           <select id="memory_pare">
                    <option value="2">4</option>
                    <option value="3">6</option> 
                    <option value="4">8</option>
                    <option value="5">10</option>
                    <option value="6">12</option>
                    <option value="7">14</option>
                    <option value="8">16</option>
                    <option value="9">18</option> 
                    <option value="10">20</option>
                    <option value="11">22</option>
                    <option value="12">24</option>
                    <option value="13">26</option>   
           </select>
           <input class="info_boxen" type="button" id="start" value="Start">
        </label>
    </div>
    <div id= "container"></div>
</div>
<script>
var m_t=document.getElementById('memory_timer');
var m_tre=document.getElementById('treff');
var m_feh=document.getElementById('fehle');
var m_sen=document.getElementById('sendebox')
var m_back=document.getElementById('background');
var m_end=document.getElementById('endbox');
var m_text=document.getElementById('ende_text');
var erstgame=true;
var sendeopen=false;
var timer,mi,se;
var y=0;
var fehler=0;
var treffer=0;

function game_start(){
   var images = [];
   var gesamt_pare=document.getElementById("memory_pare").value;
 
   for (var i = 0 ; i < gesamt_pare; i++) { 
      var img = '' + (i+1) + '.png';
      images.push(img);
      images.push(img);
   }
   randomizeImages();
   var output = "<ol>"; 
   for (var i = 0; i < gesamt_pare*2; i++) { 
      output += "<li>";
      output += "<img src = '" + images[i] + "'/>";
      output += "</li>";
   }
   output += "</ol>";
   document.getElementById("container").innerHTML = output;
   $("img").hide();
   var guess1 = "";
   var guess2 = "";
   var count = 0;
   $("li").click(function() {
     if ((count < 2) &&  ($(this).children("img").hasClass("face-up")) === false) {
       count++;
       $(this).children("img").show();
       $(this).children("img").addClass("face-up");
       if (count === 1 ) { 
           guess1 = $(this).children("img").attr("src"); 
       }else { 
           guess2 = $(this).children("img").attr("src"); 
           if (guess1 === guess2) { 
               treffer++;
               $("li").children("img[src='" + guess2 + "']").addClass("match");
           } else { 
               fehler++;
               setTimeout(function() {
                 $("img").not(".match").hide();
                 $("img").not(".match").removeClass("face-up");
               }, 1000);
           }
           m_tre.innerHTML="Gesamt "+treffer+'/'+gesamt_pare;
           m_feh.innerHTML="Fehler "+fehler;
           count = 0; 
           if(treffer>=gesamt_pare) {
               clearInterval(timer);
               m_back.style.display='block';
               m_end.style.display='flex';
               erstgame=false;
               $.ajax({
                   type: 'POST',
                   data: {show:50},
                   url: 'abfragen.php',
                   data: {treffer:treffer,fehler,fehler,zeit:y},
                   success: function(data){ 
                   if(data>100){
                    //    m_text.innerHTML='Du bist auf Platz '+data+'<br>und auserhalb des sichtbaren bereichs';
                   }else{
                        m_text.innerHTML='Du bist auf Platz '+data+'<br>Möchtest du dich in de bestenliste eintrasgen';
                   }
                   }
               })
           }   
       }
     }
    });
    function randomizeImages(){
      Array.prototype.randomize = function(){
        var i = this.length, j, temp;
        while ( --i ){
          j = Math.floor( Math.random() * (i - 1) );
          temp = this[i];
          this[i] = this[j];
          this[j] = temp;
        }
      };
      images.randomize();
    }
}
document.getElementById('start').addEventListener('click',function(){
    timer=setInterval(function(){
        y++;
        mi=Math.floor((y/60));
        se=Math.floor((y%60));
        if(se<=9){
          se='0'+se;
        }
        if(mi<=9){
          mi='0'+mi;
        }
        m_t.innerHTML='Time: '+mi+':'+se;
    },1000)
  
    if(erstgame!=true){
        m_back.style.display='none';
        m_end.style.display='none';
        y=0;
        fehler=0;
        treffer=0;
    }
    if(sendeopen!=true){
        m_sen.style.display='false';
    }
    game_start();
})
document.getElementById('ende_best').addEventListener('click',function(){
    m_sen.style.display='block';
})
document.getElementById('absenden').addEventListener('click',function(){
    m_sen.style.display='none';
    sendeopen=false;
    console.log(document.getElementById('memory_user').value,fehler,treffer,y);
    $.ajax({
        type: 'POST',
        url: 'eintragen.php',
        data: {
            treffer:treffer,
            fehler:fehler,
            name:document.getElementById('memory_user').value,
            zeit:y,
            game:document.getElementById("memory_pare").value
        },
        success: function(data1){ 
            if(data1==1){
                  m_sen.style.display='none';
                  m_back.style.display='none';
                  m_end.style.display='none';
            }else if(data1=='err'){
                  setTimeout(function(){
                       m_sen.style.display='none';
                       m_back.style.display='none';
                       m_end.style.display='none';
                  },4000)
                       m_sen.innerHTML='<p style="color:red">Probleme mit der Datenbank<br>Versuchen sie es später nochmal</p>';
            }else{
                alert(data1)
            }
        }
    })
})
document.getElementById('ende_no').addEventListener('click',function(){
    console.log(sendeopen);
    if(sendeopen!=true){
         console.log(sendeopen+' behind if');
         m_back.style.display='none';
         m_end.style.display='none';
         m_sen.style.display='none';
     }
})
var m_tab=document.getElementById('tabelle_bestenliste');
document.getElementById('memory_bestenliste').addEventListener('click',function(){
               $.ajax({
                   type: 'POST',
                   url: 'abfragen.php',
                   data: {
                   show:100,
                   game:document.getElementById("memory_pare_abfrage").value
                   },
                   success: function(data2){ 
                         document.getElementById('listeinhalt').innerHTML=data2;   
                   }
               })
    m_tab.style.display='flex';

})
document.getElementById('memoy_close_bestenliste').addEventListener('click',function(){
    m_tab.style.display='none';

})
</script>
</body>
</html>
<?php

  }else{
  ?>
  <!doctype html>
  <html lang="de">
  <head>
    <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="style.css" rel="stylesheet">
  </head>
  <body>
  <?php
    include('install.php');
  }
?>
  </body>
</html