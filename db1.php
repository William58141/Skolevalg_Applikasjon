<?php
class myPDO extends PDO {
    public function __construct() {
      $settings = parse_ini_file('setting.ini',TRUE);
      if (!$settings) throw new exception('Får ikke åpnet ini-fil.');
      $drv = $settings['database']['driver'];
      $hst = $settings['database']['host'];
      $sch = $settings['database']['schema'];
      $usr = $settings['database']['username'];
      $pwd = $settings['database']['password'];
      $dns = $drv . ':host=' . $hst . ';dbname=' . $sch;
      parent::__construct($dns,$usr,$pwd);     
    }         
  }
?>
