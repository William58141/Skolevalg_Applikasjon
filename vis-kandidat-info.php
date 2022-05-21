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
  <link rel="stylesheet" type="text/css" href="vis_kandidatinfo.css">
  <link rel="stylesheet" type="text/css" href="stylesheet.css">
</head>

<body>
  <h1>Vis kandidater</h1>
  <form class="form"></form>
  <table class="table">
    <thead>
      <th class='p20'>Kandidat</th>

	 </thead>


   <tbody>
    
    <?php
    $sql = "select * from kandidat";
    foreach ($db->query($sql) as $row) {
      $bruker = $row['bruker'];
      $linje = "<tr><td><a href='./vis_mer_kandidatinfo.php?bruker=$bruker'><button>Se mer informasjon</button></a><br>" . $row['bruker'] . "</td>\n";
      
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
<!--Denne siden er utviklet av Bendik, siste gang endret 03.06.2021-->
