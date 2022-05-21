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
  <link rel="stylesheet" type="text/css" href="vis_mer_kandidatinfo.css">
  <link rel="stylesheet" type="text/css" href="stylesheet.css">
</head>

<body>
  <h1>Vis kandidater</h1>

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
    $bruker = $_GET['bruker'];
    $sql = "select * from kandidat WHERE bruker='$bruker'";
    foreach ($db->query($sql) as $row) {
      $bruker = $row['bruker'];
      $linje = "<tr><td>" . $row['bruker'] . "</td>\n";
      $linje .= "<td>" . $row['fakultet'] . "</td>\n";
      $linje .= "<td>" . $row['institutt'] . "</td>\n";
      $linje .= "<td>" . $row['informasjon'] . "</td>\n";
	  $linje .= "<td>" . $row['stemmer'] . "</td>\n";
      $linje .= "</tr>\n
	  <br>
	  <br>
	  <br>";
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
<!--Denne siden er utviklet av Hanne , siste gang endret 03.06.2021-->
