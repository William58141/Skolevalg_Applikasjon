<?php
include("db1.php");
$db = new myPDO();

session_start();

@$innloggetBruker=$_SESSION["bruker"] || $_SESSION["brukertype"];
$bruker = $_SESSION["bruker"];

$sql = $db->prepare("SELECT * FROM kandidat WHERE bruker='$bruker' AND trukket IS NOT NULL");
$sql->execute();
$result = $sql->fetch(PDO::FETCH_ASSOC);

if (!$innloggetBruker)
{
    header ("location:logginn.php");
}

  elseif($_SESSION["brukertype"] == "2") { 
    header ("location:hovedAdmin.php");
}
    elseif($_SESSION["brukertype"] == "3") { 
        header ("location:hovedKontrollor.php");
}
    elseif($result) {
        header ("location:hoved.php");
    }

//linje 10 til 13 er utviklet av Oskar Brekke Fuglem sist endret 03.06.21
?>  



<html>
<head>
    <html lang="no">
    <meta charset ="utf-8">
    <title>Utviklingsoppgave</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
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
                    <a href="hovedKandidat.php" class="active" >Hjem</a>
                    <a href="Endre-info-kandidat.php" class="active">Endre informasjon</a>
                    <a href="trekkandidatur.php" class="active">Trekk kandidatur</a>
					<a href="vis_informasjonKandidat.php" class="active">Vis informasjon</a>
                    <a href="resultat_av_valget_kandidat.php" class="active">Resultat av valget</a>
                    <a href="php_upload.php" class="active">Last opp bilde</a>
                    <a href="endrepassordKandidat.php" class="active">Endre Passord</a>
                    <a href="utlogging.php" class="active">Logg ut</a>
                </section>
           
            </nav>
            
    
    </body>
</html>
<!--Denne siden er utviklet av Oskar, siste gang endret 05.03.2021-->
<!--Denne siden er kontrollert av William Fosmark Haugland, siste gang endret 06.03.2021-->