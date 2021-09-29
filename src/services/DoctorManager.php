<?php 

require_once "DoctorTransaction.php";
require_once "Doctor.php";

class DoctorManager
{

    private $rs;
    private $exist;
    private $deleted;
    private $edited;

    /**
     * Class constructor.
     */
    public function __construct( Doctor $doctor = null, $action)
    {
        $this->doAction( $doctor, $action );
    }

    private function doAction( ?Doctor $doctor = null, $action )
    {
        switch( $action )
        {
            case "add":
                $transaction = new DoctorTransaction();
                $transaction->addDoctor( $doctor->getName(), $doctor->getEmail(), $doctor->getPassword(), $doctor->getCRM(), $doctor->getSpec(), $doctor->getSector(), $doctor->getApTime() );
                break;

            case "getAll":
                $transaction = new DoctorTransaction();
                $this->rs = $transaction->getAll();
                break;
            case "login":
                $transaction = new DoctorTransaction();
                $this->exist = $transaction->exist( $doctor->getEmail(), $doctor->getPassword() );
                break;
        
            case "delete":
                $transaction = new DoctorTransaction();
                $this->deleted = $transaction->delete( $doctor->getId() );
                break;

            case "edit": 
                $transaction = new DoctorTransaction();
                $this->edited = $transaction->edit( $doctor->getId() );
                break;

                case "editable":
                    $transaction = new DoctorTransaction();
                    $transaction->updateDoctor(  $doctor->getId(),  $doctor->getName(), $doctor->getEmail(), $doctor->getPassword(), $doctor->getCRM(), $doctor->getSpec(), $doctor->getSector(), $doctor->getApTime() );
                    break;
        }
    }

    public function getAll()
    {
        return $this->rs;
    }

    public function exist()
    {
        return $this->exist;
    }

    public function deleted()
    {
        return $this->deleted;
    }

    public function getDoctor()
    {
        return $this->edited;
    }
}