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

    elseif($_SESSION["brukertype"] == "3") { 
        header ("location:hovedKontrollor.php");
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
                    <a href="hoved.php" class="active" >Hjem</a>
                    <a href="avstemming.php" class="active">Avstemming</a>
                    <a href="nominering.php" class="active">Nominering</a>
					<a href="vis_informasjon.php" class="active">Vis informasjon om valget</a>
                    <a href="resultat_av_valget_bruker.php" class="active">Resultat av valget</a>
                    <a href="endrepassord.php" class="active">Endre Passord</a>
                    <a href="utlogging.php" class="active">Logg ut</a>
                </section>
           
            </nav>
            
    
    </body>
</html>
<!--Denne siden er utviklet av Hanne, siste gang endret 15.10.2020-->
<!--Denne siden er kontrollert av Oskar, siste gang endret 15.10.2020-->