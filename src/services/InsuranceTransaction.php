<?php

use \Conection as Conection;
use \Insurance as Insurance;

require_once "Conection.php";
require_once "Insurance.php";


class InsuranceTransaction
{
    public function getAll()
    {

        try
        {
            $database = Conection::load();

            $prepared = $database->prepare( "Select * from insurance " );

            $prepared->execute();

            $insurances = [];

            foreach( $prepared->fetchAll()  as $key )
            {
                array_push( $insurances,  new Insurance( $key['id'], $key['accord'], $key['value'] )  );
            }


            return $insurances;
        }
        catch(\Exception $e )
        {
            echo $e->getMessage();
        }
            
    }
}