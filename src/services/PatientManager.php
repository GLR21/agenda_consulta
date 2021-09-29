<?php

require_once 'PatientTransaction.php';

class PatientManager
{

    private $exist;
    private $rs;
    private $edit;
    private $edited;

    /**
     * Class constructor.
     */
    public function __construct( ?Patient $patient = null, $action)
    {
        $this->doAction( $patient, $action );
    }

    private function doAction( ?Patient $patient = null , $action )
    {
        switch( $action )
        {
            case "add";
            $transaction = new PatientTransaction();
            $transaction->addPatient(  $patient->getName(), $patient->getEmail(), $patient->getDocument( 0 ), $patient->getDocument( 1 ), $patient->getAge(), $patient->getPassword(), $patient->getAddress(), $patient->getObservation(), $patient->getBirthDate(), $patient->getRole() );
            break;

            case "getAll":
            
            $transaction = new PatientTransaction();
            $this->rs = $transaction->getAll();
            break;
            
            case "login":
                $transaction = new PatientTransaction();
                $this->exist = $transaction->exist( $patient->getEmail(), $patient->getPassword() );
            break;

            case "delete":
                $transaction = new PatientTransaction();
                $this->deleted = $transaction->delete( $patient->getId() );
            break;

            case "edit":
                $transaction = new PatientTransaction();
                $this->edit = $transaction->edit( $patient->getId() );
            break;

            case "editable":
                $transaction = new PatientTransaction();
                $this->edited = $transaction->updatePatient(  $patient->getId() ,$patient->getName(), $patient->getEmail(), $patient->getDocument( 0 ), $patient->getDocument( 1 ), $patient->getAge(), $patient->getPassword(), $patient->getAddress(), $patient->getObservation(), $patient->getBirthDate(), $patient->getRole()  );

        }
    }


    public function getResultSet()
    {
        return $this->rs;
    }

    public function exist()
    {
        return $this->exist;
    }

    public function delete()
    {
        return $this->deleted;
    }

    public function getPatient()
    {
        return $this->edit;
    }

    public function isEdited()
    {
        return $this->edited;
    }
}