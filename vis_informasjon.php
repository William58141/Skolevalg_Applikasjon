<?php
include("start.php");
include("db1.php");
$db = new myPDO();
?>
<!DOCTYPE HTML>
<html lang="no">

<head>
  <meta charset="utf-8">
  <title>Valg</title>
  <link rel="stylesheet" type="text/css" href="vis_informasjon.css">
  <link rel="stylesheet" type="text/css" href="stylesheet.css">
</head>

<body>
  <h1>Informasjon om valget</h1>
  <table class="table">
    
    <thead>
      <th class='p20'>startforslag</th>
      <th class='p20'>sluttforslag</th>
	  <th class='p20'>startvalg</th>
	  <th class='p20'>sluttvalg</th>
	  <th class='p20'>kontrollert</th>
      <th class='p20'>tittel</th>
	 
    </thead>
    
    <tbody>
       
    <?php
    
    $sql = "select * from valg WHERE idvalg=1";
    foreach ($db->query($sql) as $row) {
      $linje = "<tr><td>" . $row['startforslag'] . "</td>\n";
      $linje .= "<td>" . $row['sluttforslag'] . "</td>\n";
      $linje .= "<td>" . $row['startvalg'] . "</td>\n";
	  $linje .= "<td>" . $row['sluttvalg'] . "</td>\n";
	  $linje .= "<td>" . $row['kontrollert'] . "</td>\n";
	  $linje .= "<td>" . $row['tittel'] . "</td>\n";
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
<!--Denne siden er utviklet av Oskar, siste gang endret 03.06.2021-->