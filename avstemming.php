<?php
include("start.php");
echo '<h4>logget inn som ' . $_SESSION["epost"] . '</h4>';

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
    $DateBegin = 'startvalg';
    $DateEnd = 'sluttvalg';
    $sql = "SELECT * FROM valg WHERE idvalg='1'"; 
    $stmt = $db->prepare($sql);
    $stmt->execute();
    $valgRow = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($stmt->rowCount() >= 1) { 
        $dateFormatting = 'Y-m-d h:i:s'; 
        $CurrentDate = date($dateFormatting);
        $CurrentDate = date($dateFormatting, strtotime($CurrentDate)); 

        $startvalg = $valgRow['startvalg'];
        $sluttvalg = $valgRow['sluttvalg']; 

        $startvalg = date($dateFormatting, strtotime($startvalg)); 
        $sluttvalg = date($dateFormatting, strtotime($sluttvalg));
        if (($CurrentDate >= $startvalg) && ($CurrentDate <= $sluttvalg)) { 
            echo "Can access this page";
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
if(isset($_POST["stemmeKnapp"])){
$hostname='s381.usn.no';
$username='usr_valg';
$password='pw_valg2021';

$loginnBruker = $_SESSION["epost"];
$bruker = $_POST['bruker'];

try {
$dbh = new PDO("mysql:host=$hostname;dbname=valg2021",$username,$password);
$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$sql = "UPDATE bruker  SET stemme='$bruker' WHERE epost='$loginnBruker';";

if ($dbh->query($sql)) {
echo "Du har stemt på $bruker";
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
if(isset($_POST["stemmeKnapp"])){
        $hostname='s381.usn.no';
        $username='usr_valg';
        $password='pw_valg2021';
        
        $bruker = $_POST['bruker'];
        
        try {
        $dbh = new PDO("mysql:host=$hostname;dbname=valg2021",$username,$password);
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "UPDATE kandidat SET stemmer = (SELECT COUNT(stemme) FROM bruker WHERE bruker.stemme = kandidat.bruker);";
        if ($dbh->query($sql)) {
                
        }
        
        $dbh = null;
        }
        catch(PDOException $e)
        {
        echo $e->getMessage();
        }
        }
        // linje 85 til 90 er utviklet av Oskar Brekke Fuglem
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
$stmt = $pdo->query("SELECT * from kandidat WHERE trukket IS NULL");
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $ops.= "<option value='" . $row['bruker'] . "'>" . $row['bruker'] . "</option>";
}
}
catch(PDOException $e)
{
echo $e->getMessage();
}
?>

<html>

<h1>Avstemming</h1>
<form class="form" action="" id="stemmeSkjema" name="stemmeSkjema" method="post">
    Velg bruker du ønsker å stemme på <select name="bruker">
                                                                <?php echo $ops;?>
</select><br />
    <input type="submit" name="stemmeKnapp" id="stem" value="Stem">
    <input type="hidden" name="DateBegin" id="DateBegin" value="Stem">
    <input type="hidden" name="DateEnd" id="DateEnd" value="Stem">
    <input type="reset" name="nullstill" id="nullstill" value="Nullstill"> <br /> <br />

    <?php
    include("slutt.php")

    ?>
    <!--Denne siden er utviklet av Oskar Brekke Fuglem, siste gang endret 03.06.2021-->
    <!--Denne siden er kontrollert av Bendik Borge Øttl, siste gang endret 11.12.2020-->

    <!--Denne siden er videreutviklet av Hanne Bjørnson, siste gang endret 05.02.2021-->