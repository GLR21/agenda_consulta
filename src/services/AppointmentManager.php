<?php

use AppointmentTransaction as AppointmentTransaction;
require_once "AppointmentTransaction.php"; 

class AppointmentManager
{

    private $appointments;
    /**
     * Class constructor.
     */
    public function __construct( Appointment $appointment = null , $action = null )
    {
        $this->doAction( $appointment , $action );    
    }


    public function doAction( Appointment $appointment = null, $action = null )
    {

        $transaction =""; 

        switch( $action )
        {
            case "add":
                $transaction =  new AppointmentTransaction();
                $transaction->addAppointment( 
                                                $appointment->getDocId(), 
                                                $appointment->getPatientId(), 
                                                $appointment->getStartAt(),
                                                $appointment->getEndAt(),
                                                $appointment->getTreatment(),
                                                $appointment->getTreatment(),
                                                $appointment->hasInsurance() 
                                            );
            break;

            case "getAll": 
                $transaction = new AppointmentTransaction();
                $this->appointments = $transaction->getAll();
            break;
        }
    }

    public function getAll()
    {
        return $this->appointments;
    }
}

