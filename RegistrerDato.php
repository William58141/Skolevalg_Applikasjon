<?php
include("startAdmin.php");
echo '<h4>Logget inn som ' .$_SESSION["epost"].'</h4>';

if($_SESSION['brukertype']!="2")
{
        header("location: logginn.php");          
}
?>

<?php
if(isset($_POST["nominasjonsKnapp"])){
$hostname='s381.usn.no';
$username='usr_valg';
$password='pw_valg2021';


$idvalg = $_POST['idvalg'];
$startforslag = $_POST['startforslag'];
$sluttforslag = $_POST['sluttforslag'];
$startvalg = $_POST['startvalg'];
$sluttvalg = $_POST['sluttvalg'];
$kontrollert = $_POST['kontrollert'];
$tittel = $_POST['tittel'];

try {
$dbh = new PDO("mysql:host=$hostname;dbname=valg2021",$username,$password);

$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$sql = "INSERT INTO valg (idvalg, startforslag, sluttforslag, startvalg, sluttvalg, kontrollert, tittel)
VALUES ('$idvalg','$startforslag','$sluttforslag','$startvalg','$sluttvalg','$kontrollert','$tittel');";

if ($dbh->query($sql)) {
echo "Informasjonen din er nå endret!";
}
else{
echo "Data ble ikke lagt inn i databasen";
}

$dbh = null;
}
catch(PDOException $e)
{
echo $e->getMessage();
}

}
?>

<html>

        <h1>Sett inn informasjon om valget</h1>
        <form class="form" action="" id="nominasjonsSkjema" name="nominasjonsSkjema" method="post">
        Idvalg<br /> <input name="idvalg" type="text" id="idvalg" required>  <br />
        Startforslag<br /> <input name="startforslag" type="datetime-local" id="startforslag" required>  <br />
        Sluttforslag<br /> <input name="sluttforslag" type="datetime-local" id="sluttforslag" required>  <br />
        Startvalg<br /> <input name="startvalg" type="datetime-local" id="startvalg" required>  <br />
        Sluttvalg<br /> <input name="sluttvalg" type="datetime-local" id="sluttvalg" required>  <br />
        Kontrollert<br /> <input name="kontrollert" type="datetime-local" id="kontrollert" required>  <br />
        Tittel<br /> <input name="tittel" type="text" id="tittel" required>  <br />
        <input type="submit" name="nominasjonsKnapp" value="Endre Informasjon">
        <input type="reset" name="nullstill" id="nullstill" value="Nullstill"> <br /> <br />
        </form>
                          
</html>
<?php
include("slutt.php");
?>
<!--Denne siden er utviklet av Bendik Borge Øttl, siste gang endret 06.04.2021-->
<!--Denne siden er kontrollert av Oskar Brekke Fuglem, siste gang endret 06.04.2021-->