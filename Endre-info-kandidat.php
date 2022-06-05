<?php
include("startkandidat.php");
echo '<h4>Logget inn som ' .$_SESSION["bruker"].'</h4>';
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
            echo "Can access this page";
        } else {
            header("location:hovedKandidat.php"); 

        }
    } else {
        header("location:hovedKandidat.php");
    }
} catch (PDOException $e) {
    echo $e->getMessage();
}
// Denne delen, (linje 1-43) er utviklet av William Fosmark Haugland sist endret 03.06.2021
?>

<?php
if(isset($_POST["nominasjonsKnapp"])){
$hostname='s381.usn.no';
$username='usr_valg';
$password='pw_valg2021';


$bruker = $_POST['bruker'];
$fakultet = $_POST['fakultet'];
$institutt = $_POST['institutt'];
$informasjon = $_POST['informasjon'];

try {
$dbh = new PDO("mysql:host=$hostname;dbname=valg2021",$username,$password);

$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$sql = "UPDATE kandidat SET fakultet='$fakultet', institutt='$institutt',informasjon='$informasjon' WHERE bruker='$bruker';";

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

        <h1>Endre Informasjon for Kandidater</h1>
        <form class="form" action="" id="nominasjonsSkjema" name="nominasjonsSkjema" method="post">
        Ditt Brukernavn<br /> <input name="bruker" type="text" id="bruker" required value= "<?php echo $_SESSION['epost']; ?>" readonly> <br />
        Endre Fakultet<br /> <input name="fakultet" type="text" id="fakultet" required autofocus>  <br />
        Endre Institutt<br /> <input name="institutt" type="text" id="institutt" required>  <br />
        Endre Informasjon<br /> <input name="informasjon" type="text" id="informasjon" required>  <br />
        <input type="submit" name="nominasjonsKnapp" value="Endre Informasjon">
        <input type="reset" name="nullstill" id="nullstill" value="Nullstill"> <br /> <br />
        </form>
        <a href="php_upload.php" class="active">Trykk her for å laste opp bilde</a> <br /> <br />
                          
</html>
<?php
include("slutt.php");
?>
