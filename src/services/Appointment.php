<?php

class Appointment
{   
    private $id;
    private $doc_id;
    private $patient_id;
    private $startAt;
    private $endAt;
    private $treatment;
    private $cost;
    private $hasInsurance;

    /**
     * Class constructor.
     */
    public function __construct( $id = null, $doc_id = null, $patient_id = null, $startAt = null, $endAt = null, $treatment = null, $cost = null, $hasInsurance = null )
    {
        $this->id = $id;
        $this->doc_id = $doc_id;
        $this->patient_id = $patient_id;
        $this->startAt = $startAt;
        $this->endAt = $endAt;
        $this->treatment = $treatment;
        $this->cost = $cost;
        $this->hasInsurance = $hasInsurance;
    }

    /**
     * Get the value of id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get the value of doc_id
     */
    public function getDocId()
    {
        return $this->doc_id;
    }

    /**
     * Get the value of patient_id
     */
    public function getPatientId()
    {
        return $this->patient_id;
    }

    /**
     * Get the value of startAt
     */
    public function getStartAt()
    {
        $date = "";
        if( strpos( $this->startAt, "/" ) )
        {
            $date = explode( '/', $this->startAt );
            $y = explode( " ", $date[2] );
            $date = $y[0]."-".$date[1]."-".$date[0]." ".$y[1];           
        }
        return $date;
    }

    /**
     * Get the value of endAt
     */
    public function getEndAt()
    {
        $date = "";
        if( strpos( $this->endAt, "/" ) )
        {
            $date = explode( '/', $this->endAt );
            $y = explode( " ", $date[2] );
            $date = $y[0]."-".$date[1]."-".$date[0]." ".$y[1];           
        }
        return $date;
    }

    /**
     * Get the value of treatment
     */
    public function getTreatment()
    {
        return $this->treatment;
    }

    /**
     * Get the value of cost
     */
    public function getCost()
    {
        return intval( $this->cost );
    }

    /**
     * Get the value of hasInsurance
     */
    public function hasInsurance()
    {
        return $this->hasInsurance;
    }
}