<?php
include("startAdmin.php");
echo '<h4>Logget inn som ' .$_SESSION["epost"].'</h4>';
include("db1.php");
$db = new myPDO();
if($_SESSION['brukertype']!="2")
{
        header("location:logginn.php");
}

?>

<?php
if(isset($_POST["nominasjonsKnapp"])){
$hostname='s381.usn.no';
$username='usr_valg';
$password='pw_valg2021';


$startforslag = $_POST['startforslag'];
$sluttforslag = $_POST['sluttforslag'];
$startvalg = $_POST['startvalg'];
$sluttvalg = $_POST['sluttvalg'];
$kontrollert = $_POST['kontrollert'];
$tittel = $_POST['tittel'];

try {
$dbh = new PDO("mysql:host=$hostname;dbname=valg2021",$username,$password);

$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$sql = "UPDATE valg SET startforslag='$startforslag', sluttforslag='$sluttforslag',startvalg='$startvalg',sluttvalg='$sluttvalg',kontrollert='$kontrollert',tittel='$tittel' WHERE idvalg='1' and '$startforslag' < sluttforslag and '$startvalg' < sluttvalg;";
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
<?php
    
    $sql = "select * from valg WHERE idvalg = 1";
    foreach ($db->query($sql) as $row) {
      $linje = $row['startforslag'];
      $linje =  $row['sluttforslag'];
      $linje = $row['idvalg'];
      $linje = $row['startvalg'];
	  $linje = $row['sluttvalg'];
	  $linje = $row['kontrollert'];
	  $linje = $row['tittel'];
    }


    
    ?>

<html>

        <h1>Endre informasjon om valget</h1>
        <form class="form" action="" id="nominasjonsSkjema" name="nominasjonsSkjema" method="post">
        <input name="idvalg" type="hidden" id="idvalg" value="1">
        Startforslag<br/> <input name="startforslag" type="text" id="startforslag" value="<?php echo $row["startforslag"]; ?>" required autofocus>  <br />
        Sluttforslag<br/> <input name="sluttforslag" type="text" id="sluttforslag" value="<?php echo $row["sluttforslag"]; ?>" required>  <br />
        Startvalg<br/> <input name="startvalg" type="text" id="startvalg" value="<?php echo $row["startvalg"]; ?>" required>  <br />
        Sluttvalg<br/> <input name="sluttvalg" type="text" id="sluttvalg" value="<?php echo $row["sluttvalg"]; ?>" required>  <br />
        Kontrollert<br/> <input name="kontrollert" type="text" id="kontrollert" value="<?php echo $row["kontrollert"]; ?>" required>  <br />
        Tittel<br/> <input name="tittel" type="text" id="tittel" value="<?php echo $row["tittel"]; ?>"  required>  <br />
        <input type="submit" name="nominasjonsKnapp" value="Endre Informasjon">
        <input type="reset" name="nullstill" id="nullstill" value="Nullstill"> <br /> <br />
        </form>
                          
</html>
<?php
include("slutt.php");
?>

<!-- Denne siden er utviklet av William Fosmark Haugland sist gang endret 01.06.2021-->
<!-- Denne siden er Kontrollert av Hanne Visdal Bjørnson sist gang endret 02.06.2021-->