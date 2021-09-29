<?php 

require_once "Conection.php";
require_once "Doctor.php";

class DoctorTransaction
{
    
     


    
    public static function addDoctor( $name, $email, $password, $CRM, $spec, $sector, $apTime )
    {
        
        try 
        {
            $database = Conection::load();
            $sql = "INSERT INTO DOCTOR ( name, password, crm, specialization, sector, role, appointment_time, email  ) values (?, ?,?, ?, ?,?,?,?)";
            $prepared = $database->prepare( $sql );
            $prepared->execute( [  $name, $password, $CRM, $spec, $sector, 2, intval( $apTime ), $email ] );
        }
        catch (\PDOException $e)
        {
            echo $e->getMessage()."\n".$e->getTraceAsString();
        }
        
    }

    public static function  getAll()
    {
        $database = Conection::load();
        $doctors = [];

        foreach ($database->query( 'SELECT * FROM DOCTOR order by id' ) as $key )
        {
            array_push( $doctors, new Doctor( $key['id'] ,  $key['name'], $key['email'], $key['crm'], $key['specialization'], $key['sector'], $key['password'], $key['appointment_time'] ) );
        }
        
        return $doctors;
    }

    public function exist( $email, $password )
    {
        $database = Conection::load();
        $isExistent =  $database->query( "Select * from Doctor where email = '$email' and password = '$password' " );

        if( $isExistent )
        {
            $doctor =  "";

            foreach( $isExistent as $key )
            {
                $doctor =new Doctor( $key['id'] , $key['name'], $key['email'], $key['crm'], $key['specialization'], $key['sector'], $key['password'], $key['appointment_time'] );
                
            }
            
            return $doctor;
        }

        return false;
    }

    public function delete( $id )
    {
        $database = Conection::load();
        try
        {
            $prepared = $database->prepare( "Select count( id) from medical_appointment where doctor_id = $id" );
            
            $prepared->execute();

            $result = $prepared->fetchAll();
            
            if( $result )
            {
                $database->exec( "Delete from medical_appointment where doctor_id = $id" );
            }

            $database->exec( "Delete from doctor where id = $id " );

            return true;
        }

        catch(\PDOException $e )
        {
           echo $e->getMessage();
            
        }
    }

    public function edit( $id )
    {
        $database = Conection::load();

        $prepared = $database->prepare( "select * from doctor where id = $id" );
        
        $prepared->execute();

        $result = $prepared->fetchAll();

        $doctor ="";
        foreach( $result as $key )
        {
            $doctor = new Doctor( 
                                    $key['id'], 
                                    $key['name'],
                                    $key['email'],
                                    $key['crm'],
                                    $key['specialization'],
                                    $key['sector'],
                                    $key['password'],
                                    $key['appointment_time'] 
                                );
        
        }

        return $doctor;
    }


    public function updateDoctor( $id , $name, $email, $password, $CRM, $spec, $sector, $apTime  )
    {
        try
        {
            $database = Conection::load();

            $prepared = $database->exec( "
                                            UPDATE DOCTOR 
                                            SET NAME = '$name', 
                                                EMAIL = '$email',
                                                PASSWORD = '$password',
                                                CRM = '$CRM',
                                                SPECIALIZATION = '$spec',
                                                SECTOR = '$sector',
                                                APPOINTMENT_TIME = '$apTime'
                                                WHERE ID = $id
                                        " );
                                   
                                        
            
        
        }

        catch( \PDOException $e )
        {
            echo $e->getMessage();
        }
    }
} 