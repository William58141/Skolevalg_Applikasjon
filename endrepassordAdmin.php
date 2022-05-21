<?php
include("startAdmin.php");
echo '<h4>Logget inn som ' .$_SESSION["epost"].'</h4>';
?>
<?php
if(isset($_POST["endrepassordKnapp"])){
$hostname='s381.usn.no';
$username='usr_valg';
$password='pw_valg2021';


$salt = "IT2_2021";
$epost = $_POST['epost'];
$passord = $_POST['passord'];
$passord = sha1($salt.$passord);

try {
$dbh = new PDO("mysql:host=$hostname;dbname=valg2021",$username,$password);

$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$sql = "UPDATE bruker SET passord='$passord' WHERE epost='$epost'";
if ($dbh->query($sql)) {
echo "Passordet ditt er nå endret!";
}
else{
echo "Data ble ikke registrert i databasen";
}

$dbh = null;
}
catch(PDOException $e)
{
echo $e->getMessage();
}

}
?>

<html>
            <form class="form" method="post" action="" id="endrePassordSkjema" name="endrePassordSkjema">
                          <h1>Endre Passord</h1>
                          <form method="post" action="" id="endrepassord" name="endrepassord">
              <label>Epost:<br />         </label>     <input type="text" id="epost" name="epost" required value= "<?php echo $_SESSION['epost']; ?>" readonly> <br/>
              <label>Nytt Passord<br />   </label>     <input type="password" id="passord" name="passord" required autofocus /> <br/>
              <!-- brukertype er for tiden synlig, det skal selvfølgelig ikke være mulig å velge dette i registrering -->
              <input type="submit"value="Endre Passord" id="Endre Passord" name="endrepassordKnapp" />
              <input type="reset" value="Nullstill" id="nullstill" name="nullstill" /> <br />
              </form>
            
   
    </body>
</html>

<?php

include("slutt.php");

?>
<!--Denne siden er utviklet av William Fosmark Haugland, siste gang endret 15.10.2020-->
<!--Denne siden er kontrollert av Hanne Visdal Bjørnson, siste gang endret 15.10.2020-->