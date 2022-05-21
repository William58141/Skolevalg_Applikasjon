<html>
<head>
    <html lang="no">
    <meta charset ="utf-8">
    <title>Utviklingsoppgave</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="stylesheet.css">
    <script language="javascript" src="sjekkepost.js"></script>
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
            
            <form class="form" method="post" action="" id="registrerStemmeSkjema" name="registrerStemmeSkjema">
                          <h1>Registrering</h1>
                          <form method="post" action="" id="registrerStemmeSkjema" name="registrerStemmeSkjema">
              <label>Epost:<br />         </label>     <input type="email" id="epost" name="epost" required autofocus /> <br/>
              <label>Fødselsdato <br />      </label>   <input type="date" id="fdato" name="fdato" required /> <br/>
              <label>Fornavn:<br />         </label>     <input type="text" id="fnavn" name="fnavn" required /> <br/>
              <label>Etternavn: <br />      </label>   <input type="text" id="etternavn" name="etternavn" required /> <br/>
              <label>Passord:<br />         </label>     <input type="password" id="passord" name="passord" required /> <br/>
                <input type ="hidden" name="brukertype" id="brukertype" value="1"> <br/>
              <input type="submit"value="Registrer bruker" id="registrerStemmeKnapp" name="registrerStemmeKnapp"  onclick="sjekk_usn();" />
              <input type="reset" value="Nullstill" id="nullstill" name="nullstill" /> <br />
              </form>
                    </section>
                </section>
                    
                   
                <section style="clear: both;"></section>
            </section>
            <section class="full-vidde">
            <section class="footer"><p>Gruppe 24</p></section>
                <p class="footer"></p>
            </section>
        </section>
    
    </body>
</html>
<?php
    $melding = "";
    if (isset($_POST['registrerStemmeKnapp'])) {
        if (!preg_match("/^(.)+@usn.no$/",$_POST['epost'])) {
            $melding = "Dette er en feil e-post adresse";
        }
        
    }
?>
<?php echo("<p style='color:maroon;'>".$melding."</p>"); ?>
<?php


if(isset($_POST["registrerStemmeKnapp"])){
$hostname='s381.usn.no';
$username='usr_valg';
$password='pw_valg2021';
$salt = "IT2_2021";
$bt = $_POST['brukertype'];
$epost = $_POST['epost'];
$fnavn = $_POST['fnavn'];
$fdato = $_POST['fdato'];
$enavn = $_POST['etternavn'];
$pass1 = $_POST['passord'];
$pass = sha1($salt.$pass1);
try {
$dbh = new PDO("mysql:host=$hostname;dbname=valg2021",$username,$password);
$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
$sql = "INSERT INTO bruker (brukertype, fnavn, enavn, fdato, epost, passord) VALUES  (:brukertype, :fnavn, :enavn, :fdato, :epost, :passord)";
$stmt = $dbh->prepare($sql);
$stmt->bindParam(':brukertype', $bt);
$stmt->bindParam(':fnavn', $fnavn);
$stmt->bindParam(':enavn', $enavn);
$stmt->bindParam(':fdato', $fdato);
$stmt->bindParam(':epost', $epost);
$stmt->bindParam(':passord', $pass);
$stmt->execute();

$dbh = null;
}
catch(PDOException $e)
{
echo $e->getMessage();
}

}
/* linje 61 til 67 og 71 til 73 er utviklet av: Oskar Brekke Fuglem Sist endret 10.12.2020 */
/* linje 80 til 103 er utviklet av: William Fosmark Haugland Sist endret 03.06.2021 */
?>


<!--Denne siden er utviklet av Bendik Borge Øttl, siste gang endret 15.10.2020-->
<!--Denne siden er kontrollert av William Fosmark Haugland, siste gang endret 15.10.2020-->
