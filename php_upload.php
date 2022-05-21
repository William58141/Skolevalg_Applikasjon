<?php
include("startkandidat.php");
echo '<h4>logget inn som ' . $_SESSION["bruker"] . '</h4>';

$target_path = "katalog/";

@$target_path = $target_path . basename($_FILES['uploadedfile']['name']);
@$_FILES['uploadedfile']['tmp_name'];

if (move_uploaded_file(@$_FILES['uploadedfile']['tmp_name'], $target_path)) {
  $melding = "The file " .  basename($_FILES['uploadedfile']['name']) .
    " has been uploaded";


  if (isset($_POST["uploadedfileKnapp"])) {
    $hostname = 's381.usn.no';
    $username = 'usr_valg';
    $password = 'pw_valg2021';

    try {
      $dbh = new PDO("mysql:host=$hostname;dbname=valg2021", $username, $password);

      $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $sql = "INSERT INTO bilde (hvor, tekst, alt)
    VALUES ('" . $_SESSION["bruker"] . "','" . $target_path . "','" . $_FILES['uploadedfile']['name'] . "')";
      if ($dbh->query($sql)) {
        echo "Ny rad satt inn i databasen";
        echo "</br>";
      } else {
        echo "Data ble ikke lagt inn i databasen";
      }

      $sql2 = "SELECT * from bilde WHERE tekst='" . $target_path . "' AND hvor='" . $_SESSION["bruker"] . "' limit 1";
      $stmt = $dbh->prepare($sql2);
      $stmt->execute();
      $bildeRow = $stmt->fetch(PDO::FETCH_ASSOC);
      if ($stmt->rowCount() == 1) {
        $bildeid = $bildeRow["idbilde"];
        $sql3 = "UPDATE kandidat SET bilde = $bildeid WHERE bruker = '" . $_SESSION["bruker"] . "'";
        $stmt2 = $dbh->prepare($sql3);
        $stmt2->execute();
        echo "</br>";
      } else {
        echo "Data ble ikke funnet i databasen";
      }

      $dbh = null;
    } catch (PDOException $e) {
      echo $e->getMessage();
    }
  }
} else {
  // Feilmelding 
  $melding = "Du har ikke valgt et bilde enda!";
}

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

        }
    } else {
        header("location:hovedKandidat.php");
    }
} catch (PDOException $e) {
    echo $e->getMessage();
}
?>
<!DOCTYPE HTML>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Fil lastet opp</title>
</head>

<body>
  <h1>Last opp bilde</h1>
  <form class="form" enctype="multipart/form-data" action="" method="POST">
    <input type="hidden" name="MAX_FILE_SIZE" value="50000"/>
    Velg bilde som skal lastes opp:<br /> <br />
    <input name="uploadedfile" type="file" id="uploadedfile" /><br />
    <input type="submit" id="uploadedfileKnapp" name="uploadedfileKnapp" />
  </form>

  <?php
  echo ("<img src='katalog/" . basename(@$_FILES['uploadedfile']['name']) . "'>");
  echo $melding;
  ?>
</body>

</html>

<?php
include("slutt.php");

?>
<!--Denne siden er utviklet av Bendik Borge Øttl, siste gang endret 06.04.2021-->
<!--Denne siden er kontrollert av William Fosmark, siste gang endret 06.04.2021-->