<?php
session_start();
@$innloggetBruker=$_SESSION["epost"] || $_SESSION["brukertype"];

if (!$innloggetBruker)
{
    header ("location:logginn.php");

    
}
elseif($_SESSION["brukertype"] == "2") { 
    header ("location:hovedAdmin.php");
}
elseif($_SESSION["brukertype"] == "1") { 
    header ("location:hoved.php");
}
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
                    <a href="hovedKontrollor.php" class="active" >Hjem</a>
					<a href="vis_informasjonKontrollor.php" class="active">Vis informasjon om valget</a>
                    <a href="Kontrollor_vis_datakonsistens.php" class="active">Vis konsistens i data</a>
                    <a href="vis-kandidat-info.php" class="active">Vis mer info kandidat</a>
                    <a href="resultat_av_valget.php" class="active">Resultat av valget</a>
                    <a href="kontroller_valget.php" class="active">Bekreft kontroll</a>
                    <a href="endrepassordKontrollor.php" class="active">Endre Passord</a>
                    <a href="utlogging.php" class="active">Logg ut</a>
                </section>
           
            </nav>
            
    
    </body>
</html>
<!--Denne siden er utviklet av Bendik Borge Øttl, siste gang endret 01.04.2021-->
<!--Denne siden er kontrollert av Hanne, siste gang endret 05.04.2021-->