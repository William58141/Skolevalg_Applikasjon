<?php
include("db1.php");
$db = new myPDO();
?>
<!DOCTYPE HTML>
<html lang="no">

<head>
  <meta charset="utf-8">
  <title>Valg</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" type="text/css" href="vis_informasjon.css">
  <link rel="stylesheet" type="text/css" href="stylesheet.css">
  <link rel="stylesheet" href="hamburgermenu.css">
</head>

<body>
<section class="beholder">
            <section class="full-vidde">
            </section>
            
            <nav id="navigasjon">
                 <label for="hamburger">&#9776;</label>
                <input type="checkbox" id="hamburger"/>

                
                <section id="meny">
                    <a href="default.php" class="active">Hjem</a>
                    <a href="registrering.php" class="active">Registrering</a>
                    <a href="vis_informasjonIkkeLogget.php" class="active">Vis informasjon</a>
                    <a href="logginn.php" class="active">Logg inn</a>
                </section>
           
            </nav>
            <h1>Vis Informasjon om valget</h1>
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
            
                            
                   
                <section style="clear: both;"></section>
            </section>
            <section class="full-vidde">
            <section class="footer"><p>Gruppe 24</p></section>
                <p class="footer"></p>
            </section>
        </section>
  
 
</body>


<!--Denne siden er utviklet av Hanne, siste gang endret 03.06.2021-->
</html>
