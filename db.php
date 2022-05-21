<?php
class mysqlPDO extends PDO {
  public function __construct() {
    $drv = 'mysql';
    $hst = 's381.usn.no';
    $usr = 'usr_valg';
    $pwd = 'pw_valg2021';
    $sch = 'valg2021';
    $dsn = $drv . ':host=' . $hst . ';dbname=' . $sch;
  parent::__construct($dsn,$usr,$pwd);
  }
}
$db = new mysqlPDO();

/* Denne siden er utviklet av: William Fosmark Haugland Sist endret 10.12.2020 */
?>

