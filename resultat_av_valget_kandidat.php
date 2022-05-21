<?php
include("startkandidat.php");
echo '<h4>Logget inn som ' .$_SESSION["epost"].'</h4>';
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
        if ($CurrentDate > $sluttvalg) { 
            echo "Du har tilgang til siden";
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
<!DOCTYPE HTML>
<html lang="no">

<head>
  <meta charset="utf-8">
  <title>Resultat av valget</title>
  <link rel="stylesheet" type="text/css" href="resultat_av_valget.css">
</head>

<body>
  <h1>Resultat av valget</h1>

  <form class="form" action="" id="" name="" method="GET">
        <input type="hidden" name="bruker" value="bruker">
        </form>
  <table class="table">

    <thead>
    <th class='p20'>Kandidat</th>
      <th class='p20'>Fakultet</th>
      <th class='p20'>institutt</th>
	  <th class='p20'>informasjon</th>
	  <th class='p20'>stemmer</th>
	 </thead>


   <tbody>
    
    <?php
    $sql = "SELECT * FROM kandidat WHERE stemmer=(select max(stemmer) from kandidat)";
    foreach ($db->query($sql) as $row) {
      $bruker = $row['bruker'];
      $linje = "<tr><td>" . $row['bruker'] . "</td>\n";
      $linje .= "<td>" . $row['fakultet'] . "</td>\n";
      $linje .= "<td>" . $row['institutt'] . "</td>\n";
      $linje .= "<td>" . $row['informasjon'] . "</td>\n";
	  $linje .= "<td>" . $row['stemmer'] . "</td>\n";
      $linje .= "</tr>\n";
      echo ($linje);
    }
    ?>

    </tbody>
  </table>
</body>

</html>

<?php
include("slutt.php")

?>
<!--Denne siden er utviklet av Oskar, siste gang endret 05.05.2021-->
<!--Denne siden er kontrollert av William Fosmark Haugland, siste gang endret 05.05.2021-->