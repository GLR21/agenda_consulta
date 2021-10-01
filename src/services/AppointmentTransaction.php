<?php

use \Conection as Conection;
require_once "Conection.php"; 
use \Appointment as Appointment;

class AppointmentTransaction
{

    public function addAppointment( $doctor_id, $patient_id , $start_at, $end_at, $treatment, $cost, $hasInsurance )
    {
        try
        {
            $database = Conection::load();
            $prepared = $database->prepare( "INSERT INTO MEDICAL_APPOINTMENT 
                                                ( 
                                                    DOCTOR_ID, 
                                                    PATIENT_ID, 
                                                    START_AT, 
                                                    END_AT, 
                                                    TREATMENT, 
                                                    COST, 
                                                    INSURANCE
                                                ) 
                                            
                                                 VALUES 
                                            
                                                ( 
                                                    $doctor_id , 
                                                    $patient_id ,  
                                                    '$start_at' , 
                                                    '$end_at' , 
                                                    '$treatment' , 
                                                    $cost, 
                                                    $hasInsurance 
                                                ) " 
                                            );
                                  
            $prepared->execute();
        }
        catch(\Exception $e)
        {
           echo $e->getMessage();
        }
    }

    public function getAll()
    {
        try
        {
            $database = Conection::load();

            $prepared = $database->prepare(  
                                            "Select 
                                                d.id as doc_id, 
                                                d.name as d_name, 
                                                p.id as pa_id , 
                                                p.name as p_name , 
                                                m.id as medid,
                                                m.start_at, 
                                                m.end_at,
                                                m.treatment,
                                                m.cost,
                                                i.accord,
                                                i.value 
                                            from patient p, doctor d,  medical_appointment m , insurance i 
                                            where 
                                                p.id = m.patient_id 
                                                and 
                                                d.id = m.doctor_id
                                                and 
                                                m.insurance = i.id
                                            ;" );
            $prepared->execute();

            $result = $prepared->fetchAll();
            $appointments = [];

            foreach( $result as $key )
            {
                array_push( 
                            $appointments , 
                            [   "ap_id"    => $key['medid'],
                                "doc_id"   => $key['doc_id'],
                                "doc_name" => $key['d_name'],
                                "pa_id"    => $key['pa_id'],
                                "pa_name"  => $key['p_name'],
                                "start"    => $key['start_at'],
                                "end"      => $key['end_at'],
                                "treatment"=> $key['treatment'],
                                "cost"     => $key['cost'],
                                "accord"   => $key['accord'],
                                "value"=> $key['value']
                            ]
                          );
            }
            
            return $appointments;
        }
        
        catch (\Exception $e)
        {
            echo $e->getMessage();
        }

    }


    public function delete( $id )
    {
        try
        {
            $database = Conection::load();


            $database->exec( "DELETE FROM MEDICAL_APPOINTMENT WHERE ID = $id" );
            return true;

        }
        catch( \Exception $e )
        {
            echo $e->getMessage();
            return false;
        }
    }

    public function get( $id )
    {

        $database = Conection::load();
        $prepared = $database->prepare(  
            "Select 
                d.id as doc_id, 
                d.name as d_name, 
                p.id as pa_id , 
                p.name as p_name , 
                m.id as medid,
                m.start_at, 
                m.end_at,
                m.treatment,
                m.cost,
                i.id as insurance_id,
                i.accord,
                i.value 
            from patient p, doctor d,  medical_appointment m , insurance i 
            where 
                p.id = m.patient_id 
                and 
                d.id = m.doctor_id
                and 
                m.insurance = i.id
            ;" );

        $prepared->execute();

        $appointments = [];

        foreach( $prepared->fetchAll() as $key )
        {
            array_push( $appointments, 
                                        [ 
                                            "ap_id"     => $key["medid"],
                                            "doc_id"    => $key['doc_id'],
                                            "pa_id"     => $key['pa_id'],
                                            "doc_name"  => $key['d_name'],
                                            "pa_name"   => $key['p_name'],
                                            "start"     => $key['start_at'],
                                            "end"       => $key['end_at'],
                                            "treatment" => $key['treatment'],
                                            "cost"      => $key['cost'],
                                            "accord"    => $key['accord'],
                                            "value"     => $key['value'],
                                            "i_id"      => $key['insurance_id']       
                                        ]
                      );
        }

        return $appointments;
    }


    public function update(  $id , $doctor_id, $patient_id, $start_at, $end_at, $treatment, $cost, $insurance  )
    {
        try
        {
            $database = Conection::load();
            
            $sql = "
            UPDATE
            MEDICAL_APPOINTMENT SET
                DOCTOR_ID = $doctor_id,
                PATIENT_ID = $patient_id,
                START_AT = '$start_at', 
                END_AT = '$end_at',
                COST = $cost,
                INSURANCE = $insurance
            ";

            if( isset( $treatment ) )
            {
                $sql.= " ,TREATMENT = $treatment ";                
            }
            
            $prepared = $database->prepare( $sql. " WHERE ID = $id" );
            
            $prepared->execute();

        }
        catch(\Exception $e )
        {
            echo $e->getMessage();
        }
    }
}