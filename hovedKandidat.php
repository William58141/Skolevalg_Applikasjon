<?php
include("startkandidat.php");

echo '<h3>Velkommen til applikasjonen, du er logget inn som ' .$_SESSION["bruker"].'</h3>';

echo "</br>";


try {


        $hostname = 's381.usn.no';
        $username = 'usr_valg';
        $password = 'pw_valg2021';
    
        $db = new PDO("mysql:host=$hostname;dbname=valg2021", $username, $password);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $stmt = $db ->prepare("SELECT * FROM bilde WHERE hvor = '" . $_SESSION["bruker"] . "' LIMIT 1");
        $stmt->execute();
        if($stmt->rowCount()>0)
        {
            while($row = $stmt->fetch(PDO::FETCH_ASSOC))
            {
                extract($row);
                echo "Her er bildet du lastet opp";
                echo "</br>";
                echo "<img src='katalog/".$row['alt']."'/>";
                echo "</br>";
            }
        }
        
}
catch (PDOException $e) {
    echo $e->getMessage();
}



include("slutt.php");
// Denne siden er utviklet av: William Fosmark Haugland Sist endret 03.06.2021
?>  