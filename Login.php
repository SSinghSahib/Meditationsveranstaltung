<!DOCTYPE html>
<html>
    <head><meta charset="utf-8"></head>
  <head>
    <title>Meditation</title>
    <link rel="stylesheet" href="global.css">
    <script>

      function confirmToDelete() {
        if (confirm('Möchten Sie wirklich absagen?')) {
          document.getElementById('teilnehmer_delete').submit();
        }      
      }
    </script>
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

$email = $_POST['email'];
$passwort = $_POST['passwort'];

/*-------------- Für Verwaltung------------------*/
/*-- Hier Für Admin--------------*/
if ($email == "admin@web.de") {
    
    if ($passwort == "admin123") {

$sql = "select * from teilnehmer LEFT JOIN reiseinfo ON reiseinfo.teilnehmerID = teilnehmer.id;";
$sqlFuerAnzahlTeilnehmer = "select sum(teilnehmeranzahl) as total from teilnehmer;";
    
  try{

        $dbh = new PDO(
            "mysql:dbname=meditationscamp1; host=localhost",
            "root",
            ""
            );
    
// echo "<h3> Verbindung erfolgreich hergestellt! <h3>" . "<br>";
        
        $result = $dbh->query($sql);

 /*-- Hier Für Admin Teilnehmerbericht--------------*/   
        echo "<h3>Teilnehmerbericht</h3>";
 
        echo "<table border='1'>
        <tr>
          <td>Vorname</td>
          <td>Nachname</td>
          <td>Stadt</td>
          <td>Land</td>
          <td>Telefon</td>
          <td>Teilnehmeranzahl</td>
          <td>Ankunftsort</td>
          <td>Ankunftsdatum</td>
          <td>Ankunftszeit</td>
          <td>Abfahrtsort</td>
          <td>Abfahrtsdatum</td>
          <td>Abfahrtszeit</td>
        </tr>";

  while ($row = $result->fetch()) {
    echo "<tr><td>".$row['vorname']."</td>".
            "<td>".$row['nachname']."</td>".
            "<td>".$row['stadt']."</td>".
            "<td>".$row['land']."</td>".
            "<td>".$row['telefon']."</td>".
            "<td>".$row['teilnehmeranzahl']."</td>".
            "<td>".$row['ankunftsort']."</td>".
            "<td>".$row['ankunftsdatum']."</td>".
            "<td>".$row['ankunftszeit']."</td>".
            "<td>".$row['abfahrtsort']."</td>".
            "<td>".$row['abfahrtsdatum']."</td>".
            "<td>".$row['abfahrtszeit']."</td>".
          "</tr>";
        }
        echo "</table>";

/*-----------Gesamt Anzahl der Teilnehmer Ausgeben-------------- */
        $row = $dbh->query($sqlFuerAnzahlTeilnehmer)->fetch();
        echo " <br>Anzahl von gesammten Teilnehmern: ".$row['total'];
        
        $dbh = null;
    
    }catch(PDOException $e){
        echo $e->getMessage();
    }
    }else{
        echo "Falsches Passwort";
    }    

} else {

/*------ Für Teilnehmer-------------------------*/
$sql1 = "select * from teilnehmer where email='$email' and passwort= '$passwort';";

try{

    $dbh = new PDO(
        "mysql:dbname=meditationscamp1; host=localhost",
        "root",
        ""
        );

    // echo "<h3> Verbindung erfolgreich hergestellt! <h3>" . ; 
    $result = $dbh->query($sql1);
    
/*------Für Teilnehmer Zum Aktualisieren--------------*/
    echo "<form action='Teilnehmer_Update.php' method='post'>";
    echo "<table style='width:70%;'>";
    $row = $result->fetch(); 
if (!$row) {   
    echo 'Keine Daten gefunden.Bitte überprüfen Sie Ihre E-Mail-Adresse.'.'<br>'.'Bitte versuchen Sie erneut.';
        }else{
        
    $Id = $row['ID'];
    $Vorname = $row['vorname'];
    $Nachname = $row['nachname'];
    $Geschlecht = $row['geschlecht'];
    $Geburtsdatum = $row['geburtsdatum'];
    $Stadt = $row['stadt'];
    $Land = $row['land'];
    $Telefon = $row['telefon'];
    $Email = $row['email'];
    $Passwort = $row['passwort'];
    $Teilnehmeranzahl = $row['teilnehmeranzahl'];

    /*------ Zweite Tabelle Aktualisieren--------------*/
    echo " <tr>";
    echo "   <td><input name='id' value='$Id' required hidden></td>";
    echo "  </tr>";
    
    echo " <tr>";
    echo "   <td>Vorname</td>";
    echo "   <td><input name='vorname' value='$Vorname' required></td>";
    echo "  </tr>";
    
    echo " <tr>";
    echo "   <td>Nachname</td>";
    echo "   <td><input name='nachname' value='$Nachname' required></td>";
    echo "  </tr>";
    
    echo " <tr>";
    echo "   <td>Geschlecht</td>";

    if($Geschlecht == "Mann"){
        echo "<td><input type='radio' name='geschlecht' value='Mann' checked='checked'> Mann 
        <input type='radio' name='geschlecht' value='Frau' > Frau 
      </td>";
    }
    else  if($Geschlecht == "Frau"){
        echo "<td><input type='radio' name='geschlecht' value='Mann' > Mann 
        <input type='radio' name='geschlecht' value='Frau' checked='checked'> Frau 
      </td>";
    }
    else{
        echo "<td><input type='radio' name='geschlecht' value='Mann' checked='checked'> Mann 
        <input type='radio' name='geschlecht' value='Frau' > Frau 
      </td>";
    }
    echo "  </tr>";
    
    echo " <tr>";
    echo "   <td>Geburtsdatum</td>";
    echo "   <td><input type ='date' name='geburtsdatum' value='$Geburtsdatum' required></td>";
    echo "  </tr>";
    
    echo " <tr>";
    echo "   <td>Stadt</td>";
    echo "   <td><input name='stadt' value='$Stadt' required></td>";
    echo "  </tr>";
    
    echo " <tr>";
    echo "   <td>Land</td>";
    echo "   <td><input name='land' value='$Land' required></td>";
    echo "  </tr>";
    
    echo " <tr>";
    echo "   <td>Telefon</td>";
    echo "   <td><input name='telefon' value='$Telefon' required></td>";
    echo "  </tr>";
    
    echo " <tr>";
    echo "   <td>Email</td>";
    echo "   <td><input name='email' value='$Email' required></td>";
    echo "  </tr>";

    echo " <tr>";
    echo "   <td>Passwort</td>";
    echo "   <td><input name='passwort' value='$passwort' required></td>";
    echo "  </tr>";
    
    echo " <tr>";
    echo "   <td>Teilnehmeranzahl</td>";
    echo "   <td><input name='teilnehmeranzahl' value='$Teilnehmeranzahl' required></td>";
    echo "  </tr>";


    $sql2 = "select * from reiseinfo where teilnehmerID='$Id';";

    $result = $dbh->query($sql2);

    $row = $result->fetch();

    if ($row) {
      $TeilnehmerID = $row['teilnehmerID'];
      $Ankunftsort = $row['ankunftsort'];
      $Ankunftsdatum = $row['ankunftsdatum'];
      $Ankunftszeit = $row['ankunftszeit'];
      $Abfahrtsort = $row['abfahrtsort'];
      $Abfahrtsdatum = $row['abfahrtsdatum'];
      $Abfahrtszeit = $row['abfahrtszeit'];
      $AnzahlNaechten = $row['anzahlNaechten'];
    }else{
      $TeilnehmerID = $Id;
      $Ankunftsort = '';
      $Ankunftsdatum = '';
      $Ankunftszeit = '';
      $Abfahrtsort = '';
      $Abfahrtsdatum = '';
      $Abfahrtszeit ='';
      $AnzahlNaechten = '';
    }

    echo "<tr>";
    echo"  <td>Ankunftsort</td>";
    if($Ankunftsort == "Flughafen"){
    echo"  <td><select name='ankunftsort'>  
          <option value='Flughafen' selected>Flughafen </option> 
          <option value='Hauptbahnhof'>Hauptbahnhof</option>
          </select>
       </td>";
    } else {
      echo"  <td><select name='ankunftsort'>  
            <option value='Flughafen' >Flughafen </option> 
            <option value='Hauptbahnhof' selected>Hauptbahnhof</option>
            </select>
        </td>";
    }
    echo"  </tr>";

    echo " <tr>";
    echo "   <td>Ankunftsdatum</td>";
    echo "   <td><input type ='date' name='ankunftsdatum' value='$Ankunftsdatum'></td>";
    echo "  </tr>";

    echo " <tr>";
    echo "   <td>Ankunftszeit</td>";
    echo "   <td><input name='ankunftszeit' value='$Ankunftszeit'></td>";
    echo "  </tr>";
/*---------------------------------------- */
  echo "<tr>";
    echo"  <td>Abfahrtsort</td>";
    if($Abfahrtsort == "Flughafen"){
    echo"  <td><select name='abfahrtsort'>   
          <option value='Flughafen' selected>Flughafen </option> 
          <option value='Hauptbahnhof'>Hauptbahnhof</option>
          </select>
       </td>";
    } else{
      echo"  <td><select name='abfahrtsort'>   
            <option value='Flughafen' > Flughafen </option> 
            <option value='Hauptbahnhof' selected>Hauptbahnhof</option>
            </select>
        </td>";
    }
    echo"  </tr>";
/*---------------------------------------- */

    echo " <tr>";
    echo "   <td>Abfahrtsdatum</td>";
    echo "   <td><input type ='date' name='abfahrtsdatum' value='$Abfahrtsdatum'></td>";
    echo "  </tr>";

    echo " <tr>";
    echo "   <td>Abfahrtszeit</td>";
    echo "   <td><input name='abfahrtszeit' value='$Abfahrtszeit'></td>";
    echo "  </tr>";

    echo " <tr>";
    echo "   <td>AnzahlNaechten</td>";
    echo "   <td><input name='anzahlNaechten' value='$AnzahlNaechten'></td>";
    echo "  </tr>";
    
    echo "</table>";

    echo "<p><input type='submit' value='Aktualisieren'>";

    echo "</form>";

/*------Teilnehmer Löschen--------------*/    
    echo "<form action='Teilnehmer_Delete.php' method='post' id='teilnehmer_delete'>";
    echo "<table style='width:70%;'>";
    echo " <tr>";
    echo "   <td><input name='id' value='$Id' required hidden></td>";
    echo "  </tr>";
    echo "</table>";
    echo "<input type='button' value='Absagen' onclick='confirmToDelete()'></p> ";
    echo "</form>";
    
    }
    $dbh = null;

}catch(PDOException $e){
    echo $e->getMessage();
}
}
?>

<br>
<br>
<a href = "javascript:history.back()"> Züruck</a>

</td></tr>
</table>

</body>
</html> 