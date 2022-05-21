<?php
include("startAdmin.php");
echo '<h4>Logget inn som ' .$_SESSION["epost"].'</h4>';
include("db1.php");
$db = new myPDO();
?>
<!DOCTYPE HTML>
<html lang="no">

<head>
  <meta charset="utf-8">
  <title>Kandidater</title>
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
<!--Denne siden er utviklet av Hanne, siste gang endret 02.05.2021-->
<!--Denne siden er kontrollert av Bendik, siste gang endret 05.05.2021-->