<?php

include "Database.php";
     
class Conection
{
        public static function load()
        {
            $xml = simplexml_load_file( '../../config/config.xml' );
            $con = new Database(  $xml->database, $xml->user, $xml->password, $xml->host, $xml->port  );
            return $con->getCon();
        }
}



    
        
      