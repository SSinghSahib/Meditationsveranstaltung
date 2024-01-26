
<!DOCTYPE html>
<html>
    <head><meta charset="utf-8"></head>
<head>
    <title>Meditation</title>
    <link rel="stylesheet" href="global.css">
</head>
<body>
    <div class="topnav">
        <a class="active" href="./Teilnehmer.html">Home</a>
        <a href="Login.html" class="split">Login</a>
    </div>
<!-------------Tabelle Mitte-------------------------->
    <table align=center valign=center>
      <tr><td>

<?php

$vorname = $_POST['vorname'];
$nachname = $_POST['nachname'];
$geschlecht = $_POST['geschlecht'];
$geburtsdatum = $_POST['geburtsdatum'];
$stadt = $_POST['stadt'];
$land = $_POST['land'];
$telefon = $_POST['telefon'];
$email = $_POST['email'];
$teilnehmeranzahl = $_POST['teilnehmeranzahl'];
$passwort = $_POST['passwort'];

$ankunftsort = $_POST['ankunftsort'];
$ankunftsdatum = $_POST['ankunftsdatum'];
$ankunftszeit = $_POST['ankunftszeit'];
$abfahrtsort = $_POST['abfahrtsort'];
$abfahrtsdatum = $_POST['abfahrtsdatum'];
$abfahrtszeit = $_POST['abfahrtszeit'];
$anzahlNaechten = $_POST['anzahlNaechten']; 

$insertTeilnehmer = "INSERT INTO teilnehmer(vorname, nachname, geschlecht, geburtsdatum, stadt, land, telefon, email,teilnehmeranzahl,passwort)
VALUE ('$vorname', '$nachname', '$geschlecht', '$geburtsdatum', '$stadt', '$land', '$telefon', '$email', '$teilnehmeranzahl', '$passwort');";

try{
    $dbh = new PDO(
        "mysql:dbname=meditationscamp1; host=localhost",
        "root",
        ""
        );
    // echo "<h3> Verbindung erfolgreich hergestellt! <h3>" . "<br>";
    
    $dbh->query($insertTeilnehmer);

    $lastInsertId =  $dbh->lastInsertId();

/*---------teilnehmer Tabelle mit reiseinfo Tabelle Verbunden------------------------- */

if($ankunftsort && $ankunftsdatum){

$insertReiseInfo = "INSERT INTO reiseinfo(ankunftsort,ankunftsdatum,ankunftszeit,abfahrtsort,abfahrtsdatum,abfahrtszeit, 
teilnehmerID,anzahlNaechten)  
VALUE ('$ankunftsort','$ankunftsdatum','$ankunftszeit','$abfahrtsort','$abfahrtsdatum','$abfahrtszeit', 
'$lastInsertId','$anzahlNaechten');"; 

    $dbh->query($insertReiseInfo);
}  
    $dbh = null;
    
 /* echo "New record created successfully. Last inserted ID is: " . $lastInsertId;*/
echo "<br>";
echo "Vielen Dank für Ihre Anmeldung."."<br>"; 
echo " Ihre Daten sind erfolgreich unter ID: ". $lastInsertId ." gespeichert worden."; 

}catch(PDOException $e){
    $errorMsg = $e->getMessage();
    if (str_contains($errorMsg, "for key 'email'")) {
        echo "Die E-Mail-Adresse ist falsch. Bitte versuchen Sie erneut.";
    }else{
       echo $errorMsg; 
    }
    
}
?>
<br><br>
<a href = "javascript:history.back()"> Züruck</a>


</td></tr>
</table>

</body>
</html>  
