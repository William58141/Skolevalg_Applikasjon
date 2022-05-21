<!DOCTYPE html>
<html>
<head>
    <html lang="no">
    <meta charset ="utf-8">
    <title>Innlogging</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="innlogging.css">
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
            
            <h1>Innlogging</h1>
            <form action ="" method="POST">

            
        
            
        <section class="tekstboks">
            <input type ="email" placeholder="Brukernavn" value="" id="epost" name="epost" autofocus>
        </section>

        <section class="tekstboks">
            <input type ="password" placeholder="Passord" value="" id="passord" name="passord">
        </section>

        <input type="submit" class="knapp" name="knapp"  value="Logg inn">
    
   </section>      
   </form>
                    </section>
                </section>
                    
                <section style="clear: both;"></section>
            </section>
            <section class="full-vidde">
            <section class="footer"><p>Gruppe 24</p></section>
            </section>
        </section>
    
    </body>
</html>

<?php
    session_start();
    include ("db.php");
    $salt = "IT2_2021";
    if (isset($_POST['knapp']) and $_POST['knapp']=="Logg inn") {
      $password = $_POST['passord'];
      $password = sha1($salt.$password);
      $sql = "select * from bruker where epost=:br";
      $sql.= " and passord='".$password."'";
      $stmt = $db->prepare($sql);
      $stmt->bindParam(':br',$epost);
      $epost = $_POST['epost'];
      if (!$epost)
      echo("SQL er: ".$sql."<br />");
      $stmt->execute();
      $userRow=$stmt->fetch(PDO::FETCH_ASSOC);
      if ($stmt->rowCount()== 1) {
        $epost = $userRow['epost'];
        $brukertype = $userRow['brukertype'];
		$_SESSION['bruker']=$epost;
		$_SESSION['epost'] = $epost;
		$_SESSION['brukertype'] = $brukertype;

            
		
        if($brukertype=="1") {
            $searchKandidatTableSql = "select * from kandidat where bruker=:br";
            $searchStmt = $db->prepare($searchKandidatTableSql); 
			$searchStmt->bindParam(':br', $epost); 
			$searchStmt->execute(); 
			$searchRow=$stmt->fetch(PDO::FETCH_ASSOC); 
			if ($searchStmt->rowCount() ==1) { 
               
				header("location:hovedKandidat.php");
			} else {
				
				header("location:hoved.php");
			}
        } else {
			
			if($brukertype == "2") {
				
				header("location:hovedAdmin.php");
			} else if($brukertype == "3") {
				
				header("location:hovedKontrollor.php");
			}
		}
      } else {
          echo ("Feil brukernavn eller passord");
      }
    }    

   
?>
<!--Denne siden er utviklet av William Fosmark Haugland, siste gang endret 01.06.2021-->

