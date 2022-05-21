<?php
include("startAdmin.php");
echo '<h4>Logget inn som ' .$_SESSION["epost"].'</h4>';

if($_SESSION['brukertype']!="2")
{
        header("Location: logginn.php");          
}
?>

<?php
if(isset($_POST["nominasjonsKnapp"])){
$hostname='s381.usn.no';
$username='usr_valg';
$password='pw_valg2021';


$epost = $_POST['epost'];
$brukertype = $_POST['brukertype'];


try {
$dbh = new PDO("mysql:host=$hostname;dbname=valg2021",$username,$password);

$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$sql = "UPDATE bruker SET brukertype='$brukertype' WHERE epost='$epost';";

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
$hostname='s381.usn.no';
$username='usr_valg';
$password='pw_valg2021';
try{
    $dbh = new PDO("mysql:host=$hostname;dbname=valg2021",$username,$password);

$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $ops='';
$pdo = new PDO("mysql:host=$hostname;dbname=valg2021",$username,$password);
$stmt = $pdo->query("SELECT bruker.epost FROM bruker left join kandidat ON kandidat.bruker = bruker.epost WHERE kandidat.bruker IS NULL");
//$stmt = $pdo->execute();
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $ops.= "<option value='" . $row['epost'] . "'>" . $row['epost'] . "</option>";
}
}
catch(PDOException $e)
{
echo $e->getMessage();
}
?>

<html>

        <h1>Utnevn bruker til kontrollør eller admin eller nedgrader til bruker</h1>
        <form class="form" action="" id="nominasjonsSkjema" name="nominasjonsSkjema" method="post">
        Bruker</br> <select name="epost">
                                                                <?php echo $ops;?>
</select><br />
        Brukertype <br /> <select id="brukertype" name="brukertype" required> <br />
              <option value="1">Bruker</option>
              <option value="2">Administrator</option>
              <option value="3">Kontrollør</option>
              </select><br>
        <input type="submit" name="nominasjonsKnapp" value="Utnevn">
        <input type="reset" name="nullstill" id="nullstill" value="Nullstill"> <br /> <br />
        </form>
        
</html>
<?php
include("slutt.php");
?>
<!--Denne siden er utviklet av William Fosmark Haugland, siste gang endret 03.06.2021-->