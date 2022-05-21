<?php
include("start.php");
echo '<h4>logget inn som ' .$_SESSION["epost"].'</h4>';

?>
<?php
include("db1.php");
$db = new myPDO();
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
            header("location:hoved.php"); 

        }
    } else {
        header("location:hoved.php");
    }
} catch (PDOException $e) {
    echo $e->getMessage();
}
?>


<?php
if(isset($_POST["nominasjonsKnapp"])){
$hostname='s381.usn.no';
$username='usr_valg';
$password='pw_valg2021';

try {
$dbh = new PDO("mysql:host=$hostname;dbname=valg2021",$username,$password);

$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$sql = "INSERT INTO kandidat (bruker,fakultet, institutt, informasjon) 
VALUES ('".$_POST["bruker"]."','".$_POST["fakultet"]."','".$_POST["institutt"]."','".$_POST["informasjon"]."')";
if ($dbh->query($sql)){
    echo "</br>";
echo "Data ble lagt inn i databasen";
}
else {
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
$stmt = $pdo->query("SELECT bruker.epost FROM bruker left join kandidat ON kandidat.bruker = bruker.epost WHERE kandidat.trukket IS NULL AND kandidat.bruker IS NULL");
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

                        <h1>Nominering</h1>
                        <form class="form" action="" id="nominasjonsSkjema" name="nominasjonsSkjema" method="post">
                          Bruker <select name="bruker">
                                                                <?php echo $ops;?>
</select><br />
                          Fakultet <input name="fakultet" type="text" id="fakultet" required autofocus>  <br />
                          Institutt <input name="institutt" type="text" id="institutt" required>  <br />
                          Informasjon <input name="informasjon" type="text" id="informasjon" required>  <br />
                          <input type="submit" name="nominasjonsKnapp" id="nominer" value="Nominer">
                          <input type="reset" name="nullstill" id="nullstill" value="Nullstill"> <br /> <br />



</html>
<?php
include("slutt.php")

?>
<!--Denne siden er utviklet av Oskar Brekke Fuglem, siste gang endret 16.04.2021-->
<!--Denne siden er kontrollert av Bendik Borge Øttl, siste gang endret 06.04.2021-->
