<!DOCTYPE html>
<html>
    <head><meta charset="utf-8"></head>
  <head>
    <title>Meditation</title>
    <link rel="stylesheet" href="global.css">

  </head>
  <body style="background-color: rgb(136, 210, 155);">

    <div class="topnav">
        <a class="active" href="./Teilnehmer.html">Home</a>
        <a href="Login.html" class="split">Login</a>
      </div>

    <!-------------Tabelle Mitte-------------------------->
    <table align=center valign=center>
      <tr><td>
<?php

$id = $_POST['id'];

$sql1 = "DELETE FROM teilnehmer WHERE id=$id";
$sql2 = "DELETE FROM reiseinfo WHERE teilnehmerID=$id";

try{

    $dbh = new PDO(
        "mysql:dbname=meditationscamp1; host=localhost",
        "root",
        ""
        );

    
        $dbh->query($sql2);
        $dbh->query($sql1);

    echo "Ihre Daten wurden entfernt.";

    $dbh = null;

}catch(PDOException $e){
    echo $e->getMessage();
}
?>

<br>
<br>
<a href = "./Teilnehmer.html"> Züruck</a>

</td></tr>
</table>

</body>
</html> 