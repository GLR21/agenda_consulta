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
            $prepared = $database->prepare( "INSERT INTO MEDICAL_APPOINTMENT ( DOCTOR_ID, PATIENT_ID, START_AT, END_AT, TREATMENT, COST, HASINSURANCE) VALUES ( $doctor_id , $patient_id ,  $start_at , $end_at , $treatment , $cost  , $hasInsurance ) " );
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
                                                m.start_at, 
                                                m.end_at,
                                                m.treatment,
                                                m.cost,
                                                m.hasinsurance as insurance
                                            from patient p, doctor d,  medical_appointment m 
                                            where 
                                                p.id = m.patient_id 
                                                and 
                                                d.id = m.doctor_id
                                            ;" );
            $prepared->execute();

            $result = $prepared->fetchAll();
            $appointments = [];

            foreach( $result as $key )
            {
                array_push( 
                            $appointments , 
                            [
                                "doc_id"   => $key['doc_id'],
                                "doc_name" => $key['d_name'],
                                "pa_id"    => $key['pa_id'],
                                "pa_name"  => $key['p_name'],
                                "start"    => $key['start_at'],
                                "end"      => $key['end_at'],
                                "treatment"=> $key['treatment'],
                                "cost"     => $key['cost'],
                                "insurance"=> $key['insurance']
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
}