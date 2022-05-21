<?php
include("startkandidat.php");
echo '<h4>logget inn som ' .$_SESSION["bruker"].'</h4>';
?>

<?php
try {
    $hostname = 's381.usn.no';
    $username = 'usr_valg';
    $password = 'pw_valg2021';

    $db = new PDO("mysql:host=$hostname;dbname=valg2021", $username, $password);

    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $DateBegin = 'startforslag';
    $DateEnd = 'sluttforslag';
    $sql = "SELECT * FROM valg WHERE idvalg='1'"; 
    $stmt = $db->prepare($sql);
    $stmt->execute();
    $valgRow = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($stmt->rowCount() >= 1) { 
        $dateFormatting = 'Y-m-d h:i:s'; 
        $CurrentDate = date($dateFormatting);
        $CurrentDate = date($dateFormatting, strtotime($CurrentDate)); 

        $startforslag = $valgRow['startforslag'];
        $sluttforslag = $valgRow['sluttforslag']; 

        $startforslag = date($dateFormatting, strtotime($startforslag)); 
        $sluttforslag = date($dateFormatting, strtotime($sluttforslag));
        if (($CurrentDate >= $startforslag) && ($CurrentDate <= $sluttforslag)) { 
            echo "Du har foreløpig tilgang til denne siden";
        } else {
            header("location:hovedKandidat.php"); 
            echo "Du har ikke tilgang til denne siden akkurat nå";
        }
    } else {
        header("location:hovedKandidat.php");
    }
} catch (PDOException $e) {
    echo $e->getMessage();
}
?>
<?php
if(isset($_POST["trekkandidaturKnapp"])){
$hostname='s381.usn.no';
$username='usr_valg';
$password='pw_valg2021';
$bruker = $_POST['bruker'];

try {
    
$dbh = new PDO("mysql:host=$hostname;dbname=valg2021",$username,$password);

$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$sql = "DELETE FROM kandidat WHERE bruker='$bruker'; VALUES ('".$_POST["bruker"]."')";
if (!empty($_POST['NeiNominer'])) {
 $sql = "UPDATE kandidat SET trukket = 'N' WHERE bruker='$bruker';";
 echo "</br> </br> Du er nå slettet som kandidat og vil ikke kunne nomineres igjen.";
 $dbh->query($sql);
}
elseif ($dbh->query($sql)){
    echo "</br> </br>";
    echo "Du er nå slettet som kandidat!";
}
else {
echo "Data ble ikke registrert i databasen";
}
/* linje 12 til 38 er utviklet av: William Fosmark Haugland Sist endret 01.04.2021 */
/* linje 57 til 60 er utviklet av Oskar Brekke Fuglem Sist endret 03.06.2021*/
$dbh = null;

}
catch(PDOException $e)
{
echo $e->getMessage();
}

}
?>

<?php
if(isset($_POST['team']))
{
	foreach($_POST['team'] as $value){
		$insert= ("INSERT INTO kandidat ('trukket') VALUES ('$value')");
	}
}
?>

<html>
            <form class="form" method="post" action="" id="trekkanindaturSkjema" name="trekkandidaturSkjema">
                          <h1>Trekk kandidatur</h1>
              <form method="post" action="" id="trekkandidatur" name="trekkandidatur">
              <label>Epost:<br />         </label>     <input type="text" name="bruker" value= "<?php echo $_SESSION['epost']; ?>" readonly> <br/>
			  
              <input type="submit"value="Trekk kandidatur" id="Trekk kandidatur" name="trekkandidaturKnapp" />
              <input type="reset" value="Nullstill" id="nullstill" name="nullstill" /> <br />
              Ønsker ikke å bli nominert igjen <input type="checkbox" value="N" id="NeiNominer" name="NeiNominer" /> <br />
              </form>
            
    </body>
</html>

<?php

include("slutt.php");

?>
<!--Denne siden er utviklet av William Fosmark Haugland, siste gang endret 03.06.2021-->
<!--Denne siden er kontrollert av Hanne, siste gang endret 03.06.2021-->