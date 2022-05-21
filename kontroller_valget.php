<?php
include("startKontrollor.php");
echo '<h4>Logget inn som ' .$_SESSION["epost"].'</h4>';
include("db1.php");
$db = new myPDO();
?>
<?php
if(isset($_POST["kontrollerKnapp"])){
$hostname='s381.usn.no';
$username='usr_valg';
$password='pw_valg2021';
try {
    $dbh = new PDO("mysql:host=$hostname;dbname=valg2021",$username,$password);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $date = date('Y-m-d h:i:s');
    $sql = "UPDATE valg SET kontrollert = '$date' WHERE idvalg=1";
    
    if ($dbh->query($sql)) {
    echo "Valget er kontrollert!";
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

        <h1>Bekreft at valget er kontrollert</h1>
        <form class="form" action="" id="kontrollerSkjema" name="kontrollerSkjema" method="post">
        <input type="submit" name="kontrollerKnapp" id="kontrollerKnapp" value="Kontroller Valget">



</html>

<?php
include("slutt.php")
// Denne siden er utviklet av: William Fosmark Haugland Sist endret 01.06.2021
?>