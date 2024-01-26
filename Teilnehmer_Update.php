
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
$vorname = $_POST['vorname'];
$nachname = $_POST['nachname'];
$geschlecht = $_POST['geschlecht'];
$geburtsdatum = $_POST['geburtsdatum'];
$stadt = $_POST['stadt'];
$land = $_POST['land'];
$telefon = $_POST['telefon'];
$email = $_POST['email'];
$passwort = $_POST['passwort'];
$teilnehmeranzahl = $_POST['teilnehmeranzahl'];

$ankunftsort = $_POST['ankunftsort'];
$ankunftsdatum = $_POST['ankunftsdatum'];
$ankunftszeit = $_POST['ankunftszeit'];
$abfahrtsort = $_POST['abfahrtsort'];
$abfahrtsdatum = $_POST['abfahrtsdatum'];
$abfahrtszeit = $_POST['abfahrtszeit'];
$anzahlNaechten = $_POST['anzahlNaechten']; 


$updateTeilnehmer = "UPDATE teilnehmer SET vorname ='$vorname', nachname ='$nachname', geschlecht = '$geschlecht',
geburtsdatum ='$geburtsdatum', stadt ='$stadt', land = '$land', telefon ='$telefon', email ='$email', passwort ='$passwort',
teilnehmeranzahl = '$teilnehmeranzahl'
 WHERE id = $id;";

try{

    $dbh = new PDO(
        "mysql:dbname=meditationscamp1; host=localhost",
        "root",
        ""
        );    
    $dbh->query($updateTeilnehmer);
    /*echo "Ihre Daten wurden erfolgreich aktualisiert.";*/
 
    $selectReiseInfo = "select * from reiseinfo Where reiseinfo.teilnehmerID = $id;";

    $result = $dbh->query($selectReiseInfo);
    $row = $result->fetch();
    if($row){
      $updateReiseInfo = "UPDATE reiseinfo SET ankunftsort ='$ankunftsort', ankunftsdatum ='$ankunftsdatum', ankunftszeit = '$ankunftszeit',
      abfahrtsort ='$abfahrtsort', abfahrtsdatum ='$abfahrtsdatum', abfahrtszeit = '$abfahrtszeit', anzahlNaechten = $anzahlNaechten
      WHERE teilnehmerID = $id;";

      $dbh->query($updateReiseInfo);
    }else{
      $insertReiseInfo = "INSERT INTO reiseinfo(ankunftsort,ankunftsdatum,ankunftszeit,abfahrtsort,abfahrtsdatum,abfahrtszeit, 
        teilnehmerID,anzahlNaechten)  
        VALUE ('$ankunftsort','$ankunftsdatum','$ankunftszeit','$abfahrtsort','$abfahrtsdatum','$abfahrtszeit', 
        '$id','$anzahlNaechten');"; 

      $dbh->query($insertReiseInfo);
    }


    echo "Ihre Daten wurden erfolgreich aktualisiert.";
    $dbh = null;

}catch(PDOException $e){
    echo $e->getMessage();
}
?>
<br><br>
<a href = "javascript:history.back()"> Züruck</a>

</td></tr>
</table>

</body>
</html> 