<?php
include("startKontrollor.php");
include("db1.php");
$db = new myPDO();
?>
<!DOCTYPE HTML>
<html lang="no">

<head>
  <meta charset="utf-8">
  <title>Brukere</title>
  <link rel="stylesheet" type="text/css" href="vis_brukerinfo.css">
  <link rel="stylesheet" type="text/css" href="stylesheet.css">
</head>

<body>
  <h1>Vis brukere</h1>
  <table class="table">

    <thead>
     
      <th class='p20'>Epost</th>

      
	 
	 </thead>


   <tbody>
    
    <?php
    $sql = "select * from bruker";
    foreach ($db->query($sql) as $row) {
      $epost = $row['epost'];
      $linje = "<tr><td><a href='./vis_mer_brukerinfo.php?epost=$epost'><button>Se mer informasjon</button></a><br>" . $row['epost'] . "</td>\n";

	    
	    
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
<!--Denne siden er utviklet av William, siste gang endret 03.06.2021-->
