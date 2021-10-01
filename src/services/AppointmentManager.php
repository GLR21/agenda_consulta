<?php

use AppointmentTransaction as AppointmentTransaction;
require_once "AppointmentTransaction.php"; 

class AppointmentManager
{

    private $appointments;
    private $edit;
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
                                                $appointment->getCost(),
                                                $appointment->hasInsurance() 
                                            );
            break;

            case "getAll": 
                $transaction = new AppointmentTransaction();
                $this->appointments = $transaction->getAll();
            break;

            case "delete":
                $transaction = new AppointmentTransaction();
                $this->deleted = $transaction->delete( $appointment->getId() );
                break;
            case "edit":
                $transaction = new AppointmentTransaction();
                $this->edit = $transaction->get( $appointment->getId() );
            break;

            case "editable":
                $transaction = new AppointmentTransaction();
                $this->updated = $transaction->update( 
                                                        $appointment->getId() ,
                                                        $appointment->getDocId(), 
                                                        $appointment->getPatientId(), 
                                                        $appointment->getStartAt(),
                                                        $appointment->getEndAt(),
                                                        $appointment->getTreatment(),
                                                        $appointment->getCost(),
                                                        $appointment->hasInsurance()
                                                     );
        }
    }



    public function getAll()
    {
        return $this->appointments;
    }

    public function deleted()
    {
        return $this->deleted;
    }

    public function edit()
    {
        return $this->edit;
    }
}

