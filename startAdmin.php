<?php
session_start();
@$innloggetBruker=$_SESSION["epost"] || $_SESSION["brukertype"];

if (!$innloggetBruker)
{
    header ("location:logginn.php");
}
elseif($_SESSION["brukertype"] == "3") { 
    header ("location:hovedKontrollor.php");
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
                    <a href="hovedAdmin.php" class="active" >Hjem</a>
					<a href="vis_informasjonAdmin.php" class="active">Vis informasjon</a>
                    <a href="EndreDato.php" class="active">Endre Valg</a>
                    <a href="utnevning.php" class="active">Utnevning</a>
                    <a href="resultat_av_valget_admin.php" class="active">Resultat av valget</a>
                    <a href="endrepassordAdmin.php" class="active">Endre Passord</a>
                    <a href="utlogging.php" class="active">Logg ut</a>
                </section>
           
            </nav>
            
    
    </body>
</html>
<!--Denne siden er utviklet av Bendik Borge Øttl, siste gang endret 15.10.2020-->
<!--Denne siden er kontrollert av William Fosmark Haugland, siste gang endret 15.10.2020-->