<?php
include("startKontrollor.php");
echo '<h4>Logget inn som ' .$_SESSION["epost"].'</h4>';
include("db1.php");
$db = new myPDO();
?>
<!DOCTYPE HTML>
<html lang="no">

<head>
  <meta charset="utf-8">
  <title>Kandidater</title>
  <link rel="stylesheet" type="text/css" href="vis_datakonsistens.css">
</head>

<body>
  <h1>Vis datakonsistens hos kandidatene</h1>

  <form class="form" action="" id="" name="" method="GET">
        </form>

  <table class="table">
  <thead>
      <th class='p20'>Bruker</th>
      <th class='p20'>stemmer</th>
      <th class='p20'>stemme</th>
	  <th class='p20'>trukket</th>
	 
    </thead>



<tbody>

<?php
$sql = "SELECT * FROM kandidat LEFT JOIN bruker ON kandidat.bruker = bruker.epost";
foreach ($db->query($sql) as $row) {
  $bruker = $row['bruker'];
  $epost = $row['epost'];
  $linje = "<tr><td>" . $row['bruker'] . "</td>\n";
  $linje .= "<td>" . $row['stemmer'] . "</td>\n";
  $linje .= "<td>" . $row['trukket'] . "</td>\n";
  $linje .= "<td>" . $row['stemme'] . "</td>\n";
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
// Denne siden er utviklet av: William Fosmark Haugland Sist endret 01.06.2021
?>